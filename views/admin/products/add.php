<?php
$page_title = 'Add New Product';
$current_admin_page = 'products';
$page_script = 'add-product.js';
include dirname(__DIR__) . '/includes/header.php';

// Dynamic Brands & Collections from Database
$allBrands = \App\Models\Brand::all();
$brands = !empty($allBrands) ? array_column($allBrands, 'name') : ['LOST MARY', 'GEEK BAR', 'RAZ', 'JUICE HEAD', 'VOOPOO'];
$allCols = \App\Models\Collection::all();
$collections = !empty($allCols) ? array_column($allCols, 'name') : ['E-Liquids', 'Disposable', 'Kits', 'Mods', 'Tanks'];
?>

<!-- Title & Action Bar -->
<div class="page-title-bar">
  <div class="page-heading-group">
    <div class="d-flex align-center gap-md">
      <a href="<?= url('admin/products') ?>" class="btn-icon-only" title="Back to Products">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="19" y1="12" x2="5" y2="12"></line>
          <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
      </a>
      <h1>Add New Product</h1>
    </div>
    <p class="page-subtitle">Configure product content, variants matrix, SEO optimization, and inventory.</p>
  </div>
  <div class="page-actions-group">
    <a href="<?= url('admin/products') ?>" class="btn-admin btn-admin-secondary">Discard</a>
    <button type="submit" form="productMainForm" class="btn-admin btn-admin-primary">
      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"></polyline>
      </svg>
      <span>Publish Product</span>
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

