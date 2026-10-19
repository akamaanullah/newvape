<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Inventory
{
    private static function getDB()
    {
        return Database::getInstance()->getConnection();
    }

    /**
     * Get all products with their variants for Inventory Management
     */
    public static function getInventoryList($filterStatus = '', $search = '')
    {
        $db = self::getDB();
        if (!$db) return [];

        try {
            $sql = "SELECT p.id, p.title, p.name, p.sku, p.stock_quantity, p.stock_status, 
                           COALESCE(p.featured_image, 'assets/images/vape-image.webp') AS img
                    FROM products p
                    ORDER BY p.id ASC";
            $stmt = $db->query($sql);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Fetch all variants grouped by product_id
            $vStmt = $db->query("SELECT id, product_id, sku, variant_name, stock_quantity, price FROM product_variants ORDER BY id ASC");
            $variantsRows = $vStmt->fetchAll(PDO::FETCH_ASSOC);

            $variantsByProduct = [];
            foreach ($variantsRows as $v) {
                $pid = (int)$v['product_id'];
                if (!isset($variantsByProduct[$pid])) {
                    $variantsByProduct[$pid] = [];
                }
                $variantsByProduct[$pid][] = $v;
            }

            $list = [];
            foreach ($products as $p) {
                $pid = (int)$p['id'];
                $hasVariants = isset($variantsByProduct[$pid]) && count($variantsByProduct[$pid]) > 0;
                $variants = $hasVariants ? $variantsByProduct[$pid] : [];

                // Calculate total stock from variants if they exist
                $totalStock = 0;
                if ($hasVariants) {
                    foreach ($variants as $v) {
                        $totalStock += (int)$v['stock_quantity'];
                    }
                } else {
                    $totalStock = (int)$p['stock_quantity'];
                }

                $item = [
                    'id' => $pid,
                    'title' => $p['title'] ?: $p['name'],
                    'sku' => $p['sku'],
                    'img' => $p['img'],
                    'has_variants' => $hasVariants,
                    'variants_count' => count($variants),
                    'current_stock' => $totalStock,
                    'variants' => $variants
                ];

                // Filter by search query if given
                if (!empty($search)) {
                    $searchLower = strtolower($search);
                    $matchesTitle = str_contains(strtolower($item['title']), $searchLower);
                    $matchesSku = str_contains(strtolower($item['sku'] ?? ''), $searchLower);
                    $matchesVariant = false;

                    foreach ($variants as $v) {
                        if (str_contains(strtolower($v['variant_name']), $searchLower) || str_contains(strtolower($v['sku'] ?? ''), $searchLower)) {
                            $matchesVariant = true;
                            break;
                        }
                    }

                    if (!$matchesTitle && !$matchesSku && !$matchesVariant) {
                        continue;
                    }
                }

                // Filter by stock status if given
                if (!empty($filterStatus) && $filterStatus !== 'all') {
                    if ($filterStatus === 'in_stock' && $totalStock <= 15) continue;
                    if ($filterStatus === 'low_stock' && ($totalStock <= 0 || $totalStock > 15)) continue;
                    if ($filterStatus === 'out_of_stock' && $totalStock > 0) continue;
                }

                $list[] = $item;
            }

            return $list;
        } catch (\Exception $e) {
            error_log("Inventory::getInventoryList error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Apply stock adjustment for a single item (variant or product)
     */
    public static function adjustStock($type, $id, $adjustment, $reason = 'adjustment')
    {
        $db = self::getDB();
        if (!$db) return false;

        $id = (int)$id;
        $adjustment = (int)$adjustment;

        try {
            $db->beginTransaction();

            if ($type === 'variant') {
                $stmt = $db->prepare("SELECT product_id, stock_quantity FROM product_variants WHERE id = ? LIMIT 1 FOR UPDATE");
                $stmt->execute([$id]);
                $var = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!$var) {
                    $db->rollBack();
                    return false;
                }

                $newStock = max(0, (int)$var['stock_quantity'] + $adjustment);
                $productId = (int)$var['product_id'];

                // Update variant stock
                $uStmt = $db->prepare("UPDATE product_variants SET stock_quantity = ? WHERE id = ?");
                $uStmt->execute([$newStock, $id]);

                // Log change in inventory_logs
                $lStmt = $db->prepare("INSERT INTO inventory_logs (variant_id, change_amount, reason) VALUES (?, ?, ?)");
                $lStmt->execute([$id, $adjustment, $reason]);

                // Recalculate parent product total stock and status
                $sumStmt = $db->prepare("SELECT SUM(stock_quantity) AS total FROM product_variants WHERE product_id = ?");
                $sumStmt->execute([$productId]);
                $totalStock = (int)$sumStmt->fetchColumn();

                $stockStatus = 'In Stock';
                if ($totalStock <= 0) $stockStatus = 'Out of Stock';
                elseif ($totalStock < 15) $stockStatus = 'Low Stock';

                $pStmt = $db->prepare("UPDATE products SET stock_quantity = ?, stock_status = ? WHERE id = ?");
                $pStmt->execute([$totalStock, $stockStatus, $productId]);

                $db->commit();
                return ['success' => true, 'new_stock' => $newStock, 'parent_total' => $totalStock];
            } else {
                // Adjust simple product directly
                $stmt = $db->prepare("SELECT stock_quantity FROM products WHERE id = ? LIMIT 1 FOR UPDATE");
                $stmt->execute([$id]);
                $prod = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!$prod) {
                    $db->rollBack();
                    return false;
                }

                $newStock = max(0, (int)$prod['stock_quantity'] + $adjustment);
                $stockStatus = 'In Stock';
                if ($newStock <= 0) $stockStatus = 'Out of Stock';
                elseif ($newStock < 15) $stockStatus = 'Low Stock';

                $uStmt = $db->prepare("UPDATE products SET stock_quantity = ?, stock_status = ? WHERE id = ?");
                $uStmt->execute([$newStock, $stockStatus, $id]);

                $db->commit();
                return ['success' => true, 'new_stock' => $newStock];
            }
        } catch (\Exception $e) {
            if ($db->inTransaction()) {
                $db->rollBack();
            }
            error_log("Inventory::adjustStock error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Batch save multiple adjustments
     */
    public static function batchAdjust(array $adjustments)
    {
        $results = [];
        foreach ($adjustments as $adj) {
            $type = $adj['type'] ?? 'variant';
            $id = (int)($adj['id'] ?? 0);
            $amount = (int)($adj['adjustment'] ?? 0);

            if ($id > 0 && $amount !== 0) {
                $res = self::adjustStock($type, $id, $amount, 'adjustment');
                if ($res) {
                    $results[$type . '_' . $id] = $res;
                }
            }
        }
        return $results;
    }
}
