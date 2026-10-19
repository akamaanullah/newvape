<?php
$page_title = 'Inventory Management';
$current_admin_page = 'inventory';
$page_script = 'inventory.js';
include dirname(__DIR__) . '/includes/header.php';
?>

<div class="admin-content-inner">
  <!-- Top Bar / Page Header -->
  <div class="inventory-header-wrap">
    <h1 class="inventory-header-title">Inventory</h1>

    <!-- Filters & Action Toolbar -->
    <div class="inventory-toolbar-actions">
      <!-- Status Filter -->
      <div class="inventory-filter-item">
        <label for="invStatusFilter" class="inventory-filter-label">Status:</label>
        <select id="invStatusFilter" class="inventory-select-sm">
          <option value="all" <?= ($current_status === 'all') ? 'selected' : '' ?>>All Stocks</option>
          <option value="in_stock" <?= ($current_status === 'in_stock') ? 'selected' : '' ?>>In Stock</option>
          <option value="low_stock" <?= ($current_status === 'low_stock') ? 'selected' : '' ?>>Low Stock</option>
          <option value="out_of_stock" <?= ($current_status === 'out_of_stock') ? 'selected' : '' ?>>Out of Stock</option>
        </select>
      </div>

      <!-- Live Search -->
      <div class="inventory-filter-item">
        <input type="text" id="invSearchInput" class="inventory-search-input" placeholder="Search products or SKUs..." value="<?= htmlspecialchars($search_query ?? '') ?>">
      </div>

      <!-- Rows per page -->
      <div class="inventory-filter-item">
        <label for="invRowsPerPage" class="inventory-filter-label">Rows:</label>
        <select id="invRowsPerPage" class="inventory-select-sm">
          <option value="10" selected>10</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
      </div>

      <!-- Save All Adjustments Button -->
      <button type="button" id="btnSaveAllAdjustments" class="btn-save-adjustments" disabled title="Change any adjustment input below to enable">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
          <polyline points="17 21 17 13 7 13 7 21"></polyline>
          <polyline points="7 3 7 8 15 8"></polyline>
        </svg>
        <span>Save All Adjustments</span>
      </button>
    </div>
  </div>

  <?php if (!empty($success)): ?>
    <div class="admin-alert admin-alert-success" style="margin-bottom: 20px;">
      <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
      <span><?= htmlspecialchars($success) ?></span>
    </div>
  <?php endif; ?>

  <?php if (!empty($error)): ?>
    <div class="admin-alert admin-alert-danger" style="margin-bottom: 20px;">
      <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
      <span><?= htmlspecialchars($error) ?></span>
    </div>
  <?php endif; ?>

  <!-- Main Inventory Table Card -->
  <div class="inventory-table-card">
    <div class="table-responsive">
      <table class="inventory-table" id="inventoryMainTable">
        <thead>
          <tr>
            <th style="width: 44px; text-align: center;">
              <input type="checkbox" id="selectAllInv">
            </th>
            <th>Product / Variant</th>
            <th>SKU</th>
            <th>Current Stock</th>
            <th style="text-align: center; width: 110px;">Adjustment</th>
            <th style="text-align: center; width: 100px;">New Stock</th>
            <th style="text-align: center; width: 90px;">Action</th>
          </tr>
        </thead>
        <tbody id="inventoryTableBody">
          <?php if (empty($inventory)): ?>
            <tr>
              <td colspan="7" class="inv-empty-state">
                No inventory records found matching your filters.
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($inventory as $prod): ?>
              <?php 
                $pid = $prod['id'];
                $hasVariants = $prod['has_variants'];
                $variants = $prod['variants'];
              ?>
              <!-- Parent Product Row -->
              <tr class="inv-parent-row" data-product-id="<?= $pid ?>">
                <td style="text-align: center;">
                  <input type="checkbox" class="inv-row-checkbox">
                </td>
                <td>
                  <div class="inv-product-cell">
                    <?php if ($hasVariants): ?>
                      <button type="button" class="inv-chevron-btn" data-target="group-<?= $pid ?>" title="Click to expand/collapse variants">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                          <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                      </button>
                    <?php else: ?>
                      <span style="width: 24px; display: inline-block;"></span>
                    <?php endif; ?>

                    <img src="<?= asset($prod['img']) ?>" alt="<?= htmlspecialchars($prod['title']) ?>" class="inv-product-thumb" style="width: 38px; height: 38px; min-width: 38px; max-width: 38px; min-height: 38px; max-height: 38px; border-radius: 6px; object-fit: cover; border: 1px solid #e2e8f0; flex-shrink: 0;">
                    
                    <div>
                      <div class="inv-product-title"><?= htmlspecialchars($prod['title']) ?></div>
                      <div class="inv-product-meta">
                        <?= $hasVariants ? count($variants) . ' variant(s)' : 'Single SKU Product' ?>
                      </div>
                    </div>
                  </div>
                </td>
                <td>
                  <?php if ($hasVariants): ?>
                    <span class="inv-sku-multiple">Multiple SKUs</span>
                  <?php else: ?>
                    <span class="inv-variant-sku"><?= htmlspecialchars($prod['sku'] ?: '—') ?></span>
                  <?php endif; ?>
                </td>
                <td>
                  <span class="inv-stock-bold" id="parent-stock-<?= $pid ?>"><?= $prod['current_stock'] ?></span>
                </td>
                <td style="text-align: center;">
                  <?php if ($hasVariants): ?>
                    <span style="color: #94a3b8;">—</span>
                  <?php else: ?>
                    <input type="number" class="inv-adj-input" data-type="product" data-id="<?= $pid ?>" data-current="<?= $prod['current_stock'] ?>" value="0" step="1">
                  <?php endif; ?>
                </td>
                <td style="text-align: center;">
                  <?php if ($hasVariants): ?>
                    <span style="color: #94a3b8;">—</span>
                  <?php else: ?>
                    <span class="inv-new-stock" id="new-stock-prod-<?= $pid ?>"><?= $prod['current_stock'] ?></span>
                  <?php endif; ?>
                </td>
                <td style="text-align: center;">
                  <?php if ($hasVariants): ?>
                    <span style="color: #94a3b8;">—</span>
                  <?php else: ?>
                    <button type="button" class="btn-inv-apply" data-type="product" data-id="<?= $pid ?>">Apply</button>
                  <?php endif; ?>
                </td>
              </tr>

              <!-- Child Variant Rows (Nested) -->
              <?php if ($hasVariants): ?>
                <?php foreach ($variants as $v): ?>
                  <?php $vid = $v['id']; ?>
                  <tr class="inv-child-row group-<?= $pid ?>" data-parent-id="<?= $pid ?>" data-variant-id="<?= $vid ?>">
                    <td style="text-align: center;">
                      <input type="checkbox" class="inv-row-checkbox">
                    </td>
                    <td>
                      <div class="inv-variant-indent">
                        <span class="inv-bullet-dot"></span>
                        <span class="inv-variant-name"><?= htmlspecialchars($v['variant_name']) ?></span>
                      </div>
                    </td>
                    <td>
                      <span class="inv-variant-sku"><?= htmlspecialchars($v['sku'] ?: '—') ?></span>
                    </td>
                    <td>
                      <span class="inv-variant-stock" id="current-stock-var-<?= $vid ?>"><?= $v['stock_quantity'] ?></span>
                    </td>
                    <td style="text-align: center;">
                      <input type="number" class="inv-adj-input" data-type="variant" data-id="<?= $vid ?>" data-parent="<?= $pid ?>" data-current="<?= $v['stock_quantity'] ?>" value="0" step="1">
                    </td>
                    <td style="text-align: center;">
                      <span class="inv-new-stock" id="new-stock-var-<?= $vid ?>"><?= $v['stock_quantity'] ?></span>
                    </td>
                    <td style="text-align: center;">
                      <button type="button" class="btn-inv-apply" data-type="variant" data-id="<?= $vid ?>">Apply</button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>

            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Inventory Table Footer / Pagination -->
    <div class="table-card-footer" style="display: flex; align-items: center; justify-content: space-between; padding: 14px 20px; border-top: 1px solid #e2e8f0;">
      <div class="pagination-info-text" id="invPaginationInfo">
        Showing 1 to <?= count($inventory) ?> of <?= count($inventory) ?> items
      </div>
      <div class="pagination-controls" id="invPaginationControls">
        <button type="button" class="btn-pagination" id="invPrevBtn" disabled>Previous</button>
        <div class="pagination-pages" id="invPagesContainer">
          <button type="button" class="page-num active">1</button>
        </div>
        <button type="button" class="btn-pagination" id="invNextBtn" disabled>Next</button>
      </div>
    </div>
  </div>
</div>

<?php
include dirname(__DIR__) . '/includes/footer.php';
?>
