<?php
$page_title = 'Theme Sections | Vape Store Admin';
$current_admin_page = 'theme-sections';
include dirname(__DIR__) . '/includes/header.php';

$activeTab = $activeTab ?? 'hero';
?>

<!-- Title & Action Bar -->
<div class="page-title-bar">
  <div class="page-heading-group">
    <h1>Theme &amp; UI Sections</h1>
    <p class="page-subtitle">Customize storefront banners, header announcements, and promotional cards in real-time.</p>
  </div>
  <div class="page-actions-group">
    <a href="<?= url() ?>" target="_blank" class="btn-admin btn-admin-secondary" style="display: inline-flex; align-items: center; gap: 8px;">
      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
        <polyline points="15 3 21 3 21 9"></polyline>
        <line x1="10" y1="14" x2="21" y2="3"></line>
      </svg>
      <span>View Live Storefront</span>
    </a>
  </div>
</div>

<!-- Flash Notifications -->
<?php if (!empty($success)): ?>
<div class="admin-alert admin-alert-success mb-lg">
  <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
    <polyline points="22 4 12 14.01 9 11.01"></polyline>
  </svg>
  <span><?= e($success) ?></span>
</div>
<?php endif; ?>

<?php if (!empty($error)): ?>
<div class="admin-alert admin-alert-danger mb-lg">
  <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
    <circle cx="12" cy="12" r="10"></circle>
    <line x1="12" y1="8" x2="12" y2="12"></line>
    <line x1="12" y1="16" x2="12.01" y2="16"></line>
  </svg>
  <span><?= e($error) ?></span>
</div>
<?php endif; ?>

<!-- Tabs Navigation -->
<div class="theme-sections-tabs-bar" style="display: flex; gap: 10px; border-bottom: 2px solid #e2e8f0; margin-bottom: 24px; padding-bottom: 0;">
  <a href="<?= url('admin/theme-sections?tab=hero') ?>" class="theme-tab-btn <?= $activeTab === 'hero' ? 'active' : '' ?>">
    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
      <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
      <line x1="8" y1="21" x2="16" y2="21"></line>
      <line x1="12" y1="17" x2="12" y2="21"></line>
    </svg>
    <span>Hero Slider Banners</span>
  </a>
  <a href="<?= url('admin/theme-sections?tab=announcements') ?>" class="theme-tab-btn <?= $activeTab === 'announcements' ? 'active' : '' ?>">
    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
      <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
      <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
    </svg>
    <span>Announcement Bars</span>
  </a>
  <a href="<?= url('admin/theme-sections?tab=twin') ?>" class="theme-tab-btn <?= $activeTab === 'twin' ? 'active' : '' ?>">
    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
      <rect x="3" y="3" width="8" height="18" rx="1"></rect>
      <rect x="13" y="3" width="8" height="18" rx="1"></rect>
    </svg>
    <span>Promo Banner Cards</span>
  </a>
</div>

<!-- Custom Tab Styling -->
<style>
.theme-tab-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 12px 20px;
  font-weight: 600;
  font-size: 14px;
  color: #64748b;
  text-decoration: none;
  border-bottom: 3px solid transparent;
  margin-bottom: -2px;
  transition: all 0.2s ease;
}
.theme-tab-btn:hover {
  color: #0f172a;
}
.theme-tab-btn.active {
  color: #f97316;
  border-bottom-color: #f97316;
}
.theme-card-preview {
  position: relative;
  border-radius: 12px;
  overflow: hidden;
  background-color: #0f172a;
  min-height: 220px;
  display: flex;
  align-items: center;
  box-shadow: 0 4px 15px rgba(0,0,0,0.12);
}
.theme-card-preview-bg {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center right;
  z-index: 1;
}
.theme-card-preview-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(90deg, rgba(10, 14, 20, 0.95) 0%, rgba(10, 14, 20, 0.75) 45%, rgba(10, 14, 20, 0.25) 100%);
  z-index: 2;
}
.theme-card-preview-content {
  position: relative;
  z-index: 3;
  padding: 24px;
  max-width: 480px;
}
.toggle-switch-wrapper {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  cursor: pointer;
  user-select: none;
}
.toggle-switch {
  position: relative;
  width: 46px;
  height: 24px;
  background-color: #cbd5e1;
  border-radius: 24px;
  transition: background-color 0.2s ease;
}
.toggle-switch input {
  opacity: 0;
  width: 0;
  height: 0;
}
.toggle-slider {
  position: absolute;
  cursor: pointer;
  top: 2px;
  left: 2px;
  right: 2px;
  bottom: 2px;
  background-color: #cbd5e1;
  transition: .3s;
  border-radius: 24px;
}
.toggle-slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: 2px;
  bottom: 0px;
  background-color: white;
  transition: .3s;
  border-radius: 50%;
  box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}
