<?php
$page_title = 'Edit Collection: ' . ($collection['name'] ?? 'Collection');
$current_admin_page = 'collections';
$page_script = 'edit-collection.js';
include dirname(__DIR__) . '/includes/header.php';

$colId = (int)($collection['id'] ?? 0);
$colName = $collection['name'] ?? '';
$colSlug = $collection['slug'] ?? '';
$colDesc = $collection['short_description'] ?? '';
$colImage = $collection['header_image_url'] ?? '';
$colSeoTitle = $collection['meta_title'] ?? ($colName . ' | New Vape');
$colSeoDesc = $collection['meta_desc'] ?? $colDesc;
$colStatus = !empty($collection['is_active']) ? 'active' : 'draft';
$colParentId = $collection['parent_id'] ?? null;
?>

<!-- Title & Action Bar -->
<div class="page-title-bar">
  <div class="page-heading-group">
    <div class="d-flex align-center gap-md">
      <a href="<?= url('admin/collections') ?>" class="btn-icon-only" title="Back to Collections">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="19" y1="12" x2="5" y2="12"></line>
          <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
      </a>
      <h1>Edit Collection: <?= e($colName) ?></h1>
    </div>
    <p class="page-subtitle">Update collection banner, description, hierarchy, and SEO handle.</p>
  </div>
  <div class="page-actions-group">
    <a href="<?= url('admin/collections') ?>" class="btn-admin btn-admin-secondary">Discard</a>
    <a href="<?= url('category?c=' . urlencode($colSlug)) ?>" target="_blank" class="btn-admin btn-admin-secondary">
      <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
        <polyline points="15 3 21 3 21 9"></polyline>
        <line x1="10" y1="14" x2="21" y2="3"></line>
      </svg>
      <span>View on Store</span>
    </a>
    <button type="submit" form="collectionEditForm" class="btn-admin btn-admin-primary">
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

