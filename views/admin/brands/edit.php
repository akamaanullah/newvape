<?php
$page_title = 'Edit Brand: ' . ($brand['name'] ?? 'Brand');
$current_admin_page = 'brands';
$page_script = 'brand-form.js';
include dirname(__DIR__) . '/includes/header.php';

$brandId = (int)($brand['id'] ?? 0);
$brandName = $brand['name'] ?? '';
$brandSlug = $brand['slug'] ?? '';
$brandDesc = $brand['description'] ?? '';
$brandLogo = $brand['logo_url'] ?? '';
$brandWebsite = $brand['website_url'] ?? '';
$brandSeoTitle = $brand['meta_title'] ?? ($brandName . ' Official Store | New Vape');
$brandSeoDesc = $brand['meta_desc'] ?? $brandDesc;
$brandStatus = !empty($brand['is_active']) ? 'active' : 'draft';
$brandSortOrder = (int)($brand['sort_order'] ?? 0);
?>

<!-- Title & Action Bar -->
<div class="page-title-bar">
  <div class="page-heading-group">
    <div class="d-flex align-center gap-md">
      <a href="<?= url('admin/brands') ?>" class="btn-icon-only" title="Back to Brands">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="19" y1="12" x2="5" y2="12"></line>
          <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
      </a>
      <h1>Edit Brand: <?= e($brandName) ?></h1>
    </div>
    <p class="page-subtitle">Update brand logo, vendor details, official links, and SEO handle.</p>
  </div>
  <div class="page-actions-group">
    <a href="<?= url('admin/brands') ?>" class="btn-admin btn-admin-secondary">Discard</a>
    <a href="<?= url('category?b=' . urlencode($brandSlug)) ?>" target="_blank" class="btn-admin btn-admin-secondary">
      <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
        <polyline points="15 3 21 3 21 9"></polyline>
        <line x1="10" y1="14" x2="21" y2="3"></line>
      </svg>
      <span>View on Store</span>
    </a>
    <button type="submit" form="brandEditForm" class="btn-admin btn-admin-primary">
      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"></polyline>
      </svg>
      <span>Save Changes</span>
    </button>
  </div>
</div>

<!-- Flash Notifications -->
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

<?php if (!empty($success)): ?>
<div class="admin-alert admin-alert-success mb-lg">
  <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
    <polyline points="22 4 12 14.01 9 11.01"></polyline>
  </svg>
  <span><?= e($success) ?></span>
</div>
<?php endif; ?>