input:checked + .toggle-slider {
  background-color: #10b981;
}
input:checked + .toggle-slider:before {
  transform: translateX(20px);
}
</style>

<!-- =========================================================================
     TAB 1: HERO SLIDER BANNERS
     ========================================================================= -->
<?php if ($activeTab === 'hero'): ?>
<form action="<?= url('admin/theme-sections/save-hero') ?>" method="POST" id="heroSliderForm">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <div>
      <h2 style="font-size: 18px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;">Hero Slider Banners</h2>
      <p style="font-size: 13px; color: #64748b; margin: 0;">Add, reorder or configure main visual banners with live interactive storefront previews.</p>
    </div>
    <div style="display: flex; gap: 10px;">
      <button type="button" id="addNewSlideBtn" class="btn-admin btn-admin-secondary" style="display: inline-flex; align-items: center; gap: 6px;">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5">
          <line x1="12" y1="5" x2="12" y2="19"></line>
          <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        <span>Add Slide</span>
      </button>
      <button type="submit" class="btn-admin btn-admin-primary" style="display: inline-flex; align-items: center; gap: 6px; padding: 0 20px;">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
          <polyline points="17 21 17 13 7 13 7 21"></polyline>
          <polyline points="7 3 7 8 15 8"></polyline>
        </svg>
        <span>Save All Slides</span>
      </button>
    </div>
  </div>

  <div id="slidesContainer" style="display: flex; flex-direction: column; gap: 24px;">
    <?php foreach ($heroSlides as $idx => $slide): ?>
    <div class="admin-card hero-slide-card" data-slide-index="<?= $idx ?>" style="padding: 24px; position: relative;">
      
      <!-- Slide Top Header -->
      <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f1f5f9; padding-bottom: 14px; margin-bottom: 20px;">
        <div style="display: flex; align-items: center; gap: 12px;">
          <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 6px; background: #f97316; color: #fff; font-weight: 700; font-size: 13px;">
            <?= $idx + 1 ?>
          </span>
          <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0;">Slide #<?= $idx + 1 ?>: <span class="slide-header-title"><?= e($slide['title']) ?></span></h3>
        </div>
        <div style="display: flex; align-items: center; gap: 16px;">
          <label class="toggle-switch-wrapper">
            <span style="font-size: 13px; font-weight: 600; color: #475569;">Active:</span>
            <div class="toggle-switch">
              <input type="hidden" name="slides[<?= $idx ?>][is_active]" value="0">
              <input type="checkbox" name="slides[<?= $idx ?>][is_active]" value="1" <?= !empty($slide['is_active']) ? 'checked' : '' ?> class="slide-active-toggle">
              <span class="toggle-slider"></span>
            </div>
          </label>
          <button type="button" class="btn-admin btn-admin-danger remove-slide-btn" style="padding: 6px 10px; font-size: 12px; height: auto;" title="Remove this slide">
            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="3 6 5 6 21 6"></polyline>
              <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
            </svg>
            <span>Delete</span>
          </button>
        </div>
      </div>

      <!-- Grid: Form Left, Realtime Preview Right -->
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; align-items: start;">
        
        <!-- Form Controls -->
        <div style="display: flex; flex-direction: column; gap: 14px;">
          <div class="admin-form-group">
            <label class="admin-form-label" style="font-weight: 600;">Badge / Pill Tag</label>
            <input type="text" name="slides[<?= $idx ?>][badge_text]" class="admin-form-input slide-badge-input" value="<?= e($slide['badge_text'] ?? 'NEW FLAVORS') ?>" placeholder="e.g. NEW FLAVORS">
          </div>

          <div class="admin-form-group">
            <label class="admin-form-label" style="font-weight: 600;">Main Heading / Title <span style="color: #ef4444;">*</span></label>
            <input type="text" name="slides[<?= $idx ?>][title]" class="admin-form-input slide-title-input" value="<?= e($slide['title']) ?>" placeholder="e.g. Every Flavor. In Stock." required>
          </div>

          <div class="admin-form-group">
            <label class="admin-form-label" style="font-weight: 600;">Subtitle / Description</label>
            <textarea name="slides[<?= $idx ?>][subtitle]" class="admin-form-input slide-subtitle-input" rows="2" placeholder="e.g. The full Foger Switch Pro lineup is here."><?= e($slide['subtitle']) ?></textarea>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div class="admin-form-group">
              <label class="admin-form-label" style="font-weight: 600;">CTA Button Text</label>
              <input type="text" name="slides[<?= $idx ?>][button_text]" class="admin-form-input slide-btn-text-input" value="<?= e($slide['button_text']) ?>" placeholder="e.g. Find Your Flavor">
            </div>
            <div class="admin-form-group">
              <label class="admin-form-label" style="font-weight: 600;">CTA Target URL</label>
              <input type="text" name="slides[<?= $idx ?>][button_url]" class="admin-form-input slide-btn-url-input" value="<?= e($slide['button_url']) ?>" placeholder="e.g. category?b=foger">
            </div>
          </div>

          <div class="admin-form-group">
            <label class="admin-form-label" style="font-weight: 600;">Banner Image URL or Path</label>
            <input type="text" name="slides[<?= $idx ?>][image_url]" class="admin-form-input slide-img-input" value="<?= e($slide['image_url']) ?>" placeholder="e.g. assets/images/foger-switch-pro-new-pod-flavors-d-banner.webp">
            <div style="font-size: 11px; color: #64748b; margin-top: 4px;">
              Presets: 
              <a href="#" class="preset-img-link" data-url="assets/images/foger-switch-pro-new-pod-flavors-d-banner.webp" style="color: #f97316;">Foger Banner</a> | 
              <a href="#" class="preset-img-link" data-url="assets/images/banner-1.webp" style="color: #f97316;">Banner 1</a> | 
              <a href="#" class="preset-img-link" data-url="assets/images/banner-2.webp" style="color: #f97316;">Banner 2</a> | 
              <a href="#" class="preset-img-link" data-url="assets/images/banner-3.webp" style="color: #f97316;">Banner 3</a>
            </div>
          </div>
        </div>

        <!-- Live Preview Card -->
        <div>
          <label style="display: block; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 8px; letter-spacing: 0.05em;">Live Preview</label>
          <div class="theme-card-preview">
            <img src="<?= e($slide['image_url']) ?>" alt="Banner Preview" class="theme-card-preview-bg slide-preview-img" onerror="this.src='assets/images/foger-switch-pro-new-pod-flavors-d-banner.webp'">
            <div class="theme-card-preview-overlay"></div>
            <div class="theme-card-preview-content">
              <div style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; background: rgba(249, 115, 22, 0.2); border: 1px solid rgba(249, 115, 22, 0.4); border-radius: 999px; color: #f97316; font-size: 11px; font-weight: 800; text-transform: uppercase; margin-bottom: 10px;">
                <span style="width: 5px; height: 5px; background: #f97316; border-radius: 50%;"></span>
                <span class="slide-preview-badge"><?= e($slide['badge_text'] ?? 'NEW FLAVORS') ?></span>
              </div>
              <h2 class="slide-preview-title" style="font-size: 20px; font-weight: 800; color: #ffffff; line-height: 1.2; margin: 0 0 8px 0;"><?= e($slide['title']) ?></h2>
              <p class="slide-preview-subtitle" style="font-size: 13px; color: #e2e8f0; line-height: 1.4; margin: 0 0 16px 0;"><?= e($slide['subtitle']) ?></p>
              <div class="slide-preview-btn" style="display: inline-flex; align-items: center; gap: 6px; background: #f97316; color: #fff; font-size: 12px; font-weight: 700; padding: 8px 16px; border-radius: 6px;">
                <span class="slide-preview-btn-text"><?= e($slide['button_text']) ?></span>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5">
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                  <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
    <?php endforeach; ?>
  </div>

  <div style="margin-top: 24px; padding: 16px 24px; background: #fff; border-radius: 10px; border: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
    <span style="font-size: 13px; color: #64748b;">Remember to save your changes to apply updates to the live storefront.</span>
    <button type="submit" class="btn-admin btn-admin-primary" style="padding: 10px 24px; font-weight: 700;">
      Save All Slides
    </button>
  </div>
