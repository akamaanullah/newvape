<?php
$page_title = 'Add New Brand';
$current_admin_page = 'brands';
$page_script = 'brand-form.js';
include dirname(__DIR__) . '/includes/header.php';
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
      <h1>Add Brand</h1>
    </div>
    <p class="page-subtitle">Add a manufacturer or vendor brand to categorize vape devices, flavors, and accessories.</p>
  </div>
  <div class="page-actions-group">
    <a href="<?= url('admin/brands') ?>" class="btn-admin btn-admin-secondary">Discard</a>
    <button type="submit" form="brandMainForm" class="btn-admin btn-admin-primary">
      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"></polyline>
      </svg>
      <span>Save Brand</span>
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

<form id="brandMainForm" action="<?= url('admin/add-brand') ?>" method="POST" enctype="multipart/form-data">
  <?= csrf_field() ?>

  <div class="detail-grid-layout">
    
    <!-- Left Main Column: Brand Card & Search Engine Listing -->
    <div class="admin-col-main">
      
      <!-- 1. Main Brand Card (Logo on Left + Title & Details on Right) -->
      <div class="shopify-collection-card">
        
        <!-- Logo Upload Box -->
        <input type="file" id="brandLogoInput" name="brand_logo" accept="image/*" class="d-none">
        <input type="hidden" name="logo" id="brandLogoUrl" value="">
        <div class="shopify-col-image-box" id="brandImageBox" title="Upload brand logo">
          <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="upload-icon" id="brandUploadIcon">
            <path d="M12 19V5"></path>
            <polyline points="5 12 12 5 19 12"></polyline>
            <path d="M4 21h16"></path>
          </svg>
          <img src="" alt="Brand Logo Preview" class="shopify-col-preview-img d-none" id="brandPreviewImg">
          <button type="button" class="shopify-col-img-remove-btn d-none" id="btnRemoveBrandLogo" title="Remove logo">&times;</button>
        </div>

        <!-- Title & Details Form Elements -->
        <div class="shopify-col-main-content">
          <input type="text" id="brandName" name="name" class="shopify-col-title-input" placeholder="e.g. Lost Mary, Geek Bar" required autofocus>
          <textarea id="brandDescription" name="description" class="shopify-col-desc-input" placeholder="Add description / vendor overview for this brand..." rows="3"></textarea>
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
            <input type="url" id="brandWebsite" name="website_url" class="admin-form-input" placeholder="https://brand-domain.com">
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
              <input type="text" id="seoTitleInput" name="seo_title" class="admin-form-input" placeholder="Enter custom SEO title" maxlength="70">
              <div class="char-counter"><span id="seoTitleCount">0</span> of 70 characters used</div>
            </div>

            <div class="admin-form-group">
              <label for="seoDescInput" class="admin-form-label">SEO Meta Description</label>
              <textarea id="seoDescInput" name="seo_description" class="admin-form-textarea" rows="3" placeholder="Enter meta description for search engines..." maxlength="320"></textarea>
              <div class="char-counter"><span id="seoDescCount">0</span> of 320 characters used</div>
            </div>

            <div class="admin-form-group mb-0">
              <label for="slugInput" class="admin-form-label">URL Handle / Slug</label>
              <div class="input-prefix-container">
                <span class="prefix"><?= url('brand') ?>/</span>
                <input type="text" id="slugInput" name="slug" placeholder="e.g. lost-mary">
              </div>
            </div>

          </div>

          <!-- Live Google Search Preview Card -->
          <div class="seo-preview-box">
            <div class="seo-preview-header">
              <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
              <span>New Vape Official Store</span>
            </div>
            <div class="seo-preview-url" id="seoPreviewUrl"><?= url('brand') ?>/handle</div>
            <div class="seo-preview-title" id="seoPreviewTitle">Brand Name</div>
            <div class="seo-preview-desc" id="seoPreviewDesc">Brand description will appear in search results...</div>
          </div>

        </div>
      </div>

    </div>

    <!-- Right Sidebar Column: Brand Status & Sort Order -->
    <div class="admin-col-side">
      
      <!-- Status Card -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h2 class="admin-card-title">Status</h2>
        </div>
        <div class="admin-card-body">
          <div class="admin-form-group mb-0">
            <select id="brandStatus" name="status" class="admin-form-select">
              <option value="active" selected>Active</option>
              <option value="draft">Draft</option>
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
            <input type="number" id="brandSortOrder" name="sort_order" class="admin-form-input" value="0" min="0" step="1">
          </div>
          <p class="form-help-text mt-sm">Lower numbers appear first in the brand grid and dropdowns.</p>
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
        <span>Save Brand</span>
      </button>
    </div>
  </div>
</form>

<?php
include dirname(__DIR__) . '/includes/footer.php';
?>