<form id="productMainForm" action="<?= url('admin/add-product') ?>" method="POST" enctype="multipart/form-data">
  <?= csrf_field() ?>
  <div class="detail-grid-layout">
    
    <!-- Left Column: Main Product Configuration -->
    <div class="admin-col-main">
      
      <!-- 1. Title & Descriptions Card -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h2 class="admin-card-title">Product Description &amp; Details</h2>
        </div>
        <div class="admin-card-body">
          
          <!-- Product Title -->
          <div class="admin-form-group">
            <label for="productTitle" class="admin-form-label">Product Title <span class="required">*</span></label>
            <input type="text" id="productTitle" name="title" class="admin-form-input" placeholder="e.g. Juice Head Salt x Vaporesso 50K Bundle" required>
          </div>

          <!-- Full Description with Rich Text Editor -->
          <div class="admin-form-group mb-0">
            <label class="admin-form-label">Full Detailed Description</label>
            <div class="rich-text-editor">
              <div class="rte-toolbar">
                <button type="button" data-command="bold" title="Bold"><strong>B</strong></button>
                <button type="button" data-command="italic" title="Italic"><em>I</em></button>
                <button type="button" data-command="underline" title="Underline"><u>U</u></button>
                <button type="button" data-command="formatBlock" data-value="h2" title="Heading 2">H2</button>
                <button type="button" data-command="formatBlock" data-value="h3" title="Heading 3">H3</button>
                <button type="button" data-command="insertUnorderedList" title="Bullet List">• Bullets</button>
                <button type="button" data-command="insertOrderedList" title="Numbered List">1. Numbers</button>
                <button type="button" data-command="removeFormat" title="Clear Formatting">Tx</button>
              </div>
              <div class="rte-editor-content" contenteditable="true" data-placeholder="Write detailed flavor notes, battery specifications, pod capacity, and packaging details..."></div>
              <textarea name="description" class="d-none"></textarea>
            </div>
          </div>

        </div>
      </div>

      <!-- 2. Media Gallery Card -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h2 class="admin-card-title">Media Assets &amp; Product Images</h2>
        </div>
        <div class="admin-card-body">
          <input type="file" id="productMediaInput" name="product_images[]" multiple accept="image/*" class="d-none">
          <input type="hidden" name="image" id="productImageUrl" value="">
          <input type="hidden" name="featured_image_index" id="featuredImageIndex" value="0">
          
          <div class="media-upload-area" id="mediaDropzone">
            <svg viewBox="0 0 24 24" width="36" height="36" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="media-dropzone-icon">
              <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
              <circle cx="8.5" cy="8.5" r="1.5"></circle>
              <polyline points="21 15 16 10 5 21"></polyline>
            </svg>
            <div class="media-dropzone-title">Drag &amp; drop product images, or browse files</div>
            <p class="form-help-text">Supports WebP, PNG, JPG (Select multiple images at once)</p>
          </div>

          <div class="media-preview-grid" id="mediaPreviewGrid" style="display: none;"></div>
        </div>
      </div>

      <!-- 3. Pricing Card -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h2 class="admin-card-title">Pricing</h2>
        </div>
        <div class="admin-card-body">
          <div class="admin-form-group price-input-narrow">
            <label for="productBasePrice" class="admin-form-label">Price <span class="required">*</span></label>
            <div class="input-prefix-container">
              <span class="prefix">$</span>
              <input type="number" id="productBasePrice" name="price" step="0.01" placeholder="29.99" required>
            </div>
          </div>
        </div>
      </div>

      <!-- 4. Inventory Management Card -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h2 class="admin-card-title">Inventory &amp; Stock Tracking</h2>
        </div>
        <div class="admin-card-body">
          <div class="form-grid-2">
            
            <div class="admin-form-group">
              <label for="productSku" class="admin-form-label">SKU (Stock Keeping Unit)</label>
              <input type="text" id="productSku" name="sku" class="admin-form-input" placeholder="e.g. VH-JH-50K">
            </div>

            <div class="admin-form-group">
              <label for="productStock" class="admin-form-label">Quantity Available</label>
              <input type="number" id="productStock" name="stock" class="admin-form-input" placeholder="0" min="0">
            </div>

          </div>

          <div class="checkbox-group mt-md">
            <label class="checkbox-label">
              <input type="checkbox" name="track_inventory" checked>
              <span>Track inventory quantity automatically (Prevents out-of-stock orders)</span>
            </label>
          </div>
        </div>
      </div>      <!-- 5. Shopify-Style Variants Section -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h2 class="admin-card-title">Variants</h2>
          <div class="d-flex align-center gap-sm">
            <button type="button" class="btn-admin btn-admin-secondary btn-admin-sm" data-modal-target="#bulkEditModal" id="bulkEditModalBtn" style="display: none;">Bulk edit</button>
            <button type="button" class="btn-admin btn-admin-secondary btn-admin-sm" id="addVariantOptionBtn" style="display: none;">
              <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
              <span>Add option</span>
            </button>
          </div>
        </div>
        
        <div class="admin-card-body">
          <!-- Options Toggle (Shopify style) -->
          <div class="checkbox-group mb-md">
            <label class="checkbox-label" style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
              <input type="checkbox" id="hasVariantsToggle" name="has_variants" value="1">
              <span><strong>This product has options</strong>, like size, flavor, nicotine strength, or color</span>
            </label>
          </div>

          <div id="variantsOptionsWrapper" style="display: none;">
            <!-- Options Box -->
            <div class="variants-options-card">
              <div id="optionsListContainer">
                <!-- Option rows generated purely dynamically -->
              </div>

              <!-- Add another option trigger -->
              <div class="variant-add-option-footer">
                <button type="button" class="btn-add-option-link" id="addAnotherOptionLink">
                  <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="16"></line>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                  </svg>
                  <span>Add another option</span>
                </button>
              </div>
            </div>

            <!-- Variants Matrix Table -->
            <div class="table-responsive variants-table-wrap" id="variantsTableWrap" style="margin-top: 20px;">
              <table class="variants-matrix-table">
                <thead>
                  <tr>
                    <th>Variant Name</th>
                    <th>SKU</th>
                    <th>Price ($)</th>
                    <th>Available Stock</th>
                    <th class="text-right" style="width: 50px;"></th>
                  </tr>
                </thead>
                <tbody id="variantsTableBody">
                  <tr id="emptyVariantsRow">
                    <td colspan="5" class="variant-empty-cell" style="padding: 24px; text-align: center; color: #64748b;">
                      <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" style="margin: 0 auto 8px; display: block; stroke: #94a3b8;">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                      </svg>
                      No variant values added yet. Add an option name and values above to generate combinations.
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- 7. Search Engine Listing (SEO) Card -->
      <div class="admin-card">
        <div class="admin-card-header">
          <div>
            <h2 class="admin-card-title">Search Engine Listing (SEO)</h2>
            <p class="form-help-text">Optimize search engine snippet for Google search rankings.</p>
          </div>
          <a href="#" id="toggleSeoBtn" class="btn-link-seo">Edit website SEO</a>
        </div>
        <div class="admin-card-body">
          
          <!-- SEO Editable Inputs -->
          <div id="seoFieldsContainer" class="seo-fields-container">
            
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

            <div class="admin-form-group">
              <label for="slugInput" class="admin-form-label">URL Handle / Slug</label>
              <div class="input-prefix-container">
                <span class="prefix">.../products/</span>
                <input type="text" id="slugInput" name="slug" placeholder="e.g. juice-head-salt-vaporesso-50k">
              </div>
            </div>

          </div>

          <!-- Live Google Search Preview Card -->
          <div class="seo-preview-box">
            <div class="seo-preview-header">
              <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
              <span>New Vape Official Store</span>
            </div>
            <div class="seo-preview-url" id="seoPreviewUrl">www.newvape.com/products/product-handle</div>
            <div class="seo-preview-title" id="seoPreviewTitle">Product Title</div>
            <div class="seo-preview-desc" id="seoPreviewDesc">Product description will appear in search results...</div>
          </div>

        </div>
      </div>

    </div>

    <!-- Right Sidebar Column: Status & Organization -->
    <div class="admin-col-side">
      
      <!-- Product Status Card -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h2 class="admin-card-title">Product Status</h2>
        </div>
        <div class="admin-card-body">
          <div class="admin-form-group">
            <select name="status" class="admin-form-select">
              <option value="active" selected>Active (Live on Storefront)</option>
              <option value="draft">Draft (Hidden)</option>
              <option value="archived">Archived</option>
            </select>
          </div>
          <p class="form-help-text">Active products are instantly available for purchase by 21+ verified customers.</p>
        </div>
      </div>

      <!-- Product Organization Card -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h2 class="admin-card-title">Product Organization</h2>
        </div>
        <div class="admin-card-body">
          
          <!-- Brand Selector -->
          <div class="admin-form-group">
            <label for="productBrand" class="admin-form-label">Brand / Manufacturer <span class="required">*</span></label>
            <select id="productBrand" name="brand" class="admin-form-select" required>
              <option value="">Select Brand</option>
              <?php foreach ($brands as $b): ?>
                <option value="<?php echo htmlspecialchars($b); ?>"><?php echo htmlspecialchars($b); ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Collection Selector -->
          <div class="admin-form-group">
            <label for="productCollection" class="admin-form-label">Primary Collection <span class="required">*</span></label>
            <select id="productCollection" name="collection" class="admin-form-select" required>
              <option value="">Select Collection</option>
              <?php foreach ($collections as $col): ?>
                <option value="<?php echo htmlspecialchars($col); ?>"><?php echo htmlspecialchars($col); ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Product Tags with Chips -->
          <div class="admin-form-group mb-0">
            <label for="tagInputField" class="admin-form-label">Product Tags</label>
            <input type="text" id="tagInputField" class="admin-form-input" placeholder="Type tag &amp; press Enter (e.g. Salt Nic, 50mg, Best Seller)...">
            <div class="selected-tags" id="tagsContainer"></div>
          </div>

        </div>
      </div>

    </div>

  </div>

  <!-- Bottom Actions Bar -->
  <div class="form-actions-bar">
    <div class="d-flex align-center gap-md">
      <a href="<?= url('admin/products') ?>" class="btn-admin btn-admin-secondary">Discard</a>
      <button type="submit" class="btn-admin btn-admin-primary">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
        <span>Publish Product</span>
      </button>
    </div>
  </div>