<form id="brandEditForm" action="<?= url('admin/edit-brand') ?>?id=<?= $brandId ?>" method="POST" enctype="multipart/form-data">
  <?= csrf_field() ?>
  <input type="hidden" name="id" value="<?= $brandId ?>">

  <div class="detail-grid-layout">
    
    <!-- Left Main Column: Brand Card & Search Engine Listing -->
    <div class="admin-col-main">
      
      <!-- 1. Main Brand Card (Logo on Left + Title & Details on Right) -->
      <div class="shopify-collection-card">
        
        <!-- Logo Upload Box -->
        <input type="file" id="brandLogoInput" name="brand_logo" accept="image/*" class="d-none">
        <input type="hidden" name="logo" id="brandLogoUrl" value="<?= e($brandLogo) ?>">
        <div class="shopify-col-image-box" id="brandImageBox" title="Change brand logo">
          <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="upload-icon <?= !empty($brandLogo) ? 'd-none' : '' ?>" id="brandUploadIcon">
            <path d="M12 19V5"></path>
            <polyline points="5 12 12 5 19 12"></polyline>
            <path d="M4 21h16"></path>
          </svg>
          <img src="<?= !empty($brandLogo) ? asset($brandLogo) : '' ?>" alt="<?= e($brandName) ?>" class="shopify-col-preview-img <?= empty($brandLogo) ? 'd-none' : '' ?>" id="brandPreviewImg">
          <button type="button" class="shopify-col-img-remove-btn <?= empty($brandLogo) ? 'd-none' : '' ?>" id="btnRemoveBrandLogo" title="Remove logo">&times;</button>
        </div>

        <!-- Title & Details Form Elements -->
        <div class="shopify-col-main-content">
          <input type="text" id="brandName" name="name" class="shopify-col-title-input" value="<?= e($brandName) ?>" placeholder="Brand name" required autofocus>
          <textarea id="brandDescription" name="description" class="shopify-col-desc-input" placeholder="Add description / vendor overview for this brand..." rows="3"><?= e($brandDesc) ?></textarea>
        </div>

      </div>

      <!-- Additional Details Card (Website URL) -->
      <div class="admin-card mb-lg">
        <div class="admin-card-header">
          <h2 class="admin-card-title">Brand Info &amp; External Links</h2>
        </div>
        <div class="admin-card-body">
          <div class="admin-form-group mb-0">
            <label for="brandWebsite" class="admin-form-label">Official Website URL</label>
            <input type="url" id="brandWebsite" name="website_url" class="admin-form-input" value="<?= e($brandWebsite) ?>" placeholder="https://brand-domain.com">
            <p class="form-help-text mt-xs">Optional link to the manufacturer's verified official portal.</p>
          </div>
        </div>
      </div>

      <!-- 2. Search Engine Listing (SEO) Card -->
      <div class="admin-card">
        <div class="admin-card-header">
          <div>
            <h2 class="admin-card-title">Search Engine Listing (SEO)</h2>
            <p class="form-help-text">Optimize brand meta title, description, and handle for Google search ranking.</p>
          </div>
          <a href="#" id="toggleSeoBtn" class="btn-link-seo">Edit website SEO</a>
        </div>
        <div class="admin-card-body">
          
          <!-- SEO Editable Inputs -->
          <div id="seoFieldsContainer" class="seo-fields-container active">
            
            <div class="admin-form-group">
              <label for="seoTitleInput" class="admin-form-label">SEO Meta Title</label>
              <input type="text" id="seoTitleInput" name="seo_title" class="admin-form-input" value="<?= e($brandSeoTitle) ?>" placeholder="Enter custom SEO title" maxlength="70">
              <div class="char-counter"><span id="seoTitleCount"><?= mb_strlen($brandSeoTitle) ?></span> of 70 characters used</div>
            </div>

            <div class="admin-form-group">
              <label for="seoDescInput" class="admin-form-label">SEO Meta Description</label>
              <textarea id="seoDescInput" name="seo_description" class="admin-form-textarea" rows="3" placeholder="Enter meta description for search engines..." maxlength="320"><?= e($brandSeoDesc) ?></textarea>
              <div class="char-counter"><span id="seoDescCount"><?= mb_strlen($brandSeoDesc) ?></span> of 320 characters used</div>
            </div>

            <div class="admin-form-group mb-0">
              <label for="slugInput" class="admin-form-label">URL Handle / Slug</label>
              <div class="input-prefix-container">
                <span class="prefix"><?= url('brand') ?>/</span>
                <input type="text" id="slugInput" name="slug" value="<?= e($brandSlug) ?>">
              </div>
            </div>

          </div>

          <!-- Live Google Search Preview Card -->
          <div class="seo-preview-box">
            <div class="seo-preview-header">
              <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1 4-10z"></path></svg>
              <span>New Vape Official Store</span>
            </div>
            <div class="seo-preview-url" id="seoPreviewUrl"><?= url('brand') ?>/<?= e($brandSlug) ?></div>
            <div class="seo-preview-title" id="seoPreviewTitle"><?= e($brandSeoTitle) ?></div>
            <div class="seo-preview-desc" id="seoPreviewDesc"><?= e($brandSeoDesc) ?></div>
          </div>

        </div>
      </div>

    </div>

    <!-- Right Sidebar Column: Brand Status, Display Order & Stats -->
    <div class="admin-col-side">
      
      <!-- Status Card -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h2 class="admin-card-title">Status</h2>
        </div>
        <div class="admin-card-body">
          <div class="admin-form-group mb-0">
            <select id="brandStatus" name="status" class="admin-form-select">
              <option value="active" <?= $brandStatus === 'active' ? 'selected' : '' ?>>Active</option>
              <option value="draft" <?= $brandStatus === 'draft' ? 'selected' : '' ?>>Draft</option>
            </select>
          </div>
          <p class="form-help-text mt-sm">Active brands are published and visible on the storefront navigation &amp; filters.</p>
        </div>
      </div>

      <!-- Sort Order Card -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h2 class="admin-card-title">Display Order</h2>
        </div>
        <div class="admin-card-body">
          <div class="admin-form-group mb-0">
            <input type="number" id="brandSortOrder" name="sort_order" class="admin-form-input" value="<?= $brandSortOrder ?>" min="0" step="1">
          </div>
          <p class="form-help-text mt-sm">Lower numbers appear first in the brand grid and dropdowns.</p>
        </div>
      </div>

      <!-- Quick Stats Card -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h2 class="admin-card-title">Brand Stats</h2>
        </div>
        <div class="admin-card-body">
          <div class="d-flex justify-between align-center mb-sm">
            <span class="text-muted" style="font-size: 13px;">Attached Products</span>
            <strong class="text-dark" style="font-size: 14px;"><?= (int)($brand['products_count'] ?? 0) ?> items</strong>
          </div>
          <div class="d-flex justify-between align-center">
            <span class="text-muted" style="font-size: 13px;">Brand ID</span>
            <code style="font-size: 12px; background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">#<?= $brandId ?></code>
          </div>
        </div>
      </div>

    </div>

  </div>

  <!-- Bottom Actions Bar -->
  <div class="form-actions-bar">
    <div class="d-flex align-center gap-md">
      <a href="<?= url('admin/brands') ?>" class="btn-admin btn-admin-secondary">Discard</a>
      <button type="submit" class="btn-admin btn-admin-primary">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
        <span>Save Changes</span>
      </button>
    </div>
  </div>
</form>

<?php
include dirname(__DIR__) . '/includes/footer.php';
?>