<form id="collectionEditForm" action="<?= url('admin/edit-collection') ?>?id=<?= $colId ?>" method="POST" enctype="multipart/form-data">
  <?= csrf_field() ?>
  <input type="hidden" name="id" value="<?= $colId ?>">

  <div class="detail-grid-layout">
    
    <!-- Left Main Column: Collection Card & Search Engine Listing -->
    <div class="admin-col-main">
      
      <!-- 1. Shopify-Style Main Collection Card (Image on Left + Title & Description on Right) -->
      <div class="shopify-collection-card">
        
        <!-- Image Upload Box -->
        <input type="file" id="collectionImageInput" name="collection_image" accept="image/*" class="d-none">
        <input type="hidden" name="image" id="collectionImageUrl" value="<?= e($colImage) ?>">
        <div class="shopify-col-image-box" id="collectionImageBox" title="Change collection image">
          <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="upload-icon <?= !empty($colImage) ? 'd-none' : '' ?>" id="colUploadIcon">
            <path d="M12 19V5"></path>
            <polyline points="5 12 12 5 19 12"></polyline>
            <path d="M4 21h16"></path>
          </svg>
          <img src="<?= !empty($colImage) ? asset($colImage) : '' ?>" alt="<?= e($colName) ?>" class="shopify-col-preview-img <?= empty($colImage) ? 'd-none' : '' ?>" id="collectionPreviewImg">
          <button type="button" class="shopify-col-img-remove-btn <?= empty($colImage) ? 'd-none' : '' ?>" id="btnRemoveColImg" title="Remove image">&times;</button>
        </div>

        <!-- Title & Description Form Elements -->
        <div class="shopify-col-main-content">
          <input type="text" id="collectionTitle" name="title" class="shopify-col-title-input" value="<?= e($colName) ?>" placeholder="Collection title" required autofocus>
          <textarea id="collectionDescription" name="description" class="shopify-col-desc-input" placeholder="Add description for this collection..." rows="3"><?= e($colDesc) ?></textarea>
        </div>

      </div>

      <!-- 2. Search Engine Listing (SEO) Card -->
      <div class="admin-card">
        <div class="admin-card-header">
          <div>
            <h2 class="admin-card-title">Search Engine Listing (SEO)</h2>
            <p class="form-help-text">Optimize title, meta description, and URL handle for Google search ranking.</p>
          </div>
          <a href="#" id="toggleSeoBtn" class="btn-link-seo">Edit website SEO</a>
        </div>
        <div class="admin-card-body">
          
          <!-- SEO Editable Inputs -->
          <div id="seoFieldsContainer" class="seo-fields-container active">
            
            <div class="admin-form-group">
              <label for="seoTitleInput" class="admin-form-label">SEO Meta Title</label>
              <input type="text" id="seoTitleInput" name="seo_title" class="admin-form-input" value="<?= e($colSeoTitle) ?>" placeholder="Enter custom SEO title" maxlength="70">
              <div class="char-counter"><span id="seoTitleCount"><?= mb_strlen($colSeoTitle) ?></span> of 70 characters used</div>
            </div>

            <div class="admin-form-group">
              <label for="seoDescInput" class="admin-form-label">SEO Meta Description</label>
              <textarea id="seoDescInput" name="seo_description" class="admin-form-textarea" rows="3" placeholder="Enter meta description for search engines..." maxlength="320"><?= e($colSeoDesc) ?></textarea>
              <div class="char-counter"><span id="seoDescCount"><?= mb_strlen($colSeoDesc) ?></span> of 320 characters used</div>
            </div>

            <div class="admin-form-group mb-0">
              <label for="slugInput" class="admin-form-label">URL Handle / Slug</label>
              <div class="input-prefix-container">
                <span class="prefix"><?= url('collections') ?>/</span>
                <input type="text" id="slugInput" name="slug" value="<?= e($colSlug) ?>">
              </div>
            </div>

          </div>

          <!-- Live Google Search Preview Card -->
          <div class="seo-preview-box">
            <div class="seo-preview-header">
              <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
              <span>New Vape Official Store</span>
            </div>
            <div class="seo-preview-url" id="seoPreviewUrl"><?= url('collections') ?>/<?= e($colSlug) ?></div>
            <div class="seo-preview-title" id="seoPreviewTitle"><?= e($colSeoTitle) ?></div>
            <div class="seo-preview-desc" id="seoPreviewDesc"><?= e($colSeoDesc) ?></div>
          </div>

        </div>
      </div>

    </div>

    <!-- Right Sidebar Column: Collection Status & Parent Taxonomy -->
    <div class="admin-col-side">
      
      <!-- Status Card -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h2 class="admin-card-title">Status</h2>
        </div>
        <div class="admin-card-body">
          <div class="admin-form-group mb-0">
            <select id="collectionStatus" name="status" class="admin-form-select">
              <option value="active" <?= $colStatus === 'active' ? 'selected' : '' ?>>Active</option>
              <option value="draft" <?= $colStatus === 'draft' ? 'selected' : '' ?>>Draft</option>
            </select>
          </div>
          <p class="form-help-text mt-sm">Active collections are published and visible on the storefront.</p>
        </div>
      </div>

      <!-- Parent Category Card -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h2 class="admin-card-title">Parent Category</h2>
        </div>
        <div class="admin-card-body">
          <div class="admin-form-group mb-0">
            <select id="collectionParent" name="parent_id" class="admin-form-select">
              <option value="" <?= empty($colParentId) ? 'selected' : '' ?>>None (Top Level Category)</option>
              <?php if (!empty($parents)): ?>
                <?php foreach ($parents as $p): ?>
                  <option value="<?= $p['id'] ?>" <?= $colParentId == $p['id'] ? 'selected' : '' ?>><?= e($p['name']) ?></option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>
          <p class="form-help-text mt-sm">Nest this collection as a sub-category under an existing parent.</p>
        </div>
      </div>

      <!-- Quick Stats Card -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h2 class="admin-card-title">Collection Stats</h2>
        </div>
        <div class="admin-card-body">
          <div class="d-flex justify-between align-center mb-sm">
            <span class="text-muted" style="font-size: 13px;">Attached Products</span>
            <strong class="text-dark" style="font-size: 14px;"><?= (int)($collection['products_count'] ?? 0) ?> items</strong>
          </div>
          <div class="d-flex justify-between align-center">
            <span class="text-muted" style="font-size: 13px;">Collection ID</span>
            <code style="font-size: 12px; background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">#<?= $colId ?></code>
          </div>
        </div>
      </div>

    </div>

  </div>

  <!-- Bottom Actions Bar -->
  <div class="form-actions-bar">
    <div class="d-flex align-center gap-md">
      <a href="<?= url('admin/collections') ?>" class="btn-admin btn-admin-secondary">Discard</a>
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
