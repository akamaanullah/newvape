<?php
$page_title = 'Edit Product';
$current_admin_page = 'products';
$page_script = 'edit-product.js';
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
include dirname(__DIR__) . '/includes/header.php';

// Dynamic Brands & Collections from Database
$allBrands = \App\Models\Brand::all();
$brands = !empty($allBrands) ? array_column($allBrands, 'name') : ['LOST MARY', 'GEEK BAR', 'RAZ', 'JUICE HEAD', 'VOOPOO'];
$allCols = \App\Models\Collection::all();
$collections = !empty($allCols) ? array_column($allCols, 'name') : ['E-Liquids', 'Disposable', 'Kits', 'Mods', 'Tanks'];

// Dynamic Product Data from Database
$prodId = (int)($product['id'] ?? $product_id ?? 1);
$product_data = [
  'id' => $prodId,
  'title' => $product['title'] ?? $product['name'] ?? '',
  'description' => $product['long_desc'] ?? $product['description'] ?? '',
  'price' => (string)($product['base_price'] ?? $product['price'] ?? '0.00'),
  'compare_price' => (string)($product['compare_price'] ?? ''),
  'sku' => $product['sku'] ?? '',
  'stock' => (string)($product['stock_quantity'] ?? $product['stock'] ?? 0),
  'brand' => $product['brand'] ?? '',
  'collection' => $product['category'] ?? '',
  'status' => $product['status'] ?? 'published',
  'tags' => !empty($product['tags']) ? (is_array($product['tags']) ? $product['tags'] : array_map('trim', explode(',', $product['tags']))) : [],
  'seo_title' => $product['seo_title'] ?? '',
  'seo_desc' => $product['seo_description'] ?? '',
  'slug' => $product['slug'] ?? '',
  'image' => $product['featured_image'] ?? $product['img'] ?? ''
];
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
      <h1>Edit Product: <?= e($product_data['title']) ?></h1>
    </div>
    <p class="page-subtitle">Update product details, variant combinations, inventory, and storefront listing.</p>
  </div>
  <div class="page-actions-group">
    <a href="<?= url('admin/products') ?>" class="btn-admin btn-admin-secondary">Discard</a>
    <a href="<?= url('product?id=' . $prodId) ?>" target="_blank" class="btn-admin btn-admin-secondary">
      <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
        <polyline points="15 3 21 3 21 9"></polyline>
        <line x1="10" y1="14" x2="21" y2="3"></line>
      </svg>
      <span>View on Store</span>
    </a>
    <button type="submit" form="productMainForm" class="btn-admin btn-admin-primary">
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

