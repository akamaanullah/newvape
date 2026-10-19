<?php
namespace App\Controllers\Admin;

use App\Models\ThemeSection;

class ThemeSectionController extends AdminController
{
    /**
     * Display UI / Theme Sections management page
     */
    public function index()
    {
        $announcements = ThemeSection::getAnnouncementBars();
        $heroSlides = ThemeSection::getHeroSlides();
        $twinBanners = ThemeSection::getTwinBanners();

        $activeTab = $_GET['tab'] ?? 'hero';

        $this->render('admin.theme_sections.index', [
            'page_title'         => 'Theme Sections | Storefront UI Manager',
            'current_admin_page' => 'theme-sections',
            'page_script'        => 'theme-sections.js',
            'announcements'      => $announcements,
            'heroSlides'         => $heroSlides,
            'twinBanners'        => $twinBanners,
            'activeTab'          => $activeTab,
            'success'            => $_GET['success'] ?? null,
            'error'              => $_GET['error'] ?? null
        ]);
    }

    /**
     * Save Announcement & Warning bars
     */
    public function saveAnnouncements()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'fda_warning_active' => isset($_POST['fda_warning_active']) ? 1 : 0,
                'fda_warning_text'   => $_POST['fda_warning_text'] ?? '',
                'promo_bar_active'   => isset($_POST['promo_bar_active']) ? 1 : 0,
                'promo_bar_text'     => $_POST['promo_bar_text'] ?? '',
                'promo_bar_link'     => $_POST['promo_bar_link'] ?? ''
            ];

            if (ThemeSection::saveAnnouncementBars($data)) {
                $this->redirect('admin/theme-sections?tab=announcements&success=' . urlencode('Announcement and warning bars updated successfully'));
                return;
            }
        }

        $this->redirect('admin/theme-sections?tab=announcements&error=' . urlencode('Failed to update announcements'));
    }

    /**
     * Save Hero Banner Slides
     */
    public function saveHero()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $slides = $_POST['slides'] ?? [];
            if (!is_array($slides)) $slides = [];

            if (ThemeSection::saveHeroSlides($slides)) {
                $this->redirect('admin/theme-sections?tab=hero&success=' . urlencode('Hero slider banners updated successfully'));
                return;
            }
        }

        $this->redirect('admin/theme-sections?tab=hero&error=' . urlencode('Failed to save hero slider'));
    }

    /**
     * Save Twin Promo Banners
     */
    public function saveTwinBanners()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $banners = $_POST['banners'] ?? [];
            if (!is_array($banners)) $banners = [];

            if (ThemeSection::saveTwinBanners($banners)) {
                $this->redirect('admin/theme-sections?tab=twin&success=' . urlencode('Promo banner cards updated successfully'));
                return;
            }
        }

        $this->redirect('admin/theme-sections?tab=twin&error=' . urlencode('Failed to save promo banner cards'));
    }
}
