<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class Brand extends Model
{
    /**
     * Get all brands with attached products count
     */
    public static function all()
    {
        $db = self::getDB();
        if (!$db) return [];

        try {
            $sql = "SELECT b.*, 
                           COUNT(p.id) AS products_count,
                           IF(b.is_active = 1, 'Active', 'Inactive') AS status_label
                    FROM brands b
                    LEFT JOIN products p ON b.id = p.brand_id
                    GROUP BY b.id
                    ORDER BY b.sort_order ASC, b.id ASC";
            
            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            error_log("Brand::all() error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Get only active brands (e.g. for storefront & product dropdowns)
     */
    public static function active($limit = null)
    {
        $db = self::getDB();
        if (!$db) return [];

        try {
            $sql = "SELECT b.*, COUNT(p.id) AS products_count
                    FROM brands b
                    LEFT JOIN products p ON b.id = p.brand_id
                    WHERE b.is_active = 1
                    GROUP BY b.id
                    ORDER BY b.sort_order ASC, b.name ASC";
            
            if ($limit !== null && $limit > 0) {
                $sql .= " LIMIT " . (int)$limit;
            }

            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            error_log("Brand::active() error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Find single brand by ID
     */
    public static function find($id)
    {
        $db = self::getDB();
        if (!$db) return null;

        try {
            $sql = "SELECT b.*, 
                           COUNT(p.id) AS products_count,
                           IF(b.is_active = 1, 'Active', 'Inactive') AS status_label
                    FROM brands b
                    LEFT JOIN products p ON b.id = p.brand_id
                    WHERE b.id = ?
                    GROUP BY b.id
                    LIMIT 1";

            $stmt = $db->prepare($sql);
            $stmt->execute([(int)$id]);
            $brand = $stmt->fetch(PDO::FETCH_ASSOC);
            return $brand ?: null;
        } catch (\Exception $e) {
            error_log("Brand::find() error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Find brand by slug
     */
    public static function findBySlug(string $slug)
    {
        $db = self::getDB();
        if (!$db) return null;

        try {
            $sql = "SELECT b.*, COUNT(p.id) AS products_count
                    FROM brands b
                    LEFT JOIN products p ON b.id = p.brand_id
                    WHERE b.slug = ?
                    GROUP BY b.id
                    LIMIT 1";

            $stmt = $db->prepare($sql);
            $stmt->execute([trim($slug)]);
            $brand = $stmt->fetch(PDO::FETCH_ASSOC);
            return $brand ?: null;
        } catch (\Exception $e) {
            error_log("Brand::findBySlug() error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Create a new brand
     */
    public static function create(array $data)
    {
        $db = self::getDB();
        if (!$db) return false;

        $name = trim($data['name'] ?? '');
        if (empty($name)) return false;

        $slug = trim($data['slug'] ?? '');
        if (empty($slug)) {
            $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));
            $slug = trim($slug, '-');
        }

        // Check for unique slug
        $baseSlug = $slug;
        $counter = 1;
        while (true) {
            $checkStmt = $db->prepare("SELECT id FROM brands WHERE slug = ? LIMIT 1");
            $checkStmt->execute([$slug]);
            if (!$checkStmt->fetch()) break;
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $logoUrl = isset($data['logo_url']) ? trim($data['logo_url']) : (isset($data['logo']) ? trim($data['logo']) : '');
        $description = trim($data['description'] ?? '');
        $websiteUrl = trim($data['website_url'] ?? '');
        $metaTitle = trim($data['meta_title'] ?? ($name . ' Official Store | New Vape'));
        $metaDesc = trim($data['meta_desc'] ?? $description);
        $sortOrder = isset($data['sort_order']) ? (int)$data['sort_order'] : 0;
        $isActive = isset($data['is_active']) ? (int)$data['is_active'] : 1;

        try {
            $sql = "INSERT INTO brands 
                    (name, slug, logo_url, description, website_url, meta_title, meta_desc, sort_order, is_active)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $db->prepare($sql);
            $stmt->execute([
                $name,
                $slug,
                $logoUrl,
                $description,
                $websiteUrl,
                $metaTitle,
                $metaDesc,
                $sortOrder,
                $isActive
            ]);

            return (int)$db->lastInsertId();
        } catch (\Exception $e) {
            error_log("Brand::create() error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Update an existing brand
     */
    public static function update($id, array $data)
    {
        $db = self::getDB();
        if (!$db) return false;

        $name = trim($data['name'] ?? '');
        if (empty($name)) return false;

        $slug = trim($data['slug'] ?? '');
        if (empty($slug)) {
            $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));
            $slug = trim($slug, '-');
        }

        // Unique slug check excluding current record
        $baseSlug = $slug;
        $counter = 1;
        while (true) {
            $checkStmt = $db->prepare("SELECT id FROM brands WHERE slug = ? AND id != ? LIMIT 1");
            $checkStmt->execute([$slug, (int)$id]);
            if (!$checkStmt->fetch()) break;
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $hasLogoKey = array_key_exists('logo_url', $data) || array_key_exists('logo', $data);
        $logoUrl = array_key_exists('logo_url', $data) ? trim($data['logo_url']) : (array_key_exists('logo', $data) ? trim($data['logo']) : null);
        $description = trim($data['description'] ?? '');
        $websiteUrl = trim($data['website_url'] ?? '');
        $metaTitle = trim($data['meta_title'] ?? ($name . ' Official Store | New Vape'));
        $metaDesc = trim($data['meta_desc'] ?? $description);
        $sortOrder = isset($data['sort_order']) ? (int)$data['sort_order'] : 0;
        $isActive = isset($data['is_active']) ? (int)$data['is_active'] : 1;

        try {
            if ($hasLogoKey) {
                $sql = "UPDATE brands 
                        SET name = ?, slug = ?, logo_url = ?, description = ?, website_url = ?, 
                            meta_title = ?, meta_desc = ?, sort_order = ?, is_active = ?
                        WHERE id = ?";
                $params = [
                    $name, $slug, $logoUrl, $description, $websiteUrl,
                    $metaTitle, $metaDesc, $sortOrder, $isActive, (int)$id
                ];
            } else {
                $sql = "UPDATE brands 
                        SET name = ?, slug = ?, description = ?, website_url = ?, 
                            meta_title = ?, meta_desc = ?, sort_order = ?, is_active = ?
                        WHERE id = ?";
                $params = [
                    $name, $slug, $description, $websiteUrl,
                    $metaTitle, $metaDesc, $sortOrder, $isActive, (int)$id
                ];
            }

            $stmt = $db->prepare($sql);
            return $stmt->execute($params);
        } catch (\Exception $e) {
            error_log("Brand::update() error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete brand and unlink attached products
     */
    public static function delete($id)
    {
        $db = self::getDB();
        if (!$db) return false;

        try {
            // Unlink products associated with this brand
            $unlinkStmt = $db->prepare("UPDATE products SET brand_id = NULL WHERE brand_id = ?");
            $unlinkStmt->execute([(int)$id]);

            // Delete brand record
            $stmt = $db->prepare("DELETE FROM brands WHERE id = ?");
            return $stmt->execute([(int)$id]);
        } catch (\Exception $e) {
            error_log("Brand::delete() error: " . $e->getMessage());
            return false;
        }
    }
}
