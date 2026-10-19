<?php
namespace App\Models;

use App\Core\Model;

class Menu extends Model
{
    /**
     * Get all menus with their items count
     */
    public static function all()
    {
        $db = self::getDB();
        if (!$db) return [];

        try {
            $sql = "SELECT m.*, 
                           (SELECT COUNT(*) FROM menu_items mi WHERE mi.menu_id = m.id) AS items_count 
                    FROM menus m 
                    ORDER BY m.id ASC";
            $stmt = $db->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            error_log("Menu::all error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Find menu by ID with its items
     */
    public static function find($id)
    {
        $db = self::getDB();
        if (!$db) return null;

        try {
            $stmt = $db->prepare("SELECT * FROM menus WHERE id = ? LIMIT 1");
            $stmt->execute([(int)$id]);
            $menu = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$menu) return null;

            // Fetch menu items ordered by sort_order
            $itemsStmt = $db->prepare("SELECT * FROM menu_items WHERE menu_id = ? ORDER BY sort_order ASC, id ASC");
            $itemsStmt->execute([(int)$id]);
            $menu['items'] = $itemsStmt->fetchAll(\PDO::FETCH_ASSOC);

            return $menu;
        } catch (\Exception $e) {
            error_log("Menu::find error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Create a new menu
     */
    public static function create($data)
    {
        $db = self::getDB();
        if (!$db) return false;

        try {
            $stmt = $db->prepare("INSERT INTO menus (name, subtitle, location) VALUES (?, ?, ?)");
            $stmt->execute([
                trim($data['name'] ?? 'New Menu'),
                trim($data['subtitle'] ?? 'Secondary Menu'),
                trim($data['location'] ?? 'custom_menu_' . time())
            ]);
            return $db->lastInsertId();
        } catch (\Exception $e) {
            error_log("Menu::create error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Update menu settings
     */
    public static function update($id, $data)
    {
        $db = self::getDB();
        if (!$db) return false;

        try {
            $stmt = $db->prepare("UPDATE menus SET name = ?, location = ?, subtitle = ? WHERE id = ?");
            return $stmt->execute([
                trim($data['name'] ?? ''),
                trim($data['location'] ?? ''),
                trim($data['subtitle'] ?? 'Secondary Menu'),
                (int)$id
            ]);
        } catch (\Exception $e) {
            error_log("Menu::update error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete menu and all its items
     */
    public static function delete($id)
    {
        $db = self::getDB();
        if (!$db) return false;

        try {
            $db->beginTransaction();

            $stmtItems = $db->prepare("DELETE FROM menu_items WHERE menu_id = ?");
            $stmtItems->execute([(int)$id]);

            $stmtMenu = $db->prepare("DELETE FROM menus WHERE id = ?");
            $stmtMenu->execute([(int)$id]);

            $db->commit();
            return true;
        } catch (\Exception $e) {
            if ($db->inTransaction()) $db->rollBack();
            error_log("Menu::delete error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Save the entire menu settings and hierarchical items tree
     */
    public static function saveMenuAndTree($menuId, $name, $location, $subtitle, $items)
    {
        $db = self::getDB();
        if (!$db) return false;

        try {
            $db->beginTransaction();

            // 1. Update Menu details
            $stmt = $db->prepare("UPDATE menus SET name = ?, location = ?, subtitle = ? WHERE id = ?");
            $stmt->execute([
                trim($name),
                trim($location),
                trim($subtitle ?: 'Secondary Menu'),
                (int)$menuId
            ]);

            // 2. Fetch existing item IDs to know which ones to keep / delete
            $existingStmt = $db->prepare("SELECT id FROM menu_items WHERE menu_id = ?");
            $existingStmt->execute([(int)$menuId]);
            $existingIds = $existingStmt->fetchAll(\PDO::FETCH_COLUMN);

            $retainedIds = [];

            // Helper function to recursively save items
            $saveRecursive = function($itemList, $parentId = null) use (&$saveRecursive, $db, $menuId, &$retainedIds) {
                if (!is_array($itemList)) return;

                $order = 1;
                foreach ($itemList as $item) {
                    $itemId = !empty($item['id']) && is_numeric($item['id']) ? (int)$item['id'] : null;
                    $title = trim($item['title'] ?? $item['name'] ?? 'Menu Item');
                    $subtitle = trim($item['subtitle'] ?? '');
                    $linkType = trim($item['link_type'] ?? 'custom_url');
                    $linkValue = trim($item['link_value'] ?? $item['url'] ?? '#');
                    $entityId = !empty($item['entity_id']) ? (int)$item['entity_id'] : null;

                    $imageUrl = trim($item['image_url'] ?? '');

                    if ($itemId && in_array($itemId, $retainedIds)) {
                        // Avoid duplicates
                        $itemId = null;
                    }

                    if ($itemId) {
                        // Update existing item
                        $uStmt = $db->prepare("UPDATE menu_items SET parent_id = ?, title = ?, subtitle = ?, link_type = ?, link_value = ?, entity_id = ?, image_url = ?, sort_order = ? WHERE id = ? AND menu_id = ?");
                        $uStmt->execute([
                            $parentId,
                            $title,
                            $subtitle,
                            $linkType,
                            $linkValue,
                            $entityId,
                            $imageUrl,
                            $order,
                            $itemId,
                            (int)$menuId
                        ]);
                        $retainedIds[] = $itemId;
                        $currentId = $itemId;
                    } else {
                        // Insert new item
                        $iStmt = $db->prepare("INSERT INTO menu_items (menu_id, parent_id, title, subtitle, link_type, link_value, entity_id, image_url, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $iStmt->execute([
                            (int)$menuId,
                            $parentId,
                            $title,
                            $subtitle,
                            $linkType,
                            $linkValue,
                            $entityId,
                            $imageUrl,
                            $order
                        ]);
                        $currentId = (int)$db->lastInsertId();
                        $retainedIds[] = $currentId;
                    }

                    $order++;

                    // Process children if any
                    if (!empty($item['children']) && is_array($item['children'])) {
                        $saveRecursive($item['children'], $currentId);
                    }
                }
            };

            $saveRecursive($items, null);

            // 3. Delete removed items
            $toDelete = array_diff($existingIds, $retainedIds);
            if (!empty($toDelete)) {
                $placeholders = implode(',', array_fill(0, count($toDelete), '?'));
                $delStmt = $db->prepare("DELETE FROM menu_items WHERE id IN ($placeholders) AND menu_id = ?");
                $params = array_values($toDelete);
                $params[] = (int)$menuId;
                $delStmt->execute($params);
            }

            $db->commit();
            return true;
        } catch (\Exception $e) {
            if ($db->inTransaction()) $db->rollBack();
            error_log("Menu::saveMenuAndTree error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete single menu item and all its descendant children
     */
    public static function deleteItem($itemId)
    {
        $db = self::getDB();
        if (!$db) return false;

        try {
            $db->beginTransaction();

            // Find all child IDs recursively
            $allIds = [(int)$itemId];
            $queue = [(int)$itemId];

            while (!empty($queue)) {
                $currentParent = array_shift($queue);
                $stmt = $db->prepare("SELECT id FROM menu_items WHERE parent_id = ?");
                $stmt->execute([$currentParent]);
                $children = $stmt->fetchAll(\PDO::FETCH_COLUMN);
                foreach ($children as $cId) {
                    $allIds[] = (int)$cId;
                    $queue[] = (int)$cId;
                }
            }

            $placeholders = implode(',', array_fill(0, count($allIds), '?'));
            $delStmt = $db->prepare("DELETE FROM menu_items WHERE id IN ($placeholders)");
            $delStmt->execute($allIds);

            $db->commit();
            return true;
        } catch (\Exception $e) {
            if ($db->inTransaction()) $db->rollBack();
            error_log("Menu::deleteItem error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get available collections, brands, and pages for target link selector dropdowns
     */
    public static function getAvailableEntities()
    {
        $db = self::getDB();
        $res = [
            'collections' => [],
            'brands' => [],
            'pages' => []
        ];

        if (!$db) return $res;

        try {
            $cStmt = $db->query("SELECT id, name, slug FROM collections WHERE is_active = 1 ORDER BY name ASC");
            if ($cStmt) $res['collections'] = $cStmt->fetchAll(\PDO::FETCH_ASSOC);

            $bStmt = $db->query("SELECT id, name, slug FROM brands WHERE is_active = 1 ORDER BY name ASC");
            if ($bStmt) $res['brands'] = $bStmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\Exception $e) {
            error_log("Menu::getAvailableEntities error: " . $e->getMessage());
        }

        return $res;
    }

    /**
     * Get hierarchical menu tree by location (e.g. 'main_menu', 'footer_menu')
     * Returns structured nested array ready for front-end rendering
     */
    public static function getTreeByLocation($location = 'main_menu')
    {
        $db = self::getDB();
        if (!$db) return [];

        try {
            // Find menu by location or fallback to ID 1
            $stmt = $db->prepare("SELECT * FROM menus WHERE location = ? LIMIT 1");
            $stmt->execute([$location]);
            $menu = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$menu && $location === 'main_menu') {
                $stmt = $db->query("SELECT * FROM menus WHERE id = 1 LIMIT 1");
                $menu = $stmt ? $stmt->fetch(\PDO::FETCH_ASSOC) : null;
            }

            if (!$menu) return [];

            // Fetch items
            $stmt = $db->prepare("SELECT * FROM menu_items WHERE menu_id = ? ORDER BY sort_order ASC, id ASC");
            $stmt->execute([(int)$menu['id']]);
            $rawItems = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if (empty($rawItems)) return [];

            // Group by parent_id
            $itemsById = [];
            foreach ($rawItems as $item) {
                $item['children'] = [];
                $itemsById[$item['id']] = $item;
            }

            $tree = [];
            foreach ($itemsById as $id => &$node) {
                if (!empty($node['parent_id']) && isset($itemsById[$node['parent_id']])) {
                    $itemsById[$node['parent_id']]['children'][] = &$node;
                } else {
                    $tree[] = &$node;
                }
            }
            unset($node);

            return $tree;
        } catch (\Exception $e) {
            error_log("Menu::getTreeByLocation error: " . $e->getMessage());
            return [];
        }
    }
}
