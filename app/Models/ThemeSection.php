<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class ThemeSection extends Model
{
    /**
     * Get a setting by key
     */
    public static function getSetting($key, $default = null)
    {
        $db = self::getDB();
        if (!$db) return $default;

        try {
            $stmt = $db->prepare("SELECT `value` FROM settings WHERE `key` = ? LIMIT 1");
            $stmt->execute([$key]);
            $val = $stmt->fetchColumn();
            return ($val !== false && $val !== null) ? $val : $default;
        } catch (\Exception $e) {
            error_log("ThemeSection::getSetting error: " . $e->getMessage());
            return $default;
        }
    }

    /**
     * Set or update a setting
     */
    public static function setSetting($key, $value, $group = 'storefront')
    {
        $db = self::getDB();
        if (!$db) return false;

        try {
            $stmt = $db->prepare("
                INSERT INTO settings (`key`, `value`, `group_name`) 
                VALUES (?, ?, ?) 
                ON DUPLICATE KEY UPDATE `value` = VALUES(`value`), `group_name` = VALUES(`group_name`)
            ");
            return $stmt->execute([$key, $value, $group]);
        } catch (\Exception $e) {
            error_log("ThemeSection::setSetting error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get Announcement & Warning Bars configuration
     */
    public static function getAnnouncementBars()
    {
        $raw = self::getSetting('theme_announcement_bars');
        if ($raw) {
            $decoded = json_decode($raw, true);
            if (is_array($decoded)) {
                return $decoded;
            }
        }

        // Return sensible default values
        return [
            'fda_warning_active' => 1,
            'fda_warning_text'   => 'WARNING: This product contains nicotine. Nicotine is an addictive chemical.',
            'promo_bar_active'   => 1,
            'promo_bar_text'     => 'Free shipping on orders over $150',
            'promo_bar_link'     => ''
        ];
    }

    /**
     * Save Announcement & Warning Bars configuration
     */
    public static function saveAnnouncementBars(array $data)
    {
        $clean = [
            'fda_warning_active' => !empty($data['fda_warning_active']) ? 1 : 0,
            'fda_warning_text'   => trim($data['fda_warning_text'] ?? 'WARNING: This product contains nicotine. Nicotine is an addictive chemical.'),
            'promo_bar_active'   => !empty($data['promo_bar_active']) ? 1 : 0,
            'promo_bar_text'     => trim($data['promo_bar_text'] ?? 'Free shipping on orders over $150'),
            'promo_bar_link'     => trim($data['promo_bar_link'] ?? '')
        ];

        return self::setSetting('theme_announcement_bars', json_encode($clean, JSON_UNESCAPED_UNICODE), 'storefront');
    }

    /**
     * Get Hero Banner Slides
     */
    public static function getHeroSlides()
    {
        $raw = self::getSetting('theme_hero_slides');
        if ($raw) {
            $decoded = json_decode($raw, true);
            if (is_array($decoded) && !empty($decoded)) {
                return $decoded;
            }
        }

        // Default initial slide
        return [
            [
                'id'          => 1,
                'badge_text'  => 'NEW FLAVORS',
                'title'       => 'Every Flavor. In Stock.',
                'subtitle'    => 'The full Foger Switch Pro lineup is here.',
                'button_text' => 'Find Your Flavor',
                'button_url'  => 'category?b=foger',
                'image_url'   => 'assets/images/foger-switch-pro-new-pod-flavors-d-banner.webp',
                'is_active'   => 1
            ]
        ];
    }

    /**
     * Save Hero Banner Slides
     */
    public static function saveHeroSlides(array $slides)
    {
        $clean = [];
        foreach ($slides as $idx => $s) {
            $title = trim($s['title'] ?? '');
            if (empty($title)) continue;

            $clean[] = [
                'id'          => $idx + 1,
                'badge_text'  => trim($s['badge_text'] ?? 'NEW ARRIVALS'),
                'title'       => $title,
                'subtitle'    => trim($s['subtitle'] ?? ''),
                'button_text' => trim($s['button_text'] ?? 'Shop Now'),
                'button_url'  => trim($s['button_url'] ?? 'category'),
                'image_url'   => trim($s['image_url'] ?? 'assets/images/foger-switch-pro-new-pod-flavors-d-banner.webp'),
                'is_active'   => isset($s['is_active']) ? (int)$s['is_active'] : 1
            ];
        }

        if (empty($clean)) {
            // keep at least 1 default
            $clean = self::getHeroSlides();
        }

        return self::setSetting('theme_hero_slides', json_encode($clean, JSON_UNESCAPED_UNICODE), 'storefront');
    }

    /**
     * Get Twin Promo Banners
     */
    public static function getTwinBanners()
    {
        $raw = self::getSetting('theme_twin_banners');
        if ($raw) {
            $decoded = json_decode($raw, true);
            if (is_array($decoded) && !empty($decoded)) {
                return $decoded;
            }
        }

        // Default twin banners
        return [
            [
                'id'          => 1,
                'title'       => 'Foger Switch Pro &mdash; Up to 30,000 Puffs',
                'subtitle'    => 'Pod system with power bank & OLED display.',
                'button_text' => 'Shop Foger Switch Pro',
                'button_url'  => 'category?b=foger',
                'image_url'   => 'assets/images/twin-banner.webp',
                'is_active'   => 1
            ],
            [
                'id'          => 2,
                'title'       => 'Entire Adjust Lineup',
                'subtitle'    => 'Tune your cool. Tune your flavor. Only $11.99.',
                'button_text' => 'Shop Adjust Series',
                'button_url'  => 'category?b=adjust',
                'image_url'   => 'assets/images/twin-banner.webp',
                'is_active'   => 1
            ]
        ];
    }

    /**
     * Save Twin Promo Banners
     */
    public static function saveTwinBanners(array $banners)
    {
        $clean = [];
        for ($i = 0; $i < 2; $i++) {
            $b = $banners[$i] ?? [];
            $clean[] = [
                'id'          => $i + 1,
                'title'       => trim($b['title'] ?? ''),
                'subtitle'    => trim($b['subtitle'] ?? ''),
                'button_text' => trim($b['button_text'] ?? 'Shop Now'),
                'button_url'  => trim($b['button_url'] ?? 'category'),
                'image_url'   => trim($b['image_url'] ?? 'assets/images/twin-banner.webp'),
                'is_active'   => isset($b['is_active']) ? (int)$b['is_active'] : 1
            ];
        }

        return self::setSetting('theme_twin_banners', json_encode($clean, JSON_UNESCAPED_UNICODE), 'storefront');
    }
}
