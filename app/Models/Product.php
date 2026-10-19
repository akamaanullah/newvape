<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class Product extends Model
{
    /**
     * Get all products with dynamic Brand & Collection taxonomy
     */
    public static function all()
    {
        $db = self::getDB();
        if ($db) {
            try {
                $sql = "SELECT p.*, 
                               b.name AS brand,
                               COALESCE(c.name, 'Disposable') AS category,
                               c.id AS collection_id,
                               COALESCE(NULLIF(p.featured_image, ''), 'assets/images/no-image.svg') AS img
                        FROM products p 
                        LEFT JOIN brands b ON p.brand_id = b.id
                        LEFT JOIN product_collections pc ON p.id = pc.product_id
                        LEFT JOIN collections c ON pc.collection_id = c.id
                        GROUP BY p.id
                        ORDER BY p.id DESC";
                $stmt = $db->query($sql);
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($results)) return $results;
            } catch (\Exception $e) {
                error_log("Product::all() error: " . $e->getMessage());
            }
        }
        return [];
    }

    /**
     * Find single product by ID with Brand & Collection relations
     */
    public static function find($id)
    {
        $db = self::getDB();
        if ($db) {
            try {
                $isNumeric = is_numeric($id);
                $sql = "SELECT p.*, 
                               b.name AS brand,
                               c.name AS category,
                               c.id AS collection_id,
                               COALESCE(NULLIF(p.featured_image, ''), 'assets/images/no-image.svg') AS img
                        FROM products p 
                        LEFT JOIN brands b ON p.brand_id = b.id 
                        LEFT JOIN product_collections pc ON p.id = pc.product_id
                        LEFT JOIN collections c ON pc.collection_id = c.id
                        WHERE " . ($isNumeric ? "p.id = ?" : "(p.slug = ? OR p.custom_url = ?)") . "
                        LIMIT 1";
                $stmt = $db->prepare($sql);
                if ($isNumeric) {
                    $stmt->execute([(int)$id]);
                } else {
                    $stmt->execute([(string)$id, (string)$id]);
                }
                $item = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($item) return $item;
            } catch (\Exception $e) {
                error_log("Product::find() error: " . $e->getMessage());
            }
        }
        return null;
    }

    /**
     * Get New Arrivals for storefront
     */
    public static function newArrivals($limit = 10)
    {
        $db = self::getDB();
        if ($db) {
            try {
                $sql = "SELECT p.*, 
                               b.name AS brand,
                               COALESCE(c.name, 'Disposable') AS category,
                               c.id AS collection_id,
                               COALESCE(NULLIF(p.featured_image, ''), 'assets/images/no-image.svg') AS img
                        FROM products p 
                        LEFT JOIN brands b ON p.brand_id = b.id
                        LEFT JOIN product_collections pc ON p.id = pc.product_id
                        LEFT JOIN collections c ON pc.collection_id = c.id
                        WHERE p.status = 'published' AND (p.is_new = 1 OR pc.collection_id = 8)
                        GROUP BY p.id
                        ORDER BY p.id DESC
                        LIMIT " . (int)$limit;
                $stmt = $db->query($sql);
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($results)) return $results;
            } catch (\Exception $e) {
                error_log("Product::newArrivals() error: " . $e->getMessage());
            }
        }
        return [];
    }

    /**
     * Get Best Selling products for storefront
     */
    public static function bestSellers($limit = 10)
    {
        $db = self::getDB();
        if ($db) {
            try {
                $sql = "SELECT p.*, 
                               b.name AS brand,
                               COALESCE(c.name, 'Disposable') AS category,
                               c.id AS collection_id,
                               COALESCE(NULLIF(p.featured_image, ''), 'assets/images/no-image.svg') AS img
                        FROM products p 
                        LEFT JOIN brands b ON p.brand_id = b.id
                        LEFT JOIN product_collections pc ON p.id = pc.product_id
                        LEFT JOIN collections c ON pc.collection_id = c.id
                        WHERE p.status = 'published' AND (p.is_bestseller = 1 OR pc.collection_id = 9)
                        GROUP BY p.id
                        ORDER BY p.reviews_count DESC, p.id DESC
                        LIMIT " . (int)$limit;
                $stmt = $db->query($sql);
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($results)) return $results;
            } catch (\Exception $e) {
                error_log("Product::bestSellers() error: " . $e->getMessage());
            }
        }
        return [];
    }

    /**
     * Get products by collection/category slug or ID
     */
    public static function byCollection($slugOrId, $limit = 16)
    {
        $db = self::getDB();
        if ($db) {
            try {
                $isNumeric = is_numeric($slugOrId);
                $sql = "SELECT p.*, 
                               b.name AS brand,
                               COALESCE(c.name, 'Disposable') AS category,
                               c.id AS collection_id,
                               COALESCE(NULLIF(p.featured_image, ''), 'assets/images/no-image.svg') AS img
                        FROM products p 
                        LEFT JOIN brands b ON p.brand_id = b.id
                        JOIN product_collections pc ON p.id = pc.product_id
                        JOIN collections c ON pc.collection_id = c.id
                        WHERE p.status = 'published' AND (" . ($isNumeric ? "c.id = ?" : "c.slug = ?") . ")
                        GROUP BY p.id
                        ORDER BY p.id DESC
                        LIMIT " . (int)$limit;
                $stmt = $db->prepare($sql);
                $stmt->execute([$slugOrId]);
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($results)) return $results;
            } catch (\Exception $e) {
                error_log("Product::byCollection() error: " . $e->getMessage());
            }
        }
        return [];
    }

    /**
     * Get Disposable Vapes for storefront
     */
    public static function disposables($limit = 16)
    {
        $results = self::byCollection('disposables', $limit);
        if (empty($results)) {
            $results = self::byCollection(1, $limit);
        }
        return $results;
    }

    /**
     * Get Vape Juices for storefront
     */
    public static function vapeJuices($limit = 4)
    {
        $results = self::byCollection('eliquids', $limit);
        if (empty($results)) {
            $results = self::byCollection(2, $limit);
        }
        return $results;
    }

    /**
     * Get Nicotine Pouches for storefront
     */
    public static function nicotinePouches($limit = 4)
    {
        $results = self::byCollection('pouches', $limit);
        if (empty($results)) {
            $results = self::byCollection(3, $limit);
        }
        return $results;
    }

    /**
     * Get Hemp & THC products for storefront
     */
    public static function hempThc($limit = 4)
    {
        $results = self::byCollection('hemp-thc', $limit);
        if (empty($results)) {
            $results = self::byCollection(4, $limit);
        }
        return $results;
    }

    /**
     * Create a new product in the database
     */
    public static function create(array $data)
    {
        $db = self::getDB();
        if (!$db) return false;

        $title = trim($data['title'] ?? $data['name'] ?? '');
        if (empty($title)) return false;

        $name = $title;

        // Resolve Brand ID
        $brandId = !empty($data['brand_id']) ? (int)$data['brand_id'] : null;
        if (!$brandId && !empty($data['brand'])) {
            $brandName = trim($data['brand']);
            $bStmt = $db->prepare("SELECT id FROM brands WHERE LOWER(name) = ? OR LOWER(slug) = ? LIMIT 1");
            $bStmt->execute([strtolower($brandName), strtolower($brandName)]);
            $bRow = $bStmt->fetch(PDO::FETCH_ASSOC);
            if ($bRow) $brandId = (int)$bRow['id'];
        }

        // Generate or clean SKU
        $sku = trim($data['sku'] ?? '');
        if (empty($sku)) {
            $prefix = strtoupper(substr(preg_replace('/[^a-zA-Z0-9]/', '', $title), 0, 4) ?: 'NV');
            $sku = $prefix . '-' . rand(1000, 9999) . '-' . strtoupper(bin2hex(random_bytes(2)));
        }

        // Generate or clean Slug
        $slug = trim($data['slug'] ?? '');
        if (empty($slug)) {
            $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $title));
            $slug = trim($slug, '-');
        }

        // Unique slug check
        $baseSlug = $slug;
        $counter = 1;
        while (true) {
            $checkStmt = $db->prepare("SELECT id FROM products WHERE slug = ? LIMIT 1");
            $checkStmt->execute([$slug]);
            if (!$checkStmt->fetch()) break;
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $customUrl = $slug;
        $shortDesc = trim($data['short_desc'] ?? $data['summary'] ?? '');
        $longDesc = trim($data['long_desc'] ?? $data['description'] ?? '');
        $basePrice = (float)str_replace(['$', ','], '', $data['price'] ?? $data['base_price'] ?? 0);
        $comparePrice = !empty($data['compare_price']) ? (float)str_replace(['$', ','], '', $data['compare_price']) : null;
        $stockQuantity = isset($data['stock_quantity']) ? (int)$data['stock_quantity'] : (isset($data['stock']) ? (int)$data['stock'] : 0);
        
        $stockStatus = 'In Stock';
        if ($stockQuantity <= 0) {
            $stockStatus = 'Out of Stock';
        } elseif ($stockQuantity < 15) {
            $stockStatus = 'Low Stock';
        }

        $featuredImage = trim($data['featured_image'] ?? $data['image'] ?? $data['img'] ?? 'assets/images/vape-image.webp');
        $status = in_array($data['status'] ?? '', ['published', 'draft', 'archived']) ? $data['status'] : ($data['status'] === 'active' ? 'published' : 'published');
        $tags = is_array($data['tags'] ?? null) ? implode(', ', $data['tags']) : trim($data['tags'] ?? '');
        $seoTitle = trim($data['seo_title'] ?? ($title . ' | New Vape'));
        $seoDescription = trim($data['seo_description'] ?? strip_tags($shortDesc ?: $longDesc));

        try {
            $sql = "INSERT INTO products 
                    (brand_id, name, title, sku, slug, custom_url, short_desc, long_desc, base_price, compare_price, stock_quantity, stock_status, featured_image, status, tags, seo_title, seo_description)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $db->prepare($sql);
            $stmt->execute([
                $brandId,
                $name,
                $title,
                $sku,
                $slug,
                $customUrl,
                $shortDesc,
                $longDesc,
                $basePrice,
                $comparePrice,
                $stockQuantity,
                $stockStatus,
                $featuredImage,
                $status,
                $tags,
                $seoTitle,
                $seoDescription
            ]);

            $productId = (int)$db->lastInsertId();

            // Link Collection
            $colId = !empty($data['collection_id']) ? (int)$data['collection_id'] : null;
            if (!$colId && !empty($data['collection'])) {
                $colName = trim($data['collection']);
                $cStmt = $db->prepare("SELECT id FROM collections WHERE LOWER(name) = ? OR LOWER(slug) = ? LIMIT 1");
                $cStmt->execute([strtolower($colName), strtolower($colName)]);
                $cRow = $cStmt->fetch(PDO::FETCH_ASSOC);
                if ($cRow) $colId = (int)$cRow['id'];
            }

            if ($colId) {
                $pcStmt = $db->prepare("INSERT INTO product_collections (product_id, collection_id) VALUES (?, ?)");
                $pcStmt->execute([$productId, $colId]);
            }

            // Save Images to product_images table if provided
            if (!empty($data['images']) && is_array($data['images'])) {
                $imgStmt = $db->prepare("INSERT INTO product_images (product_id, image_url, sort_order) VALUES (?, ?, ?)");
                foreach ($data['images'] as $order => $imgUrl) {
                    if (!empty($imgUrl)) {
                        $imgStmt->execute([$productId, $imgUrl, $order + 1]);
                    }
                }
            }

            // Save Variants if provided
            if (!empty($data['variants']) && is_array($data['variants'])) {
                $vStmt = $db->prepare("INSERT INTO product_variants (product_id, sku, variant_name, price, stock_quantity, is_default) VALUES (?, ?, ?, ?, ?, ?)");
                foreach ($data['variants'] as $idx => $v) {
                    $vName = is_array($v) ? ($v['name'] ?? $v['variant_name'] ?? '') : (string)$v;
                    if (empty($vName)) continue;
                    $vSku = is_array($v) ? ($v['sku'] ?? $sku . '-V' . ($idx + 1)) : $sku . '-V' . ($idx + 1);
                    $vPrice = is_array($v) ? (float)($v['price'] ?? $basePrice) : $basePrice;
                    $vStock = is_array($v) ? (int)($v['stock'] ?? $v['stock_quantity'] ?? 10) : 10;
                    $isDefault = ($idx === 0) ? 1 : 0;
                    $vStmt->execute([$productId, $vSku, $vName, $vPrice, $vStock, $isDefault]);
                }
            }

            return $productId;
        } catch (\Exception $e) {
            error_log("Product::create() error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Update an existing product in the database
     */
    public static function update($id, array $data)
    {
        $db = self::getDB();
        if (!$db) return false;

        $title = trim($data['title'] ?? $data['name'] ?? '');
        if (empty($title)) return false;

        $name = $title;

        // Resolve Brand ID
        $brandId = !empty($data['brand_id']) ? (int)$data['brand_id'] : null;
        if (!$brandId && !empty($data['brand'])) {
            $brandName = trim($data['brand']);
            $bStmt = $db->prepare("SELECT id FROM brands WHERE LOWER(name) = ? OR LOWER(slug) = ? LIMIT 1");
            $bStmt->execute([strtolower($brandName), strtolower($brandName)]);
            $bRow = $bStmt->fetch(PDO::FETCH_ASSOC);
            if ($bRow) $brandId = (int)$bRow['id'];
        }

        $sku = trim($data['sku'] ?? '');
        $slug = trim($data['slug'] ?? '');
        if (empty($slug)) {
            $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $title));
            $slug = trim($slug, '-');
        }

        // Unique slug check excluding current record
        $baseSlug = $slug;
        $counter = 1;
        while (true) {
            $checkStmt = $db->prepare("SELECT id FROM products WHERE slug = ? AND id != ? LIMIT 1");
            $checkStmt->execute([$slug, (int)$id]);
            if (!$checkStmt->fetch()) break;
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $customUrl = $slug;
        $shortDesc = trim($data['short_desc'] ?? $data['summary'] ?? '');
        $longDesc = trim($data['long_desc'] ?? $data['description'] ?? '');
        $basePrice = (float)str_replace(['$', ','], '', $data['price'] ?? $data['base_price'] ?? 0);
        $comparePrice = !empty($data['compare_price']) ? (float)str_replace(['$', ','], '', $data['compare_price']) : null;
        $stockQuantity = isset($data['stock_quantity']) ? (int)$data['stock_quantity'] : (isset($data['stock']) ? (int)$data['stock'] : 0);
        
        $stockStatus = 'In Stock';
        if ($stockQuantity <= 0) {
            $stockStatus = 'Out of Stock';
        } elseif ($stockQuantity < 15) {
            $stockStatus = 'Low Stock';
        }

        $hasImageKey = array_key_exists('featured_image', $data) || array_key_exists('image', $data) || array_key_exists('img', $data);
        $featuredImage = $data['featured_image'] ?? $data['image'] ?? $data['img'] ?? null;

        $status = in_array($data['status'] ?? '', ['published', 'draft', 'archived']) ? $data['status'] : ($data['status'] === 'active' ? 'published' : 'published');
        $tags = is_array($data['tags'] ?? null) ? implode(', ', $data['tags']) : trim($data['tags'] ?? '');
        $seoTitle = trim($data['seo_title'] ?? ($title . ' | New Vape'));
        $seoDescription = trim($data['seo_description'] ?? strip_tags($shortDesc ?: $longDesc));

        try {
            if ($hasImageKey && $featuredImage !== null) {
                $sql = "UPDATE products 
                        SET brand_id = ?, name = ?, title = ?, sku = ?, slug = ?, custom_url = ?, 
                            short_desc = ?, long_desc = ?, base_price = ?, compare_price = ?, 
                            stock_quantity = ?, stock_status = ?, featured_image = ?, status = ?, 
                            tags = ?, seo_title = ?, seo_description = ?, updated_at = CURRENT_TIMESTAMP
                        WHERE id = ?";
                $params = [
                    $brandId, $name, $title, $sku, $slug, $customUrl,
                    $shortDesc, $longDesc, $basePrice, $comparePrice,
                    $stockQuantity, $stockStatus, $featuredImage, $status,
                    $tags, $seoTitle, $seoDescription, (int)$id
                ];
            } else {
                $sql = "UPDATE products 
                        SET brand_id = ?, name = ?, title = ?, sku = ?, slug = ?, custom_url = ?, 
                            short_desc = ?, long_desc = ?, base_price = ?, compare_price = ?, 
                            stock_quantity = ?, stock_status = ?, status = ?, 
                            tags = ?, seo_title = ?, seo_description = ?, updated_at = CURRENT_TIMESTAMP
                        WHERE id = ?";
                $params = [
                    $brandId, $name, $title, $sku, $slug, $customUrl,
                    $shortDesc, $longDesc, $basePrice, $comparePrice,
                    $stockQuantity, $stockStatus, $status,
                    $tags, $seoTitle, $seoDescription, (int)$id
                ];
            }

            $stmt = $db->prepare($sql);
            $stmt->execute($params);

            // Update primary collection link
            $colId = !empty($data['collection_id']) ? (int)$data['collection_id'] : null;
            if (!$colId && !empty($data['collection'])) {
                $colName = trim($data['collection']);
                $cStmt = $db->prepare("SELECT id FROM collections WHERE LOWER(name) = ? OR LOWER(slug) = ? LIMIT 1");
                $cStmt->execute([strtolower($colName), strtolower($colName)]);
                $cRow = $cStmt->fetch(PDO::FETCH_ASSOC);
                if ($cRow) $colId = (int)$cRow['id'];
            }

            if ($colId) {
                $delColStmt = $db->prepare("DELETE FROM product_collections WHERE product_id = ?");
                $delColStmt->execute([(int)$id]);

                $pcStmt = $db->prepare("INSERT INTO product_collections (product_id, collection_id) VALUES (?, ?)");
                $pcStmt->execute([(int)$id, $colId]);
            }

            // Save any newly uploaded images to product_images table
            if (!empty($data['images']) && is_array($data['images'])) {
                $imgStmt = $db->prepare("INSERT INTO product_images (product_id, image_url, sort_order) VALUES (?, ?, ?)");
                foreach ($data['images'] as $order => $imgUrl) {
                    if (!empty($imgUrl)) {
                        $imgStmt->execute([(int)$id, $imgUrl, $order + 1]);
                    }
                }
            }

            // Save Variants if provided
            if (isset($data['variants']) && is_array($data['variants'])) {
                $db->prepare("DELETE FROM product_variants WHERE product_id = ?")->execute([(int)$id]);
                if (!empty($data['variants'])) {
                    $vStmt = $db->prepare("INSERT INTO product_variants (product_id, sku, variant_name, price, stock_quantity, is_default) VALUES (?, ?, ?, ?, ?, ?)");
                    foreach ($data['variants'] as $idx => $v) {
                        $vName = is_array($v) ? ($v['name'] ?? $v['variant_name'] ?? '') : (string)$v;
                        if (empty($vName)) continue;
                        $vSku = is_array($v) ? ($v['sku'] ?? $sku . '-V' . ($idx + 1)) : $sku . '-V' . ($idx + 1);
                        $vPrice = is_array($v) ? (float)($v['price'] ?? $basePrice) : $basePrice;
                        $vStock = is_array($v) ? (int)($v['stock'] ?? $v['stock_quantity'] ?? 10) : 10;
                        $isDefault = ($idx === 0) ? 1 : 0;
                        $vStmt->execute([(int)$id, $vSku, $vName, $vPrice, $vStock, $isDefault]);
                    }
                }
            }

            return true;
        } catch (\Exception $e) {
            error_log("Product::update() error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get all images for a product
     */
    public static function getImages($productId)
    {
        $db = self::getDB();
        if ($db) {
            try {
                $stmt = $db->prepare("SELECT * FROM product_images WHERE product_id = ? ORDER BY sort_order ASC, id ASC");
                $stmt->execute([(int)$productId]);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($rows)) return $rows;
            } catch (\Exception $e) {}
        }
        return [];
    }

    /**
     * Delete product and all associated dependencies
     */
    public static function delete($id)
    {
        $db = self::getDB();
        if (!$db) return false;

        try {
            $intId = (int)$id;

            // Delete dependencies
            $db->prepare("DELETE FROM product_collections WHERE product_id = ?")->execute([$intId]);
            $db->prepare("DELETE FROM product_variants WHERE product_id = ?")->execute([$intId]);
            $db->prepare("DELETE FROM product_images WHERE product_id = ?")->execute([$intId]);
            $db->prepare("DELETE FROM product_specifications WHERE product_id = ?")->execute([$intId]);
            $db->prepare("DELETE FROM product_faqs WHERE product_id = ?")->execute([$intId]);
            $db->prepare("DELETE FROM product_reviews WHERE product_id = ?")->execute([$intId]);
            $db->prepare("DELETE FROM product_related_posts WHERE product_id = ?")->execute([$intId]);

            // Delete product
            $stmt = $db->prepare("DELETE FROM products WHERE id = ?");
            return $stmt->execute([$intId]);
        } catch (\Exception $e) {
            error_log("Product::delete() error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Dynamic Top 4 Highlight Boxes (Puffs, Nicotine, Battery, Capacity, Wattage, Bottle Size, etc.)
     */
    public static function getHighlights($productId)
    {
        $db = self::getDB();
        if ($db) {
            try {
                $stmt = $db->prepare("SELECT spec_key as label, spec_value as value, icon_type FROM product_specifications WHERE product_id = ? AND is_highlight = 1 ORDER BY sort_order ASC LIMIT 4");
                $stmt->execute([(int)$productId]);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($rows)) return $rows;
            } catch (\Exception $e) {}
        }

        return [
            ['label' => 'Puffs', 'value' => '35000', 'icon_type' => 'puffs'],
            ['label' => 'Nicotine', 'value' => '50mg', 'icon_type' => 'nicotine'],
            ['label' => 'Battery', 'value' => '1000mAh', 'icon_type' => 'battery'],
            ['label' => 'Capacity', 'value' => '18ml', 'icon_type' => 'capacity']
        ];
    }

    /**
     * Dynamic "More Information" Specifications Table
     */
    public static function getSpecifications($productId)
    {
        $db = self::getDB();
        if ($db) {
            try {
                $stmt = $db->prepare("SELECT spec_key, spec_value FROM product_specifications WHERE product_id = ? AND is_highlight = 0 ORDER BY sort_order ASC");
                $stmt->execute([(int)$productId]);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($rows)) {
                    $specs = [];
                    foreach ($rows as $r) {
                        $specs[$r['spec_key']] = $r['spec_value'];
                    }
                    return $specs;
                }
            } catch (\Exception $e) {}
        }

        return [
            'Brand' => 'RYL',
            'Nicotine Strength' => '50mg',
            'Puff Count' => '35000',
            'Battery Capacity' => '820mAh',
            'Prefilled Capacity' => '16.5ml',
            'Rechargeable' => 'Yes',
            'Coil Type' => 'Dual Mesh'
        ];
    }

    /**
     * Dynamic Variants (Flavors, Strengths, Colors, etc.)
     */
    public static function getVariants($productId)
    {
        $db = self::getDB();
        if ($db) {
            try {
                $stmt = $db->prepare("SELECT * FROM product_variants WHERE product_id = ? ORDER BY id ASC");
                $stmt->execute([(int)$productId]);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($rows)) return $rows;
            } catch (\Exception $e) {}
        }

        return [];
    }

    /**
     * Dynamic Product FAQs (Tab 4)
     */
    public static function getFaqs($productId)
    {
        $db = self::getDB();
        if ($db) {
            try {
                $stmt = $db->prepare("SELECT question, answer FROM product_faqs WHERE product_id = ? ORDER BY sort_order ASC");
                $stmt->execute([(int)$productId]);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($rows)) return $rows;
            } catch (\Exception $e) {}
        }

        return [];
    }

    /**
     * Dynamic Product Reviews (Tab 3)
     */
    public static function getReviews($productId)
    {
        $db = self::getDB();
        if ($db) {
            try {
                $stmt = $db->prepare("SELECT customer_name, rating, title, comment, created_at FROM product_reviews WHERE product_id = ? AND status = 'approved' ORDER BY id DESC");
                $stmt->execute([(int)$productId]);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($rows)) return $rows;
            } catch (\Exception $e) {}
        }

        return [];
    }

    /**
     * Dynamic Related Posts (Tab 5)
     */
    public static function getRelatedPosts($productId)
    {
        $db = self::getDB();
        if ($db) {
            try {
                $stmt = $db->prepare("SELECT bp.title, bp.slug FROM product_related_posts prp JOIN blog_posts bp ON prp.post_id = bp.id WHERE prp.product_id = ? ORDER BY prp.sort_order ASC");
                $stmt->execute([(int)$productId]);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($rows)) return $rows;
            } catch (\Exception $e) {}
        }

        return [];
    }
}