</form>

<?php endif; ?>

<!-- =========================================================================
     TAB 2: ANNOUNCEMENT BARS
     ========================================================================= -->
<?php if ($activeTab === 'announcements'): ?>
<form action="<?= url('admin/theme-sections/save-announcements') ?>" method="POST">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <div>
      <h2 style="font-size: 18px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;">Announcement &amp; Compliance Bars</h2>
      <p style="font-size: 13px; color: #64748b; margin: 0;">Configure the top FDA nicotine warning notification and promotional free shipping header bars.</p>
    </div>
    <button type="submit" class="btn-admin btn-admin-primary" style="display: inline-flex; align-items: center; gap: 6px; padding: 0 20px;">
      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
        <polyline points="17 21 17 13 7 13 7 21"></polyline>
        <polyline points="7 3 7 8 15 8"></polyline>
      </svg>
      <span>Save Announcement Bars</span>
    </button>
  </div>

  <div style="display: flex; flex-direction: column; gap: 24px;">

    <!-- Bar 1: FDA Nicotine Warning Bar -->
    <div class="admin-card" style="padding: 24px;">
      <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f1f5f9; padding-bottom: 14px; margin-bottom: 20px;">
        <div>
          <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 2px 0;">Top Bar 1: FDA Nicotine Warning Banner</h3>
          <p style="font-size: 13px; color: #64748b; margin: 0;">Federal compliance bar displayed at the very top of all pages.</p>
        </div>
        <label class="toggle-switch-wrapper">
          <span style="font-size: 13px; font-weight: 600; color: #475569;">Show Bar:</span>
          <div class="toggle-switch">
            <input type="checkbox" name="fda_warning_active" value="1" <?= !empty($announcements['fda_warning_active']) ? 'checked' : '' ?> id="fdaActiveToggle">
            <span class="toggle-slider"></span>
          </div>
        </label>
      </div>

      <!-- Live Preview -->
      <label style="display: block; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 8px; letter-spacing: 0.05em;">Storefront Live Preview</label>
      <div id="fdaPreviewBar" style="background: #000000; color: #ffffff; padding: 8px 16px; text-align: center; font-size: 12px; font-weight: 700; border-radius: 6px; margin-bottom: 20px; transition: opacity 0.2s ease; <?= empty($announcements['fda_warning_active']) ? 'opacity: 0.4;' : '' ?>">
        <span id="fdaPreviewText"><?= $announcements['fda_warning_text'] ?></span>
      </div>

      <!-- Form Field -->
      <div class="admin-form-group" style="margin-bottom: 0;">
        <label class="admin-form-label" style="font-weight: 600;">Warning Text (HTML allowed for &lt;strong&gt; tag)</label>
        <textarea name="fda_warning_text" id="fdaTextInput" rows="2" class="admin-form-input"><?= e($announcements['fda_warning_text']) ?></textarea>
        <span style="font-size: 12px; color: #64748b; margin-top: 4px; display: block;">Standard: WARNING: This product contains nicotine. Nicotine is an addictive chemical.</span>
      </div>
    </div>

    <!-- Bar 2: Free Shipping Promo Bar -->
    <div class="admin-card" style="padding: 24px;">
      <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f1f5f9; padding-bottom: 14px; margin-bottom: 20px;">
        <div>
          <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 2px 0;">Top Bar 2: Promotional Announcement Header Bar</h3>
          <p style="font-size: 13px; color: #64748b; margin: 0;">Highlights shipping deals, coupon codes or special discounts.</p>
        </div>
        <label class="toggle-switch-wrapper">
          <span style="font-size: 13px; font-weight: 600; color: #475569;">Show Bar:</span>
          <div class="toggle-switch">
            <input type="checkbox" name="promo_bar_active" value="1" <?= !empty($announcements['promo_bar_active']) ? 'checked' : '' ?> id="promoActiveToggle">
            <span class="toggle-slider"></span>
          </div>
        </label>
      </div>

      <!-- Live Preview -->
      <label style="display: block; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 8px; letter-spacing: 0.05em;">Storefront Live Preview</label>
      <div id="promoPreviewBar" style="background: #111827; color: #f97316; padding: 10px 16px; text-align: center; font-size: 13px; font-weight: 700; border-radius: 6px; margin-bottom: 20px; transition: opacity 0.2s ease; <?= empty($announcements['promo_bar_active']) ? 'opacity: 0.4;' : '' ?>">
        <span id="promoPreviewText"><?= e($announcements['promo_bar_text']) ?></span>
      </div>

      <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 16px;">
        <div class="admin-form-group" style="margin-bottom: 0;">
          <label class="admin-form-label" style="font-weight: 600;">Announcement Headline / Text</label>
          <input type="text" name="promo_bar_text" id="promoTextInput" class="admin-form-input" value="<?= e($announcements['promo_bar_text']) ?>" placeholder="e.g. Free shipping on orders over $150">
        </div>

        <div class="admin-form-group" style="margin-bottom: 0;">
          <label class="admin-form-label" style="font-weight: 600;">Target URL (Optional)</label>
          <input type="text" name="promo_bar_link" class="admin-form-input" value="<?= e($announcements['promo_bar_link']) ?>" placeholder="e.g. category or https://...">
        </div>
      </div>
    </div>

  </div>

  <div style="margin-top: 24px; padding: 16px 24px; background: #fff; border-radius: 10px; border: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
    <span style="font-size: 13px; color: #64748b;">Updates take effect across all storefront header layouts instantly.</span>
    <button type="submit" class="btn-admin btn-admin-primary" style="padding: 10px 24px; font-weight: 700;">
      Save Announcement Bars
    </button>
  </div>