<form id="productMainForm" action="<?= url('admin/edit-product') ?>?id=<?= $prodId ?>" method="POST" enctype="multipart/form-data">
  <?= csrf_field() ?>
  <input type="hidden" name="id" value="<?= $prodId ?>">
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
            <input type="text" id="productTitle" name="title" class="admin-form-input" placeholder="e.g. Juice Head Salt x Vaporesso 50K Bundle" value="<?php echo htmlspecialchars($product_data['title']); ?>" required>
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
              <div class="rte-editor-content" contenteditable="true" data-placeholder="Write detailed flavor notes, battery specifications, pod capacity, and packaging details..."><?php echo $product_data['description']; ?></div>
              <textarea name="description" class="d-none"><?php echo htmlspecialchars($product_data['description']); ?></textarea>
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
          <input type="hidden" name="image" id="productImageUrl" value="<?= e($product_data['image']) ?>">
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

          <div class="media-preview-grid" id="mediaPreviewGrid" style="<?= empty($images) && empty($product_data['image']) ? 'display: none;' : '' ?>">
            <?php if (!empty($images)): ?>
              <?php foreach ($images as $idx => $img): ?>
                <div class="media-preview-item <?= $idx === 0 ? 'is-featured' : '' ?>" data-existing="1">
                  <img src="<?= asset($img['image_url']) ?>" alt="Product image">
                  <?php if ($idx === 0): ?><span class="media-preview-badge">★ Featured</span><?php endif; ?>
                </div>
              <?php endforeach; ?>
            <?php elseif (!empty($product_data['image'])): ?>
              <div class="media-preview-item is-featured" data-existing="1">
                <img src="<?= asset($product_data['image']) ?>" alt="Main product image">
                <span class="media-preview-badge">★ Featured</span>
              </div>
            <?php endif; ?>
          </div>
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
              <input type="number" id="productBasePrice" name="price" step="0.01" placeholder="29.99" value="<?php echo htmlspecialchars($product_data['price']); ?>" required>
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
              <input type="text" id="productSku" name="sku" class="admin-form-input" placeholder="e.g. VH-JH-50K" value="<?php echo htmlspecialchars($product_data['sku']); ?>">
            </div>

            <div class="admin-form-group">
              <label for="productStock" class="admin-form-label">Quantity Available</label>
              <input type="number" id="productStock" name="stock" class="admin-form-input" placeholder="0" value="<?php echo htmlspecialchars($product_data['stock']); ?>" min="0">
            </div>

          </div>

          <div class="checkbox-group mt-md">
            <label class="checkbox-label">
              <input type="checkbox" name="track_inventory" checked>
              <span>Track inventory quantity automatically (Prevents out-of-stock orders)</span>
            </label>
          </div>
        </div>
      </div>

      <!-- 5. Shopify-Style Variants Section -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h2 class="admin-card-title">Variants</h2>
          <div class="d-flex align-center gap-sm">
            <button type="button" class="btn-admin btn-admin-secondary btn-admin-sm" data-modal-target="#bulkEditModal">Bulk edit</button>
            <button type="button" class="btn-admin btn-admin-secondary btn-admin-sm" id="addVariantOptionBtn">
              <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
              <span>Add variant</span>
            </button>
          </div>
        </div>
        
        <div class="admin-card-body">
          
          <!-- Options Box -->
          <div class="variants-options-card">
            
            <!-- Option 1: FLAVOR -->
            <div class="variant-option-row" data-option-type="flavor">
              <div class="variant-drag-handle" title="Drag to reorder">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                  <circle cx="9" cy="6" r="1.5"></circle>
                  <circle cx="15" cy="6" r="1.5"></circle>
                  <circle cx="9" cy="12" r="1.5"></circle>
                  <circle cx="15" cy="12" r="1.5"></circle>
                  <circle cx="9" cy="18" r="1.5"></circle>
                  <circle cx="15" cy="18" r="1.5"></circle>
                </svg>
              </div>
              <div class="variant-option-content">
                <input type="text" class="variant-option-name-input" value="FLAVOR:" placeholder="Option 1 Name (e.g. FLAVOR, COLOR)">
                <div class="variant-pills-list">
                  <span class="variant-pill-tag" data-val="Berry Lemonade" title="Click to edit name"><span class="pill-text">Berry Lemonade</span> <button type="button" class="pill-remove" title="Remove">&times;</button></span>
                  <span class="variant-pill-tag" data-val="Sour Watermelon" title="Click to edit name"><span class="pill-text">Sour Watermelon</span> <button type="button" class="pill-remove" title="Remove">&times;</button></span>
                  <span class="variant-pill-tag" data-val="Strawberry Kiwi ICE" title="Click to edit name"><span class="pill-text">Strawberry Kiwi ICE</span> <button type="button" class="pill-remove" title="Remove">&times;</button></span>
                  <span class="variant-pill-tag" data-val="Strawberry Watermelon" title="Click to edit name"><span class="pill-text">Strawberry Watermelon</span> <button type="button" class="pill-remove" title="Remove">&times;</button></span>
                  <span class="variant-pill-tag" data-val="Sweet Peach Pineapple" title="Click to edit name"><span class="pill-text">Sweet Peach Pineapple</span> <button type="button" class="pill-remove" title="Remove">&times;</button></span>
                  <div class="inline-tag-input-wrap">
                    <input type="text" class="inline-tag-input inline-flavor-input" placeholder="+ Add flavor">
                  </div>
                </div>
              </div>
            </div>

            <!-- Option 2: Strength -->
            <div class="variant-option-row" data-option-type="strength">
              <div class="variant-drag-handle" title="Drag to reorder">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                  <circle cx="9" cy="6" r="1.5"></circle>
                  <circle cx="15" cy="6" r="1.5"></circle>
                  <circle cx="9" cy="12" r="1.5"></circle>
                  <circle cx="15" cy="12" r="1.5"></circle>
                  <circle cx="9" cy="18" r="1.5"></circle>
                  <circle cx="15" cy="18" r="1.5"></circle>
                </svg>
              </div>
              <div class="variant-option-content">
                <input type="text" class="variant-option-name-input" value="STRENGTH:" placeholder="Option 2 Name (e.g. STRENGTH, SIZE)">
                <div class="variant-pills-list">
                  <span class="variant-pill-tag" data-val="3mg" title="Click to edit name"><span class="pill-text">3mg</span> <button type="button" class="pill-remove" title="Remove">&times;</button></span>
                  <span class="variant-pill-tag" data-val="6mg" title="Click to edit name"><span class="pill-text">6mg</span> <button type="button" class="pill-remove" title="Remove">&times;</button></span>
                  <div class="inline-tag-input-wrap">
                    <input type="text" class="inline-tag-input inline-strength-input" placeholder="+ Add strength">
                  </div>
                </div>
              </div>
            </div>

            <!-- Dynamic Additional Option Container -->
            <div id="additionalOptionsContainer"></div>

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

          <!-- Table Controls Toolbar -->
          <div class="variant-table-toolbar">
            <div class="variant-group-by-wrap">
              <span>Group by</span>
              <select class="variant-group-select" id="variantGroupBySelect">
                <option value="flavor">FLAVOR:</option>
                <option value="strength">STRENGTH:</option>
              </select>
            </div>
            
            <div class="variant-toolbar-right">
              <button type="button" class="btn-variant-icon-tool" title="Search & Filter">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="11" cy="11" r="8"></circle>
                  <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2">
                  <line x1="4" y1="6" x2="20" y2="6"></line>
                  <line x1="7" y1="12" x2="17" y2="12"></line>
                  <line x1="10" y1="18" x2="14" y2="18"></line>
                </svg>
              </button>
              
              <select class="variant-group-select">
                <option>All locations</option>
                <option>Main Warehouse (OKC)</option>
              </select>
            </div>
          </div>

          <!-- Variants Matrix Table -->
          <div class="table-responsive variants-table-wrap">
            <table class="variants-matrix-table">
              <thead>
                <tr>
                  <th class="col-checkbox">
                    <input type="checkbox" id="selectAllVariants">
                  </th>
                  <th>Variant</th>
                  <th>Price</th>
                  <th>Available</th>
                  <th class="col-toggle">
                    <button type="button" class="variant-toggle-btn" id="toggleAllSubrows" title="Toggle All Sub-variants">
                      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                  </th>
                </tr>
              </thead>
              <tbody id="variantsTableBody">
                <!-- 1. Berry Lemonade -->
                <tr class="variant-parent-row" data-target-group="subrow-1" data-flavor="Berry Lemonade">
                  <td class="text-center">
                    <input type="checkbox" class="variant-checkbox">
                  </td>
                  <td>
                    <div class="variant-item-cell">
                      <div class="variant-thumb-box">
                        <img src="../assets/images/product-1.webp" alt="Berry Lemonade">
                      </div>
                      <div>
                        <div class="variant-item-name">Berry Lemonade</div>
                        <div class="variant-item-meta"><span class="subrow-count">2</span> variants</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="variant-price-box">
                      <span>$</span>
                      <input type="text" class="variant-price-input" value="14.50">
                    </div>
                  </td>
                  <td>
                    <span class="variant-available-stock">96</span>
                  </td>
                  <td class="text-right">
                    <button type="button" class="variant-toggle-btn" data-toggle-group="subrow-1" title="Expand Sub-variants">
                      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                  </td>
                </tr>
                <tr class="variant-subrow subrow-1" data-flavor="Berry Lemonade" data-strength="3mg">
                  <td></td>
                  <td>
                    <div class="variant-subrow-content">
                      <span class="variant-subrow-bullet"></span>
                      <div>
                        <strong class="variant-subrow-title">3mg</strong>
                        <div class="variant-subrow-sku">SKU: VH-JH-50K-BL-3</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="variant-price-box variant-subrow-price-box">
                      <span>$</span>
                      <input type="text" class="variant-subprice-input" value="14.50">
                    </div>
                  </td>
                  <td>
                    <input type="number" class="admin-form-input variant-stock-input variant-subrow-stock-input" value="48">
                  </td>
                  <td></td>
                </tr>
                <tr class="variant-subrow subrow-1" data-flavor="Berry Lemonade" data-strength="6mg">
                  <td></td>
                  <td>
                    <div class="variant-subrow-content">
                      <span class="variant-subrow-bullet"></span>
                      <div>
                        <strong class="variant-subrow-title">6mg</strong>
                        <div class="variant-subrow-sku">SKU: VH-JH-50K-BL-6</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="variant-price-box variant-subrow-price-box">
                      <span>$</span>
                      <input type="text" class="variant-subprice-input" value="14.50">
                    </div>
                  </td>
                  <td>
                    <input type="number" class="admin-form-input variant-stock-input variant-subrow-stock-input" value="48">
                  </td>
                  <td></td>
                </tr>

                <!-- 2. Sour Watermelon -->
                <tr class="variant-parent-row" data-target-group="subrow-2" data-flavor="Sour Watermelon">
                  <td class="text-center">
                    <input type="checkbox" class="variant-checkbox">
                  </td>
                  <td>
                    <div class="variant-item-cell">
                      <div class="variant-thumb-box">
                        <img src="../assets/images/product-2.webp" alt="Sour Watermelon">
                      </div>
                      <div>
                        <div class="variant-item-name">Sour Watermelon</div>
                        <div class="variant-item-meta"><span class="subrow-count">2</span> variants</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="variant-price-box">
                      <span>$</span>
                      <input type="text" class="variant-price-input" value="14.50">
                    </div>
                  </td>
                  <td>
                    <span class="variant-available-stock">94</span>
                  </td>
                  <td class="text-right">
                    <button type="button" class="variant-toggle-btn" data-toggle-group="subrow-2" title="Expand Sub-variants">
                      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                  </td>
                </tr>
                <tr class="variant-subrow subrow-2" data-flavor="Sour Watermelon" data-strength="3mg">
                  <td></td>
                  <td>
                    <div class="variant-subrow-content">
                      <span class="variant-subrow-bullet"></span>
                      <div>
                        <strong class="variant-subrow-title">3mg</strong>
                        <div class="variant-subrow-sku">SKU: VH-JH-50K-SW-3</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="variant-price-box variant-subrow-price-box">
                      <span>$</span>
                      <input type="text" class="variant-subprice-input" value="14.50">
                    </div>
                  </td>
                  <td>
                    <input type="number" class="admin-form-input variant-stock-input variant-subrow-stock-input" value="47">
                  </td>
                  <td></td>
                </tr>
                <tr class="variant-subrow subrow-2" data-flavor="Sour Watermelon" data-strength="6mg">
                  <td></td>
                  <td>
                    <div class="variant-subrow-content">
                      <span class="variant-subrow-bullet"></span>
                      <div>
                        <strong class="variant-subrow-title">6mg</strong>
                        <div class="variant-subrow-sku">SKU: VH-JH-50K-SW-6</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="variant-price-box variant-subrow-price-box">
                      <span>$</span>
                      <input type="text" class="variant-subprice-input" value="14.50">
                    </div>
                  </td>
                  <td>
                    <input type="number" class="admin-form-input variant-stock-input variant-subrow-stock-input" value="47">
                  </td>
                  <td></td>
                </tr>

                <!-- 3. Strawberry Kiwi ICE -->
                <tr class="variant-parent-row" data-target-group="subrow-3" data-flavor="Strawberry Kiwi ICE">
                  <td class="text-center">
                    <input type="checkbox" class="variant-checkbox">
                  </td>
                  <td>
                    <div class="variant-item-cell">
                      <div class="variant-thumb-box">
                        <img src="../assets/images/product-3.webp" alt="Strawberry Kiwi ICE">
                      </div>
                      <div>
                        <div class="variant-item-name">Strawberry Kiwi ICE</div>
                        <div class="variant-item-meta"><span class="subrow-count">2</span> variants</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="variant-price-box">
                      <span>$</span>
                      <input type="text" class="variant-price-input" value="14.50">
                    </div>
                  </td>
                  <td>
                    <span class="variant-available-stock">94</span>
                  </td>
                  <td class="text-right">
                    <button type="button" class="variant-toggle-btn" data-toggle-group="subrow-3" title="Expand Sub-variants">
                      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                  </td>
                </tr>
                <tr class="variant-subrow subrow-3" data-flavor="Strawberry Kiwi ICE" data-strength="3mg">
                  <td></td>
                  <td>
                    <div class="variant-subrow-content">
                      <span class="variant-subrow-bullet"></span>
                      <div>
                        <strong class="variant-subrow-title">3mg</strong>
                        <div class="variant-subrow-sku">SKU: VH-JH-50K-SK-3</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="variant-price-box variant-subrow-price-box">
                      <span>$</span>
                      <input type="text" class="variant-subprice-input" value="14.50">
                    </div>
                  </td>
                  <td>
                    <input type="number" class="admin-form-input variant-stock-input variant-subrow-stock-input" value="47">
                  </td>
                  <td></td>
                </tr>
                <tr class="variant-subrow subrow-3" data-flavor="Strawberry Kiwi ICE" data-strength="6mg">
                  <td></td>
                  <td>
                    <div class="variant-subrow-content">
                      <span class="variant-subrow-bullet"></span>
                      <div>
                        <strong class="variant-subrow-title">6mg</strong>
                        <div class="variant-subrow-sku">SKU: VH-JH-50K-SK-6</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="variant-price-box variant-subrow-price-box">
                      <span>$</span>
                      <input type="text" class="variant-subprice-input" value="14.50">
                    </div>
                  </td>
                  <td>
                    <input type="number" class="admin-form-input variant-stock-input variant-subrow-stock-input" value="47">
                  </td>
                  <td></td>
                </tr>

                <!-- 4. Strawberry Watermelon -->
                <tr class="variant-parent-row" data-target-group="subrow-4" data-flavor="Strawberry Watermelon">
                  <td class="text-center">
                    <input type="checkbox" class="variant-checkbox">
                  </td>
                  <td>
                    <div class="variant-item-cell">
                      <div class="variant-thumb-box">
                        <img src="../assets/images/product-4.webp" alt="Strawberry Watermelon">
                      </div>
                      <div>
                        <div class="variant-item-name">Strawberry Watermelon</div>
                        <div class="variant-item-meta"><span class="subrow-count">2</span> variants</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="variant-price-box">
                      <span>$</span>
                      <input type="text" class="variant-price-input" value="14.50">
                    </div>
                  </td>
                  <td>
                    <span class="variant-available-stock">80</span>
                  </td>
                  <td class="text-right">
                    <button type="button" class="variant-toggle-btn" data-toggle-group="subrow-4" title="Expand Sub-variants">
                      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                  </td>
                </tr>
                <tr class="variant-subrow subrow-4" data-flavor="Strawberry Watermelon" data-strength="3mg">
                  <td></td>
                  <td>
                    <div class="variant-subrow-content">
                      <span class="variant-subrow-bullet"></span>
                      <div>
                        <strong class="variant-subrow-title">3mg</strong>
                        <div class="variant-subrow-sku">SKU: VH-JH-50K-STW-3</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="variant-price-box variant-subrow-price-box">
                      <span>$</span>
                      <input type="text" class="variant-subprice-input" value="14.50">
                    </div>
                  </td>
                  <td>
                    <input type="number" class="admin-form-input variant-stock-input variant-subrow-stock-input" value="40">
                  </td>
                  <td></td>
                </tr>
                <tr class="variant-subrow subrow-4" data-flavor="Strawberry Watermelon" data-strength="6mg">
                  <td></td>
                  <td>
                    <div class="variant-subrow-content">
                      <span class="variant-subrow-bullet"></span>
                      <div>
                        <strong class="variant-subrow-title">6mg</strong>
                        <div class="variant-subrow-sku">SKU: VH-JH-50K-STW-6</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="variant-price-box variant-subrow-price-box">
                      <span>$</span>
                      <input type="text" class="variant-subprice-input" value="14.50">
                    </div>
                  </td>
                  <td>
                    <input type="number" class="admin-form-input variant-stock-input variant-subrow-stock-input" value="40">
                  </td>
                  <td></td>
                </tr>

                <!-- 5. Sweet Peach Pineapple -->
                <tr class="variant-parent-row" data-target-group="subrow-5" data-flavor="Sweet Peach Pineapple">
                  <td class="text-center">
                    <input type="checkbox" class="variant-checkbox">
                  </td>
                  <td>
                    <div class="variant-item-cell">
                      <div class="variant-thumb-box">
                        <img src="../assets/images/product-5.webp" alt="Sweet Peach Pineapple">
                      </div>
                      <div>
                        <div class="variant-item-name">Sweet Peach Pineapple</div>
                        <div class="variant-item-meta"><span class="subrow-count">2</span> variants</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="variant-price-box">
                      <span>$</span>
                      <input type="text" class="variant-price-input" value="14.50">
                    </div>
                  </td>
                  <td>
                    <span class="variant-available-stock">85</span>
                  </td>
                  <td class="text-right">
                    <button type="button" class="variant-toggle-btn" data-toggle-group="subrow-5" title="Expand Sub-variants">
                      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                  </td>
                </tr>
                <tr class="variant-subrow subrow-5" data-flavor="Sweet Peach Pineapple" data-strength="3mg">
                  <td></td>
                  <td>
                    <div class="variant-subrow-content">
                      <span class="variant-subrow-bullet"></span>
                      <div>
                        <strong class="variant-subrow-title">3mg</strong>
                        <div class="variant-subrow-sku">SKU: VH-JH-50K-SPP-3</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="variant-price-box variant-subrow-price-box">
                      <span>$</span>
                      <input type="text" class="variant-subprice-input" value="14.50">
                    </div>
                  </td>
                  <td>
                    <input type="number" class="admin-form-input variant-stock-input variant-subrow-stock-input" value="43">
                  </td>
                  <td></td>
                </tr>
                <tr class="variant-subrow subrow-5" data-flavor="Sweet Peach Pineapple" data-strength="6mg">
                  <td></td>
                  <td>
                    <div class="variant-subrow-content">
                      <span class="variant-subrow-bullet"></span>
                      <div>
                        <strong class="variant-subrow-title">6mg</strong>
                        <div class="variant-subrow-sku">SKU: VH-JH-50K-SPP-6</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="variant-price-box variant-subrow-price-box">
                      <span>$</span>
                      <input type="text" class="variant-subprice-input" value="14.50">
                    </div>
                  </td>
                  <td>
                    <input type="number" class="admin-form-input variant-stock-input variant-subrow-stock-input" value="42">
                  </td>
                  <td></td>
                </tr>
              </tbody>
            </table>
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
              <input type="text" id="seoTitleInput" name="seo_title" class="admin-form-input" placeholder="Enter custom SEO title" maxlength="70" value="<?php echo htmlspecialchars($product_data['seo_title']); ?>">
              <div class="char-counter"><span id="seoTitleCount">0</span> of 70 characters used</div>
            </div>

            <div class="admin-form-group">
              <label for="seoDescInput" class="admin-form-label">SEO Meta Description</label>
              <textarea id="seoDescInput" name="seo_description" class="admin-form-textarea" rows="3" placeholder="Enter meta description for search engines..." maxlength="320"><?php echo htmlspecialchars($product_data['seo_desc']); ?></textarea>
              <div class="char-counter"><span id="seoDescCount">0</span> of 320 characters used</div>
            </div>

            <div class="admin-form-group">
              <label for="slugInput" class="admin-form-label">URL Handle / Slug</label>
              <div class="input-prefix-container">
                <span class="prefix">.../products/</span>
                <input type="text" id="slugInput" name="slug" placeholder="juice-head-salt-vaporesso-50k" value="<?php echo htmlspecialchars($product_data['slug']); ?>">
              </div>
            </div>

          </div>

          <!-- Live Google Search Preview Card -->
          <div class="seo-preview-box">
            <div class="seo-preview-header">
              <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
              <span>New Vape Official Store</span>
            </div>
            <div class="seo-preview-url" id="seoPreviewUrl">www.newvape.com/products/<?php echo $product_data['slug'] ?: 'product-handle'; ?></div>
            <div class="seo-preview-title" id="seoPreviewTitle"><?php echo htmlspecialchars($product_data['title']) ?: 'Product Title'; ?></div>
            <div class="seo-preview-desc" id="seoPreviewDesc"><?php echo htmlspecialchars($product_data['seo_desc']) ?: 'Product description will appear in search results...'; ?></div>
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
              <option value="active" <?php echo ($product_data['status'] === 'active') ? 'selected' : ''; ?>>Active (Live on Storefront)</option>
              <option value="draft" <?php echo ($product_data['status'] === 'draft') ? 'selected' : ''; ?>>Draft (Hidden)</option>
              <option value="archived" <?php echo ($product_data['status'] === 'archived') ? 'selected' : ''; ?>>Archived</option>
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
                <option value="<?php echo htmlspecialchars($b); ?>" <?php echo ($b === $product_data['brand']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($b); ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Collection Selector -->
          <div class="admin-form-group">
            <label for="productCollection" class="admin-form-label">Primary Collection <span class="required">*</span></label>
            <select id="productCollection" name="collection" class="admin-form-select" required>
              <option value="">Select Collection</option>
              <?php foreach ($collections as $col): ?>
                <option value="<?php echo htmlspecialchars($col); ?>" <?php echo ($col === ($product_data['collection'] ?? $product_data['category'] ?? '')) ? 'selected' : ''; ?>><?php echo htmlspecialchars($col); ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Product Tags with Chips -->
          <div class="admin-form-group mb-0">
            <label for="tagInputField" class="admin-form-label">Product Tags</label>
            <input type="text" id="tagInputField" class="admin-form-input" placeholder="Type tag &amp; press Enter (e.g. Salt Nic, 50mg, Best Seller)...">
            <div class="selected-tags" id="tagsContainer">
              <?php if (!empty($product_data['tags'])): ?>
                <?php foreach ($product_data['tags'] as $t): ?>
                  <span class="tag-chip">
                    <span><?php echo htmlspecialchars($t); ?></span>
                    <button type="button" class="tag-chip-remove" title="Remove tag">&times;</button>
                  </span>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
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
        <span>Save Changes</span>
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
