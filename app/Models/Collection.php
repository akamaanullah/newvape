<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class Collection extends Model
{
    /**
     * Get all collections with dynamic products count and parent name
     */
    public static function all()
    {
        $db = self::getDB();
        if (!$db) return [];

        try {
            $sql = "SELECT c.*, 
                           COUNT(pc.product_id) AS products_count, 
                           p.name AS parent_name,
                           IF(c.is_active = 1, 'Active', 'Inactive') AS status_label
                    FROM collections c
                    LEFT JOIN product_collections pc ON c.id = pc.collection_id
                    LEFT JOIN collections p ON c.parent_id = p.id
                    GROUP BY c.id
                    ORDER BY c.sort_order ASC, c.id ASC";
            
            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            error_log("Collection::all() error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Find a single collection by ID with product count and parent info
     */
    public static function find($id)
    {
        $db = self::getDB();
        if (!$db) return null;

        try {
            $sql = "SELECT c.*, 
                           COUNT(pc.product_id) AS products_count, 
                           p.name AS parent_name,
                           IF(c.is_active = 1, 'Active', 'Inactive') AS status_label
                    FROM collections c
                    LEFT JOIN product_collections pc ON c.id = pc.collection_id
                    LEFT JOIN collections p ON c.parent_id = p.id
                    WHERE c.id = ?
                    GROUP BY c.id
                    LIMIT 1";

            $stmt = $db->prepare($sql);
            $stmt->execute([(int)$id]);
            $collection = $stmt->fetch(PDO::FETCH_ASSOC);
            return $collection ?: null;
        } catch (\Exception $e) {
            error_log("Collection::find() error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Find a collection by slug
     */
    public static function findBySlug($slug)
    {
        $db = self::getDB();
        if (!$db) return null;

        try {
            $stmt = $db->prepare("SELECT * FROM collections WHERE slug = ? OR custom_url_path = ? LIMIT 1");
            $stmt->execute([$slug, '/collections/' . $slug]);
            $collection = $stmt->fetch(PDO::FETCH_ASSOC);
            return $collection ?: null;
        } catch (\Exception $e) {
            error_log("Collection::findBySlug() error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Get parent collections list for dropdown selector
     */
    public static function parents($excludeId = null)
    {
        $db = self::getDB();
        if (!$db) return [];

        try {
            if ($excludeId) {
                $stmt = $db->prepare("SELECT id, name, slug FROM collections WHERE id != ? AND (parent_id IS NULL OR parent_id = 0) ORDER BY name ASC");
                $stmt->execute([(int)$excludeId]);
            } else {
                $stmt = $db->query("SELECT id, name, slug FROM collections WHERE parent_id IS NULL OR parent_id = 0 ORDER BY name ASC");
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            error_log("Collection::parents() error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Create a new collection in the database
     */
    public static function create(array $data)
    {
        $db = self::getDB();
        if (!$db) return false;

        $name = trim($data['name'] ?? $data['title'] ?? '');
        if (empty($name)) return false;

        $slug = trim($data['slug'] ?? '');
        if (empty($slug)) {
            $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));
            $slug = trim($slug, '-');
        }

        $customUrlPath = trim($data['custom_url_path'] ?? '');
        if (empty($customUrlPath)) {
            $customUrlPath = '/collections/' . $slug;
        }

        $parentId = !empty($data['parent_id']) ? (int)$data['parent_id'] : null;
        $headerImageUrl = isset($data['header_image_url']) ? trim($data['header_image_url']) : (isset($data['image']) ? trim($data['image']) : '');
        $shortDescription = trim($data['short_description'] ?? $data['description'] ?? '');
        $metaTitle = trim($data['meta_title'] ?? $data['seo_title'] ?? ($name . ' | New Vape'));
        $metaDesc = trim($data['meta_desc'] ?? $data['seo_description'] ?? $shortDescription);
        $sortOrder = isset($data['sort_order']) ? (int)$data['sort_order'] : 0;
        $isActive = isset($data['is_active']) ? (int)$data['is_active'] : 1;

        try {
            $sql = "INSERT INTO collections 
                    (parent_id, name, slug, custom_url_path, header_image_url, short_description, meta_title, meta_desc, sort_order, is_active)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $db->prepare($sql);
            $stmt->execute([
                $parentId,
                $name,
                $slug,
                $customUrlPath,
                $headerImageUrl,
                $shortDescription,
                $metaTitle,
                $metaDesc,
                $sortOrder,
                $isActive
            ]);

            return (int)$db->lastInsertId();
        } catch (\Exception $e) {
            error_log("Collection::create() error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Update an existing collection in the database
     */
    public static function update($id, array $data)
    {
        $db = self::getDB();
        if (!$db) return false;

        $name = trim($data['name'] ?? $data['title'] ?? '');
        if (empty($name)) return false;

        $slug = trim($data['slug'] ?? '');
        if (empty($slug)) {
            $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));
            $slug = trim($slug, '-');
        }

        $customUrlPath = trim($data['custom_url_path'] ?? '');
        if (empty($customUrlPath)) {
            $customUrlPath = '/collections/' . $slug;
        }

        $parentId = !empty($data['parent_id']) ? (int)$data['parent_id'] : null;
        $hasImageKey = array_key_exists('header_image_url', $data) || array_key_exists('image', $data);
        $headerImageUrl = array_key_exists('header_image_url', $data) ? trim($data['header_image_url']) : (array_key_exists('image', $data) ? trim($data['image']) : null);
        $shortDescription = trim($data['short_description'] ?? $data['description'] ?? '');
        $metaTitle = trim($data['meta_title'] ?? $data['seo_title'] ?? ($name . ' | New Vape'));
        $metaDesc = trim($data['meta_desc'] ?? $data['seo_description'] ?? $shortDescription);
        $sortOrder = isset($data['sort_order']) ? (int)$data['sort_order'] : 0;
        $isActive = isset($data['is_active']) ? (int)$data['is_active'] : 1;

        try {
            if ($hasImageKey) {
                $sql = "UPDATE collections 
                        SET parent_id = ?, name = ?, slug = ?, custom_url_path = ?, header_image_url = ?, 
                            short_description = ?, meta_title = ?, meta_desc = ?, sort_order = ?, is_active = ?
                        WHERE id = ?";
                $params = [
                    $parentId, $name, $slug, $customUrlPath, $headerImageUrl,
                    $shortDescription, $metaTitle, $metaDesc, $sortOrder, $isActive, (int)$id
                ];
            } else {
                $sql = "UPDATE collections 
                        SET parent_id = ?, name = ?, slug = ?, custom_url_path = ?, 
                            short_description = ?, meta_title = ?, meta_desc = ?, sort_order = ?, is_active = ?
                        WHERE id = ?";
                $params = [
                    $parentId, $name, $slug, $customUrlPath,
                    $shortDescription, $metaTitle, $metaDesc, $sortOrder, $isActive, (int)$id
                ];
            }

            $stmt = $db->prepare($sql);
            return $stmt->execute($params);
        } catch (\Exception $e) {
            error_log("Collection::update() error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete a collection from the database
     */
    public static function delete($id)
    {
        $db = self::getDB();
        if (!$db) return false;

        try {
            // Delete product associations first (handled by foreign key cascade, or explicit)
            $db->prepare("DELETE FROM product_collections WHERE collection_id = ?")->execute([(int)$id]);
            
            // Reassign any child collections to null parent
            $db->prepare("UPDATE collections SET parent_id = NULL WHERE parent_id = ?")->execute([(int)$id]);

            // Delete the collection
            $stmt = $db->prepare("DELETE FROM collections WHERE id = ?");
            return $stmt->execute([(int)$id]);
        } catch (\Exception $e) {
            error_log("Collection::delete() error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get main featured vape categories for homepage and storefront display
     */
    public static function getMainCategories($limit = 4)
    {
        $db = self::getDB();
        if (!$db) return [];

        try {
            $sql = "SELECT c.*, 
                           COUNT(pc.product_id) AS products_count 
                    FROM collections c
                    LEFT JOIN product_collections pc ON c.id = pc.collection_id
                    WHERE c.is_active = 1 AND (c.parent_id IS NULL OR c.parent_id = 0)
                    GROUP BY c.id
                    ORDER BY c.sort_order ASC, c.id ASC";
            
            if ($limit !== null && $limit > 0) {
                $sql .= " LIMIT " . (int)$limit;
            }

            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            error_log("Collection::getMainCategories() error: " . $e->getMessage());
            return [];
        }
    }
}