</form>
<?php endif; ?>

<!-- =========================================================================
     TAB 3: PROMO BANNER CARDS (TWIN BANNERS)
     ========================================================================= -->
<?php if ($activeTab === 'twin'): ?>
<form action="<?= url('admin/theme-sections/save-twin-banners') ?>" method="POST">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <div>
      <h2 style="font-size: 18px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;">Twin Promotional Cards</h2>
      <p style="font-size: 13px; color: #64748b; margin: 0;">Configure the two prominent featured promo cards on the homepage (Foger Switch Pro &amp; Adjust Lineup).</p>
    </div>
    <button type="submit" class="btn-admin btn-admin-primary" style="display: inline-flex; align-items: center; gap: 6px; padding: 0 20px;">
      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
        <polyline points="17 21 17 13 7 13 7 21"></polyline>
        <polyline points="7 3 7 8 15 8"></polyline>
      </svg>
      <span>Save Promo Cards</span>
    </button>
  </div>

  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
    <?php foreach ($twinBanners as $i => $card): ?>
    <div class="admin-card twin-card-editor" data-card-index="<?= $i ?>" style="padding: 24px;">
      <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f1f5f9; padding-bottom: 14px; margin-bottom: 16px;">
        <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0;">Card <?= $i + 1 ?>: <?= $i === 0 ? 'Left Card' : 'Right Card' ?></h3>
        <label class="toggle-switch-wrapper">
          <span style="font-size: 13px; font-weight: 600; color: #475569;">Active:</span>
          <div class="toggle-switch">
            <input type="hidden" name="banners[<?= $i ?>][is_active]" value="0">
            <input type="checkbox" name="banners[<?= $i ?>][is_active]" value="1" <?= !empty($card['is_active']) ? 'checked' : '' ?>>
            <span class="toggle-slider"></span>
          </div>
        </label>
      </div>

      <!-- Live Mini Preview -->
      <label style="display: block; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 8px; letter-spacing: 0.05em;">Live Preview</label>
      <div style="position: relative; border-radius: 12px; overflow: hidden; min-height: 180px; background: #0f172a; margin-bottom: 20px; display: flex; align-items: center; box-shadow: 0 4px 15px rgba(0,0,0,0.12);">
        <img src="<?= e($card['image_url']) ?>" alt="Card Preview" class="twin-preview-img" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;" onerror="this.src='assets/images/twin-banner.webp'">
        <div style="position: absolute; inset: 0; background: linear-gradient(90deg, rgba(10, 14, 20, 0.92) 0%, rgba(10, 14, 20, 0.65) 50%, rgba(10, 14, 20, 0.2) 100%); z-index: 2;"></div>
        <div style="position: relative; z-index: 3; padding: 20px; max-width: 320px;">
          <h4 class="twin-preview-title" style="color: #fff; font-size: 16px; font-weight: 800; line-height: 1.25; margin: 0 0 6px 0;"><?= $card['title'] ?></h4>
          <p class="twin-preview-subtitle" style="color: #cbd5e1; font-size: 12px; margin: 0 0 12px 0; line-height: 1.4;"><?= $card['subtitle'] ?></p>
          <div style="display: inline-flex; align-items: center; gap: 6px; background: #f97316; color: #fff; font-size: 11px; font-weight: 700; padding: 6px 14px; border-radius: 6px;">
            <span class="twin-preview-btn-text"><?= e($card['button_text']) ?></span>
            <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5">
              <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
          </div>
        </div>
      </div>

      <!-- Controls -->
      <div style="display: flex; flex-direction: column; gap: 14px;">
        <div class="admin-form-group">
          <label class="admin-form-label" style="font-weight: 600;">Card Title <span style="color: #ef4444;">*</span></label>
          <input type="text" name="banners[<?= $i ?>][title]" class="admin-form-input twin-title-input" value="<?= e($card['title']) ?>" placeholder="e.g. Foger Switch Pro &mdash; Up to 30,000 Puffs" required>
        </div>

        <div class="admin-form-group">
          <label class="admin-form-label" style="font-weight: 600;">Card Subtitle</label>
          <textarea name="banners[<?= $i ?>][subtitle]" class="admin-form-input twin-subtitle-input" rows="2" placeholder="e.g. Pod system with power bank &amp; OLED display."><?= e($card['subtitle']) ?></textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
          <div class="admin-form-group">
            <label class="admin-form-label" style="font-weight: 600;">Button Text</label>
            <input type="text" name="banners[<?= $i ?>][button_text]" class="admin-form-input twin-btn-text-input" value="<?= e($card['button_text']) ?>" placeholder="e.g. Shop Foger Switch Pro">
          </div>
          <div class="admin-form-group">
            <label class="admin-form-label" style="font-weight: 600;">Button Target Link</label>
            <input type="text" name="banners[<?= $i ?>][button_url]" class="admin-form-input twin-btn-url-input" value="<?= e($card['button_url']) ?>" placeholder="e.g. category?b=foger">
          </div>
        </div>

        <div class="admin-form-group" style="margin-bottom: 0;">
          <label class="admin-form-label" style="font-weight: 600;">Background Image URL</label>
          <input type="text" name="banners[<?= $i ?>][image_url]" class="admin-form-input twin-img-input" value="<?= e($card['image_url']) ?>" placeholder="e.g. assets/images/twin-banner.webp">
          <div style="font-size: 11px; color: #64748b; margin-top: 4px;">
            Presets: 
            <a href="#" class="preset-twin-link" data-url="assets/images/twin-banner.webp" style="color: #f97316;">Default Twin Banner</a> | 
            <a href="#" class="preset-twin-link" data-url="assets/images/banner-1.webp" style="color: #f97316;">Banner 1</a> | 
            <a href="#" class="preset-twin-link" data-url="assets/images/banner-2.webp" style="color: #f97316;">Banner 2</a>
          </div>
        </div>
      </div>

    </div>
    <?php endforeach; ?>
  </div>

  <div style="margin-top: 24px; padding: 16px 24px; background: #fff; border-radius: 10px; border: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
    <span style="font-size: 13px; color: #64748b;">Saves both left and right promo cards instantly.</span>
    <button type="submit" class="btn-admin btn-admin-primary" style="padding: 10px 24px; font-weight: 700;">
      Save Promo Cards
    </button>
  </div>