</form>

<!-- Bulk Edit Variants Modal -->
<div class="admin-modal-overlay" id="bulkEditModal">
  <div class="admin-modal-dialog">
    <div class="admin-modal-header">
      <h3 class="admin-modal-title">Bulk Edit Variant Prices &amp; Stock</h3>
      <button type="button" class="admin-modal-close btn-close-modal" aria-label="Close Modal">&times;</button>
    </div>
    <div class="admin-modal-body">
      <p class="modal-desc-text">Apply a unified selling price and inventory stock count across all active combinations.</p>
      
      <div class="admin-form-group">
        <label for="bulkPriceInput" class="admin-form-label">Apply Price ($)</label>
        <div class="input-prefix-container">
          <span class="prefix">$</span>
          <input type="number" id="bulkPriceInput" placeholder="29.99" step="0.01">
        </div>
      </div>

      <div class="admin-form-group">
        <label for="bulkStockInput" class="admin-form-label">Apply Stock Quantity</label>
        <input type="number" id="bulkStockInput" class="admin-form-input" placeholder="50">
      </div>
    </div>
    <div class="admin-modal-footer">
      <button type="button" class="btn-admin btn-admin-secondary btn-close-modal">Cancel</button>
      <button type="button" class="btn-admin btn-admin-primary" id="applyBulkEdit">Apply to All Variants</button>
    </div>
  </div>
</div>

<?php
include dirname(__DIR__) . '/includes/footer.php';
?>
