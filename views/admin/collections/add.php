<?php
$page_title = 'Add New Collection';
$current_admin_page = 'collections';
$page_script = 'add-collection.js';
include dirname(__DIR__) . '/includes/header.php';
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
      <h1>Add Collection</h1>
    </div>
    <p class="page-subtitle">Create a new collection to organize and showcase products on your storefront.</p>
  </div>
  <div class="page-actions-group">
    <a href="<?= url('admin/collections') ?>" class="btn-admin btn-admin-secondary">Discard</a>
    <button type="submit" form="collectionMainForm" class="btn-admin btn-admin-primary">
      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"></polyline>
      </svg>
      <span>Save Collection</span>
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

<form id="collectionMainForm" action="<?= url('admin/add-collection') ?>" method="POST" enctype="multipart/form-data">
  <?= csrf_field() ?>

  <div class="detail-grid-layout">
    
    <!-- Left Main Column: Collection Card & Search Engine Listing -->
    <div class="admin-col-main">
      
      <!-- 1. Shopify-Style Main Collection Card (Image on Left + Title & Description on Right) -->
      <div class="shopify-collection-card">
        
        <!-- Image Upload Box -->
        <input type="file" id="collectionImageInput" name="collection_image" accept="image/*" class="d-none">
        <input type="hidden" name="image" id="collectionImageUrl" value="">
        <div class="shopify-col-image-box" id="collectionImageBox" title="Upload collection image">
          <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="upload-icon" id="colUploadIcon">
            <path d="M12 19V5"></path>
            <polyline points="5 12 12 5 19 12"></polyline>
            <path d="M4 21h16"></path>
          </svg>
          <img src="" alt="Collection Preview" class="shopify-col-preview-img d-none" id="collectionPreviewImg">
          <button type="button" class="shopify-col-img-remove-btn d-none" id="btnRemoveColImg" title="Remove image">&times;</button>
        </div>

        <!-- Title & Description Form Elements -->
        <div class="shopify-col-main-content">
          <input type="text" id="collectionTitle" name="title" class="shopify-col-title-input" placeholder="e.g. Disposable Vapes" required autofocus>
          <textarea id="collectionDescription" name="description" class="shopify-col-desc-input" placeholder="Add description for this collection..." rows="3"></textarea>
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
                <span class="prefix"><?= url('collections') ?>/</span>
                <input type="text" id="slugInput" name="slug" placeholder="e.g. disposable-vapes">
              </div>
            </div>

          </div>

          <!-- Live Google Search Preview Card -->
          <div class="seo-preview-box">
            <div class="seo-preview-header">
              <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
              <span>New Vape Official Store</span>
            </div>
            <div class="seo-preview-url" id="seoPreviewUrl"><?= url('collections') ?>/handle</div>
            <div class="seo-preview-title" id="seoPreviewTitle">Collection Title</div>
            <div class="seo-preview-desc" id="seoPreviewDesc">Collection description will appear in search results...</div>
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
              <option value="active" selected>Active</option>
              <option value="draft">Draft</option>
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
              <option value="">None (Top Level Category)</option>
              <?php if (!empty($parents)): ?>
                <?php foreach ($parents as $p): ?>
                  <option value="<?= $p['id'] ?>"><?= e($p['name']) ?></option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>
          <p class="form-help-text mt-sm">Nest this collection as a sub-category under an existing parent.</p>
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
        <span>Save Collection</span>
      </button>
    </div>
  </div>
</form>

<?php
include dirname(__DIR__) . '/includes/footer.php';
?>