</form>
<?php endif; ?>

<!-- Realtime Client-Side Interactive Logic -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  // 1. Hero Slides Realtime Feedback
  const bindHeroCard = (card) => {
    const badgeInput = card.querySelector('.slide-badge-input');
    const titleInput = card.querySelector('.slide-title-input');
    const subtitleInput = card.querySelector('.slide-subtitle-input');
    const btnTextInput = card.querySelector('.slide-btn-text-input');
    const imgInput = card.querySelector('.slide-img-input');

    const previewBadge = card.querySelector('.slide-preview-badge');
    const previewTitle = card.querySelector('.slide-preview-title');
    const previewSubtitle = card.querySelector('.slide-preview-subtitle');
    const previewBtnText = card.querySelector('.slide-preview-btn-text');
    const previewImg = card.querySelector('.slide-preview-img');
    const headerTitle = card.querySelector('.slide-header-title');

    if (badgeInput && previewBadge) {
      badgeInput.addEventListener('input', () => {
        previewBadge.textContent = badgeInput.value || 'NEW FLAVORS';
      });
    }

    if (titleInput && previewTitle) {
      titleInput.addEventListener('input', () => {
        previewTitle.textContent = titleInput.value || 'Banner Title';
        if (headerTitle) headerTitle.textContent = titleInput.value || 'Untitled';
      });
    }

    if (subtitleInput && previewSubtitle) {
      subtitleInput.addEventListener('input', () => {
        previewSubtitle.textContent = subtitleInput.value || '';
      });
    }

    if (btnTextInput && previewBtnText) {
      btnTextInput.addEventListener('input', () => {
        previewBtnText.textContent = btnTextInput.value || 'Shop Now';
      });
    }

    if (imgInput && previewImg) {
      imgInput.addEventListener('input', () => {
        previewImg.src = imgInput.value;
      });
    }

    // Presets
    card.querySelectorAll('.preset-img-link').forEach(link => {
      link.addEventListener('click', (e) => {
        e.preventDefault();
        const url = link.getAttribute('data-url');
        if (imgInput && previewImg) {
          imgInput.value = url;
          previewImg.src = url;
        }
      });
    });

    // Remove slide
    const removeBtn = card.querySelector('.remove-slide-btn');
    if (removeBtn) {
      removeBtn.addEventListener('click', () => {
        const total = document.querySelectorAll('.hero-slide-card').length;
        if (total <= 1) {
          alert('You must have at least one hero banner slide.');
          return;
        }
        if (confirm('Are you sure you want to delete this slide?')) {
          card.remove();
          reindexHeroSlides();
        }
      });
    }
  };

  const reindexHeroSlides = () => {
    const cards = document.querySelectorAll('.hero-slide-card');
    cards.forEach((card, index) => {
      card.setAttribute('data-slide-index', index);
      const badgeIndex = card.querySelector('span[style*="background: #f97316"]');
      if (badgeIndex) badgeIndex.textContent = index + 1;
      
      card.querySelectorAll('input, textarea, select').forEach(input => {
        const name = input.getAttribute('name');
        if (name) {
          input.setAttribute('name', name.replace(/slides\[\d+\]/, `slides[${index}]`));
        }
      });
    });
  };

  document.querySelectorAll('.hero-slide-card').forEach(bindHeroCard);

  // Add New Slide Button
  const addBtn = document.getElementById('addNewSlideBtn');
  const container = document.getElementById('slidesContainer');
  if (addBtn && container) {
    addBtn.addEventListener('click', () => {
      const cards = document.querySelectorAll('.hero-slide-card');
      const newIndex = cards.length;
      
      const newCardHtml = `
      <div class="admin-card hero-slide-card" data-slide-index="${newIndex}" style="padding: 24px; position: relative;">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f1f5f9; padding-bottom: 14px; margin-bottom: 20px;">
          <div style="display: flex; align-items: center; gap: 12px;">
            <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 6px; background: #f97316; color: #fff; font-weight: 700; font-size: 13px;">
              ${newIndex + 1}
            </span>
            <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0;">Slide #${newIndex + 1}: <span class="slide-header-title">New Banner Slide</span></h3>
          </div>
          <div style="display: flex; align-items: center; gap: 16px;">
            <label class="toggle-switch-wrapper">
              <span style="font-size: 13px; font-weight: 600; color: #475569;">Active:</span>
              <div class="toggle-switch">
                <input type="hidden" name="slides[${newIndex}][is_active]" value="0">
                <input type="checkbox" name="slides[${newIndex}][is_active]" value="1" checked class="slide-active-toggle">
                <span class="toggle-slider"></span>
              </div>
            </label>
            <button type="button" class="btn-admin btn-admin-danger remove-slide-btn" style="padding: 6px 10px; font-size: 12px; height: auto;" title="Remove this slide">
              <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
              </svg>
              <span>Delete</span>
            </button>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; align-items: start;">
          <div style="display: flex; flex-direction: column; gap: 14px;">
            <div class="admin-form-group">
              <label class="admin-form-label" style="font-weight: 600;">Badge / Pill Tag</label>
              <input type="text" name="slides[${newIndex}][badge_text]" class="admin-form-input slide-badge-input" value="FEATURED SPECIAL" placeholder="e.g. NEW FLAVORS">
            </div>

            <div class="admin-form-group">
              <label class="admin-form-label" style="font-weight: 600;">Main Heading / Title <span style="color: #ef4444;">*</span></label>
              <input type="text" name="slides[${newIndex}][title]" class="admin-form-input slide-title-input" value="Premium Disposable Collection" placeholder="e.g. Every Flavor. In Stock." required>
            </div>

            <div class="admin-form-group">
              <label class="admin-form-label" style="font-weight: 600;">Subtitle / Description</label>
              <textarea name="slides[${newIndex}][subtitle]" class="admin-form-input slide-subtitle-input" rows="2" placeholder="e.g. The full Foger Switch Pro lineup is here.">Explore our top-rated disposables and e-liquids.</textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
              <div class="admin-form-group">
                <label class="admin-form-label" style="font-weight: 600;">CTA Button Text</label>
                <input type="text" name="slides[${newIndex}][button_text]" class="admin-form-input slide-btn-text-input" value="Shop Now" placeholder="e.g. Find Your Flavor">
              </div>
              <div class="admin-form-group">
                <label class="admin-form-label" style="font-weight: 600;">CTA Target URL</label>
                <input type="text" name="slides[${newIndex}][button_url]" class="admin-form-input slide-btn-url-input" value="category" placeholder="e.g. category?b=foger">
              </div>
            </div>

            <div class="admin-form-group">
              <label class="admin-form-label" style="font-weight: 600;">Banner Image URL or Path</label>
              <input type="text" name="slides[${newIndex}][image_url]" class="admin-form-input slide-img-input" value="assets/images/banner-1.webp" placeholder="e.g. assets/images/banner-1.webp">
              <div style="font-size: 11px; color: #64748b; margin-top: 4px;">
                Presets: 
                <a href="#" class="preset-img-link" data-url="assets/images/foger-switch-pro-new-pod-flavors-d-banner.webp" style="color: #f97316;">Foger Banner</a> | 
                <a href="#" class="preset-img-link" data-url="assets/images/banner-1.webp" style="color: #f97316;">Banner 1</a> | 
                <a href="#" class="preset-img-link" data-url="assets/images/banner-2.webp" style="color: #f97316;">Banner 2</a> | 
                <a href="#" class="preset-img-link" data-url="assets/images/banner-3.webp" style="color: #f97316;">Banner 3</a>
              </div>
            </div>
          </div>

          <div>
            <label style="display: block; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 8px; letter-spacing: 0.05em;">Live Preview</label>
            <div class="theme-card-preview">
              <img src="assets/images/banner-1.webp" alt="Banner Preview" class="theme-card-preview-bg slide-preview-img">
              <div class="theme-card-preview-overlay"></div>
              <div class="theme-card-preview-content">
                <div style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; background: rgba(249, 115, 22, 0.2); border: 1px solid rgba(249, 115, 22, 0.4); border-radius: 999px; color: #f97316; font-size: 11px; font-weight: 800; text-transform: uppercase; margin-bottom: 10px;">
                  <span style="width: 5px; height: 5px; background: #f97316; border-radius: 50%;"></span>
                  <span class="slide-preview-badge">FEATURED SPECIAL</span>
                </div>
                <h2 class="slide-preview-title" style="font-size: 20px; font-weight: 800; color: #ffffff; line-height: 1.2; margin: 0 0 8px 0;">Premium Disposable Collection</h2>
                <p class="slide-preview-subtitle" style="font-size: 13px; color: #e2e8f0; line-height: 1.4; margin: 0 0 16px 0;">Explore our top-rated disposables and e-liquids.</p>
                <div class="slide-preview-btn" style="display: inline-flex; align-items: center; gap: 6px; background: #f97316; color: #fff; font-size: 12px; font-weight: 700; padding: 8px 16px; border-radius: 6px;">
                  <span class="slide-preview-btn-text">Shop Now</span>
                  <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>`;

      const tempDiv = document.createElement('div');
      tempDiv.innerHTML = newCardHtml;
      const newCardEl = tempDiv.firstElementChild;
      container.appendChild(newCardEl);
      bindHeroCard(newCardEl);
      newCardEl.scrollIntoView({ behavior: 'smooth' });
    });
  }

  // 2. Announcements Realtime Feedback
  const fdaInput = document.getElementById('fdaTextInput');
  const fdaPreview = document.getElementById('fdaPreviewText');
  const fdaToggle = document.getElementById('fdaActiveToggle');
  const fdaBar = document.getElementById('fdaPreviewBar');

  if (fdaInput && fdaPreview) {
    fdaInput.addEventListener('input', () => {
      fdaPreview.innerHTML = fdaInput.value;
    });
  }
  if (fdaToggle && fdaBar) {
    fdaToggle.addEventListener('change', () => {
      fdaBar.style.opacity = fdaToggle.checked ? '1' : '0.35';
    });
  }

  const promoInput = document.getElementById('promoTextInput');
  const promoPreview = document.getElementById('promoPreviewText');
  const promoToggle = document.getElementById('promoActiveToggle');
  const promoBar = document.getElementById('promoPreviewBar');

  if (promoInput && promoPreview) {
    promoInput.addEventListener('input', () => {
      promoPreview.textContent = promoInput.value;
    });
  }
  if (promoToggle && promoBar) {
    promoToggle.addEventListener('change', () => {
      promoBar.style.opacity = promoToggle.checked ? '1' : '0.35';
    });
  }

  // 3. Twin Promo Realtime Feedback
  document.querySelectorAll('.twin-card-editor').forEach(editor => {
    const titleInput = editor.querySelector('.twin-title-input');
    const subtitleInput = editor.querySelector('.twin-subtitle-input');
    const btnTextInput = editor.querySelector('.twin-btn-text-input');
    const imgInput = editor.querySelector('.twin-img-input');

    const previewTitle = editor.querySelector('.twin-preview-title');
    const previewSubtitle = editor.querySelector('.twin-preview-subtitle');
    const previewBtnText = editor.querySelector('.twin-preview-btn-text');
    const previewImg = editor.querySelector('.twin-preview-img');

    if (titleInput && previewTitle) {
      titleInput.addEventListener('input', () => {
        previewTitle.innerHTML = titleInput.value;
      });
    }
    if (subtitleInput && previewSubtitle) {
      subtitleInput.addEventListener('input', () => {
        previewSubtitle.innerHTML = subtitleInput.value;
      });
    }
    if (btnTextInput && previewBtnText) {
      btnTextInput.addEventListener('input', () => {
        previewBtnText.textContent = btnTextInput.value;
      });
    }
    if (imgInput && previewImg) {
      imgInput.addEventListener('input', () => {
        previewImg.src = imgInput.value;
      });
    }

    editor.querySelectorAll('.preset-twin-link').forEach(link => {
      link.addEventListener('click', (e) => {
        e.preventDefault();
        const url = link.getAttribute('data-url');
        if (imgInput && previewImg) {
          imgInput.value = url;
          previewImg.src = url;
        }
      });
    });
  });
});
</script>

<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
