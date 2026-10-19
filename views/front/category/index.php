<?php
/**
 * CATEGORY / SHOP LISTING PAGE (category.php)
 * Displays category title, description, quick filter pills,
 * comprehensive sidebar filter accordion, toolbar, and 4-column product grid.
 */

$page_title = 'Disposable Vapes - Shop All Top Brands & Puffs | New Vape';
$page_js    = 'category';

include dirname(__DIR__) . '/includes/header.php';
?>

<!-- ==========================================
     1. BREADCRUMBS
     ========================================== -->
<nav class="category-breadcrumb-nav" aria-label="Breadcrumb">
  <div class="container">
    <ol class="breadcrumb-list">
      <li class="breadcrumb-item">
        <a href="<?= url() ?>">Home</a>
      </li>
      <li class="breadcrumb-separator" aria-hidden="true">
        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        Disposable Vapes
      </li>
    </ol>
  </div>
</nav>

<!-- ==========================================
     2. CATEGORY HEADER (CENTERED TITLE & DESC)
     ========================================== -->
<section class="category-header-section">
  <div class="container">
    <div class="category-header-content">
      <h1 class="category-title">Disposable Vapes</h1>
      <p class="category-description">
        Our largest category, running from 400-puff pocket devices to 100,000-puff pod systems. If you're not sure where to start, the 30K and 50K tiers hold most of what people buy.
      </p>

      <!-- Quick Filter Pills Row -->
      <div class="category-quick-pills-wrap">
        <div class="category-quick-pills">
          <button type="button" class="quick-pill-btn active" data-filter="all">Best Sellers</button>
          <button type="button" class="quick-pill-btn" data-filter="5k">5,000+ Puffs</button>
          <button type="button" class="quick-pill-btn" data-filter="10k">10,000+ Puffs</button>
          <button type="button" class="quick-pill-btn" data-filter="15k">15,000+ Puffs</button>
          <button type="button" class="quick-pill-btn" data-filter="20k">20,000+ Puffs</button>
          <button type="button" class="quick-pill-btn" data-filter="30k">30,000+ Puffs</button>
          <button type="button" class="quick-pill-btn" data-filter="50k">50,000+ Puffs</button>
          <button type="button" class="quick-pill-btn" data-filter="zero-nic">Zero Nicotine</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================
     3. MAIN CATEGORY CONTENT (SIDEBAR + PRODUCTS)
     ========================================== -->
<section class="category-main-section">
  <div class="container">
    <div class="category-layout-grid">

      <!-- ========================================
           LEFT COLUMN: FILTER SIDEBAR ("Shop By")
           ======================================== -->
      <aside class="category-sidebar-col" id="categorySidebarCol">
        <div class="sidebar-heading-row">
          <h2 class="sidebar-title">Shop By</h2>
          <!-- Mobile Close Button -->
          <button type="button" class="mobile-filter-close-btn" id="mobileFilterCloseBtn" aria-label="Close filters">
            &times;
          </button>
        </div>

        <div class="filter-card">

          <!-- 1. Category -->
          <div class="filter-accordion-group">
            <button type="button" class="filter-group-header" aria-expanded="false">
              <span class="filter-group-title">Category</span>
              <span class="filter-chevron" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </span>
            </button>
            <div class="filter-group-body">
              <ul class="filter-options-list">
                <li>
                  <label class="filter-option-label">
                    <input type="radio" name="filterCategory" class="filter-radio" checked>
                    <span class="filter-radio-custom"></span>
                    <span class="option-name">Best Sellers</span>
                    <span class="option-count">20</span>
                  </label>
                </li>
                <li>
                  <label class="filter-option-label">
                    <input type="radio" name="filterCategory" class="filter-radio">
                    <span class="filter-radio-custom"></span>
                    <span class="option-name">New Arrivals</span>
                    <span class="option-count">28</span>
                  </label>
                </li>
                <li>
                  <label class="filter-option-label">
                    <input type="radio" name="filterCategory" class="filter-radio">
                    <span class="filter-radio-custom"></span>
                    <span class="option-name">5,000+ Puffs</span>
                    <span class="option-count">11</span>
                  </label>
                </li>
                <li>
                  <label class="filter-option-label">
                    <input type="radio" name="filterCategory" class="filter-radio">
                    <span class="filter-radio-custom"></span>
                    <span class="option-name">10,000+ Puffs</span>
                    <span class="option-count">5</span>
                  </label>
                </li>
                <li>
                  <label class="filter-option-label">
                    <input type="radio" name="filterCategory" class="filter-radio">
                    <span class="filter-radio-custom"></span>
                    <span class="option-name">15,000+ Puffs</span>
                    <span class="option-count">6</span>
                  </label>
                </li>
                <li>
                  <label class="filter-option-label">
                    <input type="radio" name="filterCategory" class="filter-radio">
                    <span class="filter-radio-custom"></span>
                    <span class="option-name">20,000+ Puffs</span>
                    <span class="option-count">15</span>
                  </label>
                </li>
                <li>
                  <label class="filter-option-label">
                    <input type="radio" name="filterCategory" class="filter-radio">
                    <span class="filter-radio-custom"></span>
                    <span class="option-name">30,000+ Puffs</span>
                    <span class="option-count">35</span>
                  </label>
                </li>
                <li>
                  <label class="filter-option-label">
                    <input type="radio" name="filterCategory" class="filter-radio">
                    <span class="filter-radio-custom"></span>
                    <span class="option-name">50,000+ Puffs</span>
                    <span class="option-count">37</span>
                  </label>
                </li>
                <li>
                  <label class="filter-option-label">
                    <input type="radio" name="filterCategory" class="filter-radio">
                    <span class="filter-radio-custom"></span>
                    <span class="option-name">Zero Nicotine Vape</span>
                    <span class="option-count">4</span>
                  </label>
                </li>
                <li>
                  <label class="filter-option-label">
                    <input type="radio" name="filterCategory" class="filter-radio">
                    <span class="filter-radio-custom"></span>
                    <span class="option-name">Coffee Flavored Vape</span>
                    <span class="option-count">7</span>
                  </label>
                </li>
                <li>
                  <label class="filter-option-label">
                    <input type="radio" name="filterCategory" class="filter-radio">
                    <span class="filter-radio-custom"></span>
                    <span class="option-name">Built in the USA</span>
                    <span class="option-count">12</span>
                  </label>
                </li>
              </ul>
            </div>
          </div>

          <!-- 2. Device Color -->
          <div class="filter-accordion-group">
            <button type="button" class="filter-group-header" aria-expanded="false">
              <span class="filter-group-title">Device Color</span>
              <span class="filter-chevron" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </span>
            </button>
            <div class="filter-group-body">
              <ul class="filter-options-list">
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Black</span><span class="option-count">18</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Blue</span><span class="option-count">12</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Pink</span><span class="option-count">9</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Silver</span><span class="option-count">14</span></label></li>
              </ul>
            </div>
          </div>

          <!-- 3. Puff Count Range -->
          <div class="filter-accordion-group">
            <button type="button" class="filter-group-header" aria-expanded="false">
              <span class="filter-group-title">Puff Count Range</span>
              <span class="filter-chevron" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </span>
            </button>
            <div class="filter-group-body">
              <ul class="filter-options-list">
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Under 5,000</span><span class="option-count">8</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">5,000 - 15,000</span><span class="option-count">22</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">15,000 - 30,000</span><span class="option-count">45</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">30,000+</span><span class="option-count">56</span></label></li>
              </ul>
            </div>
          </div>

          <!-- 4. Hemp Product Type -->
          <div class="filter-accordion-group">
            <button type="button" class="filter-group-header" aria-expanded="false">
              <span class="filter-group-title">Hemp Product Type</span>
              <span class="filter-chevron" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </span>
            </button>
            <div class="filter-group-body">
              <ul class="filter-options-list">
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Delta-8 Vape</span><span class="option-count">14</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">THC-A Disposable</span><span class="option-count">20</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Live Resin Pod</span><span class="option-count">9</span></label></li>
              </ul>
            </div>
          </div>

          <!-- 5. Price -->
          <div class="filter-accordion-group">
            <button type="button" class="filter-group-header" aria-expanded="false">
              <span class="filter-group-title">Price</span>
              <span class="filter-chevron" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </span>
            </button>
            <div class="filter-group-body">
              <div class="filter-price-slider-wrap">
                <!-- Visual Slider Bar -->
                <div class="price-slider-track">
                  <div class="price-slider-fill" id="priceSliderFill"></div>
                  <input type="range" min="0" max="100" value="0" class="price-slider-thumb thumb-min" id="priceRangeMin">
                  <input type="range" min="0" max="100" value="100" class="price-slider-thumb thumb-max" id="priceRangeMax">
                </div>
                
                <!-- Min / Max Input Row -->
                <div class="price-input-boxes-row">
                  <input type="number" class="price-val-box" id="priceInputMin" value="0" min="0" max="100">
                  <span class="price-range-separator">to</span>
                  <input type="number" class="price-val-box" id="priceInputMax" value="100" min="0" max="100">
                </div>

                <!-- Apply Filter Button -->
                <button type="button" class="btn-apply-filter" id="btnApplyPriceFilter">
                  Apply Filter
                </button>
              </div>
            </div>
          </div>

          <!-- 6. Brand -->
          <div class="filter-accordion-group">
            <button type="button" class="filter-group-header" aria-expanded="false">
              <span class="filter-group-title">Brand</span>
              <span class="filter-chevron" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </span>
            </button>
            <div class="filter-group-body">
              <ul class="filter-options-list">
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Lost Mary</span><span class="option-count">42</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Geek Bar</span><span class="option-count">38</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">RAZ</span><span class="option-count">29</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">VIHO</span><span class="option-count">21</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Foger</span><span class="option-count">16</span></label></li>
              </ul>
            </div>
          </div>

          <!-- 7. Effect -->
          <div class="filter-accordion-group">
            <button type="button" class="filter-group-header" aria-expanded="false">
              <span class="filter-group-title">Effect</span>
              <span class="filter-chevron" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </span>
            </button>
            <div class="filter-group-body">
              <ul class="filter-options-list">
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Calm / Relaxing</span><span class="option-count">15</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Energy / Focus</span><span class="option-count">11</span></label></li>
              </ul>
            </div>
          </div>

          <!-- 8. Potency -->
          <div class="filter-accordion-group">
            <button type="button" class="filter-group-header" aria-expanded="false">
              <span class="filter-group-title">Potency</span>
              <span class="filter-chevron" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </span>
            </button>
            <div class="filter-group-body">
              <ul class="filter-options-list">
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Regular</span><span class="option-count">24</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Extra Strong</span><span class="option-count">36</span></label></li>
              </ul>
            </div>
          </div>

          <!-- 9. Hemp Formula -->
          <div class="filter-accordion-group">
            <button type="button" class="filter-group-header" aria-expanded="false">
              <span class="filter-group-title">Hemp Formula</span>
              <span class="filter-chevron" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </span>
            </button>
            <div class="filter-group-body">
              <ul class="filter-options-list">
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Full Spectrum</span><span class="option-count">19</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Broad Spectrum</span><span class="option-count">8</span></label></li>
              </ul>
            </div>
          </div>

          <!-- 10. Cannabinoid Type -->
          <div class="filter-accordion-group">
            <button type="button" class="filter-group-header" aria-expanded="false">
              <span class="filter-group-title">Cannabinoid Type</span>
              <span class="filter-chevron" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </span>
            </button>
            <div class="filter-group-body">
              <ul class="filter-options-list">
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">CBD</span><span class="option-count">14</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Delta-9 THC</span><span class="option-count">22</span></label></li>
              </ul>
            </div>
          </div>

          <!-- 11. Nicotine Strength -->
          <div class="filter-accordion-group">
            <button type="button" class="filter-group-header" aria-expanded="false">
              <span class="filter-group-title">Nicotine Strength</span>
              <span class="filter-chevron" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </span>
            </button>
            <div class="filter-group-body">
              <ul class="filter-options-list">
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">50mg (5%)</span><span class="option-count">98</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">20mg (2%)</span><span class="option-count">12</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">0mg (Nicotine Free)</span><span class="option-count">6</span></label></li>
              </ul>
            </div>
          </div>

          <!-- 12. Flavor -->
          <div class="filter-accordion-group">
            <button type="button" class="filter-group-header" aria-expanded="false">
              <span class="filter-group-title">Flavor</span>
              <span class="filter-chevron" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </span>
            </button>
            <div class="filter-group-body">
              <ul class="filter-options-list">
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Blue Razz Ice</span><span class="option-count">35</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Watermelon Ice</span><span class="option-count">40</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Miami Mint</span><span class="option-count">28</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Strawberry Banana</span><span class="option-count">20</span></label></li>
              </ul>
            </div>
          </div>

          <!-- 13. Color -->
          <div class="filter-accordion-group">
            <button type="button" class="filter-group-header" aria-expanded="false">
              <span class="filter-group-title">Color</span>
              <span class="filter-chevron" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </span>
            </button>
            <div class="filter-group-body">
              <ul class="filter-options-list">
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Blue / Silver</span><span class="option-count">16</span></label></li>
                <li><label class="filter-option-label"><input type="checkbox"><span class="filter-check-custom"></span><span class="option-name">Gold / Black</span><span class="option-count">14</span></label></li>
              </ul>
            </div>
          </div>

        </div>
      </aside>

      <!-- ========================================
           RIGHT COLUMN: PRODUCTS & TOOLBAR
           ======================================== -->
      <main class="category-products-col">

        <!-- Toolbar (View Switcher + Mobile Filter Button + Sort By) -->
        <div class="category-toolbar">

          <div class="toolbar-left">
            <!-- View Mode Switcher (Grid vs List) -->
            <div class="view-mode-switcher" role="group" aria-label="View Mode">
              <button type="button" class="view-btn grid-view active" id="btnGridView" aria-label="Grid View" title="Grid View">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2">
                  <rect x="3" y="3" width="7" height="7"></rect>
                  <rect x="14" y="3" width="7" height="7"></rect>
                  <rect x="14" y="14" width="7" height="7"></rect>
                  <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
              </button>
              <button type="button" class="view-btn list-view" id="btnListView" aria-label="List View" title="List View">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2">
                  <line x1="8" y1="6" x2="21" y2="6"></line>
                  <line x1="8" y1="12" x2="21" y2="12"></line>
                  <line x1="8" y1="18" x2="21" y2="18"></line>
                  <line x1="3" y1="6" x2="3.01" y2="6"></line>
                  <line x1="3" y1="12" x2="3.01" y2="12"></line>
                  <line x1="3" y1="18" x2="3.01" y2="18"></line>
                </svg>
              </button>
            </div>

            <!-- Mobile Filter Trigger Button -->
            <button type="button" class="mobile-filter-trigger-btn" id="mobileFilterTriggerBtn">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="4" y1="21" x2="4" y2="14"></line>
                <line x1="4" y1="10" x2="4" y2="3"></line>
                <line x1="12" y1="21" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12" y2="3"></line>
                <line x1="20" y1="21" x2="20" y2="16"></line>
                <line x1="20" y1="12" x2="20" y2="3"></line>
                <line x1="1" y1="14" x2="7" y2="14"></line>
                <line x1="9" y1="8" x2="15" y2="8"></line>
                <line x1="17" y1="16" x2="23" y2="16"></line>
              </svg>
              <span>Filters</span>
            </button>
          </div>

          <!-- Sort Dropdown -->
          <div class="toolbar-right">
            <div class="sort-select-wrapper">
              <select id="categorySortSelect" class="sort-select">
                <option value="position" selected>Position</option>
                <option value="price-asc">Price: Low to High</option>
                <option value="price-desc">Price: High to Low</option>
                <option value="name">Product Name</option>
                <option value="newest">Newest</option>
              </select>
              <button type="button" class="sort-direction-btn" id="sortDirectionBtn" aria-label="Toggle sort direction">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M7 15l5 5 5-5M7 9l5-5 5 5"></path>
                </svg>
              </button>
            </div>
          </div>
          
        </div>

        <!-- 4-Column Product Grid -->
        <div class="category-product-grid" id="categoryProductGrid">

          <!-- Product Card 1 -->
          <div class="category-product-card" data-category="30k" data-price="19.99">
            <div class="card-media-box">
              <div class="card-badges-wrap">
                <span class="badge-discount-tag">-13%</span>
                <span class="badge-hot-tag">🔥 HOT</span>
              </div>
              <a href="<?= url('product') ?>" class="card-img-link">
                <img src="assets/images/vape-image.webp" alt="RAZ RYL 35K Purse Vape" class="card-product-img">
              </a>
              <button type="button" class="btn-card-add-cart">ADD TO CART</button>
            </div>
            <div class="card-info-box">
              <h3 class="card-product-title">
                <a href="<?= url('product') ?>">RAZ RYL 35K Purse Vape - 35,000 Puffs, Classic, Spring &amp; Winter Flavors</a>
              </h3>
              <div class="card-rating-row">
                <span class="card-stars">★★★★★</span>
                <span class="card-reviews-count">(3)</span>
              </div>
              <div class="card-price-row">
                <span class="card-current-price">$19.99</span>
                <span class="card-old-price">$22.99</span>
              </div>
            </div>
          </div>

          <!-- Product Card 2 -->
          <div class="category-product-card" data-category="50k" data-price="15.99">
            <div class="card-media-box">
              <div class="card-badges-wrap">
                <span class="badge-discount-tag">-11%</span>
                <span class="badge-hot-tag">🔥 HOT</span>
              </div>
              <a href="<?= url('product') ?>" class="card-img-link">
                <img src="assets/images/nicotine-pouches.webp" alt="ZYN Cool Mint Nicotine Pouches" class="card-product-img">
              </a>
              <button type="button" class="btn-card-add-cart">ADD TO CART</button>
            </div>
            <div class="card-info-box">
              <h3 class="card-product-title">
                <a href="<?= url('product') ?>">ZYN Cool Mint Nicotine Pouches - 6mg &amp; 9mg, 15 Pouches per Can</a>
              </h3>
              <div class="card-rating-row">
                <span class="card-stars">★★★★★</span>
                <span class="card-reviews-count">(3)</span>
              </div>
              <div class="card-price-row">
                <span class="card-current-price">$15.99</span>
                <span class="card-old-price">$17.99</span>
              </div>
            </div>
          </div>

          <!-- Product Card 3 -->
          <div class="category-product-card" data-category="30k" data-price="9.99">
            <div class="card-media-box">
              <a href="<?= url('product') ?>" class="card-img-link">
                <img src="assets/images/e-liquid.webp" alt="Oxbar x Pod Juice SVOPP 30K Pod" class="card-product-img">
              </a>
              <button type="button" class="btn-card-add-cart">ADD TO CART</button>
            </div>
            <div class="card-info-box">
              <h3 class="card-product-title">
                <a href="<?= url('product') ?>">Oxbar x Pod Juice SVOPP 30K Pod - 13mL, Dual Mesh Hyper Coil</a>
              </h3>
              <div class="card-price-row">
                <span class="card-current-price">$9.99</span>
              </div>
            </div>
          </div>

          <!-- Product Card 4 -->
          <div class="category-product-card" data-category="50k" data-price="22.99">
            <div class="card-media-box">
              <div class="card-badges-wrap top-right-badge">
                <span class="badge-feature-tag">NEXCORE INSIDE</span>
              </div>
              <a href="<?= url('product') ?>" class="card-img-link">
                <img src="assets/images/vape-image.webp" alt="HQD Snap Kit 50K" class="card-product-img">
              </a>
              <button type="button" class="btn-card-add-cart">ADD TO CART</button>
            </div>
            <div class="card-info-box">
              <h3 class="card-product-title">
                <a href="<?= url('product') ?>">HQD Snap Kit 50K - Magnetic Modular Vape with Swappable Pods</a>
              </h3>
              <div class="card-price-row">
                <span class="card-current-price">$22.99</span>
              </div>
            </div>
          </div>

          <!-- Product Card 5 -->
          <div class="category-product-card" data-category="20k" data-price="16.99">
            <div class="card-media-box">
              <div class="card-badges-wrap">
                <span class="badge-new-tag">NEW</span>
              </div>
              <a href="<?= url('product') ?>" class="card-img-link">
                <img src="assets/images/nicotine-pouches.webp" alt="Tyson 2.0 Mint Nicotine Pouches" class="card-product-img">
              </a>
              <button type="button" class="btn-card-add-cart">ADD TO CART</button>
            </div>
            <div class="card-info-box">
              <h3 class="card-product-title">
                <a href="<?= url('product') ?>">Tyson 2.0 Mint Brawler Nicotine Pouches - 6mg Nicotine, 20-Pack</a>
              </h3>
              <div class="card-price-row">
                <span class="card-current-price">$16.99</span>
              </div>
            </div>
          </div>

          <!-- Product Card 6 -->
          <div class="category-product-card" data-category="50k" data-price="22.99">
            <div class="card-media-box">
              <div class="card-badges-wrap">
                <span class="badge-new-tag">NEW</span>
              </div>
              <a href="<?= url('product') ?>" class="card-img-link">
                <img src="assets/images/e-liquid.webp" alt="Keep It 100 Blue Slushie E-Liquid" class="card-product-img">
              </a>
              <button type="button" class="btn-card-add-cart">ADD TO CART</button>
            </div>
            <div class="card-info-box">
              <h3 class="card-product-title">
                <a href="<?= url('product') ?>">Keep It 100 E-Liquid - Blue Slushie 100mL Synthetic Nicotine</a>
              </h3>
              <div class="card-price-row">
                <span class="card-current-price">$22.99</span>
              </div>
            </div>
          </div>

          <!-- Product Card 7 -->
          <div class="category-product-card" data-category="pods" data-price="19.99">
            <div class="card-media-box">
              <div class="card-badges-wrap">
                <span class="badge-new-tag">NEW</span>
              </div>
              <a href="<?= url('product') ?>" class="card-img-link">
                <img src="assets/images/vape-image.webp" alt="Geek Bar Pulse 15K Vape" class="card-product-img">
              </a>
              <button type="button" class="btn-card-add-cart">ADD TO CART</button>
            </div>
            <div class="card-info-box">
              <h3 class="card-product-title">
                <a href="<?= url('product') ?>">Geek Bar Pulse 15K Disposable Vape - Dual Mesh, 16mL Pre-filled</a>
              </h3>
              <div class="card-price-row">
                <span class="card-current-price">$19.99</span>
              </div>
            </div>
          </div>

          <!-- Product Card 8 -->
          <div class="category-product-card" data-category="pods" data-price="19.99">
            <div class="card-media-box">
              <div class="card-badges-wrap">
                <span class="badge-new-tag">NEW</span>
              </div>
              <a href="<?= url('product') ?>" class="card-img-link">
                <img src="assets/images/nicotine-pouches.webp" alt="JUUL Pods 4-Pack" class="card-product-img">
              </a>
              <button type="button" class="btn-card-add-cart">ADD TO CART</button>
            </div>
            <div class="card-info-box">
              <h3 class="card-product-title">
                <a href="<?= url('product') ?>">JUUL Pods 4-Pack - Virginia Tobacco and Menthol, 3% and 5% Nicotine</a>
              </h3>
              <div class="card-price-row">
                <span class="card-current-price">$19.99</span>
              </div>
            </div>
          </div>

          <!-- Product Card 9 -->
          <div class="category-product-card" data-category="15k" data-price="17.99">
            <div class="card-media-box">
              <div class="card-badges-wrap">
                <span class="badge-discount-tag">-18%</span>
              </div>
              <a href="<?= url('product') ?>" class="card-img-link">
                <img src="assets/images/vape-image.webp" alt="Lost Mary MT15000 Turbo Vape" class="card-product-img">
              </a>
              <button type="button" class="btn-card-add-cart">ADD TO CART</button>
            </div>
            <div class="card-info-box">
              <h3 class="card-product-title">
                <a href="<?= url('product') ?>">Lost Mary MT15000 Turbo Vape - Thermal Edition, 15,000 Puffs</a>
              </h3>
              <div class="card-rating-row">
                <span class="card-stars">★★★★★</span>
                <span class="card-reviews-count">(5)</span>
              </div>
              <div class="card-price-row">
                <span class="card-current-price">$17.99</span>
                <span class="card-old-price">$21.99</span>
              </div>
            </div>
          </div>

          <!-- Product Card 10 -->
          <div class="category-product-card" data-category="pouches" data-price="14.99">
            <div class="card-media-box">
              <div class="card-badges-wrap">
                <span class="badge-hot-tag">🔥 HOT</span>
              </div>
              <a href="<?= url('product') ?>" class="card-img-link">
                <img src="assets/images/nicotine-pouches.webp" alt="VELO Spearmint Nicotine Pouches" class="card-product-img">
              </a>
              <button type="button" class="btn-card-add-cart">ADD TO CART</button>
            </div>
            <div class="card-info-box">
              <h3 class="card-product-title">
                <a href="<?= url('product') ?>">VELO Spearmint Nicotine Pouches - 4mg &amp; 7mg Tobacco-Free</a>
              </h3>
              <div class="card-price-row">
                <span class="card-current-price">$14.99</span>
              </div>
            </div>
          </div>

          <!-- Product Card 11 -->
          <div class="category-product-card" data-category="eliquid" data-price="18.99">
            <div class="card-media-box">
              <a href="<?= url('product') ?>" class="card-img-link">
                <img src="assets/images/e-liquid.webp" alt="Naked 100 Hawaiian POG E-Liquid" class="card-product-img">
              </a>
              <button type="button" class="btn-card-add-cart">ADD TO CART</button>
            </div>
            <div class="card-info-box">
              <h3 class="card-product-title">
                <a href="<?= url('product') ?>">Naked 100 Hawaiian POG E-Liquid - 60mL Passion Fruit &amp; Guava</a>
              </h3>
              <div class="card-price-row">
                <span class="card-current-price">$18.99</span>
              </div>
            </div>
          </div>

          <!-- Product Card 12 -->
          <div class="category-product-card" data-category="10k" data-price="16.99">
            <div class="card-media-box">
              <div class="card-badges-wrap">
                <span class="badge-new-tag">NEW</span>
              </div>
              <a href="<?= url('product') ?>" class="card-img-link">
                <img src="assets/images/vape-image.webp" alt="VIHO Turbo 10,000 Puffs Vape" class="card-product-img">
              </a>
              <button type="button" class="btn-card-add-cart">ADD TO CART</button>
            </div>
            <div class="card-info-box">
              <h3 class="card-product-title">
                <a href="<?= url('product') ?>">VIHO Turbo 10,000 Puffs Vape - Nexcore Dual Coil Smart Display</a>
              </h3>
              <div class="card-price-row">
                <span class="card-current-price">$16.99</span>
              </div>
            </div>
          </div>

          <!-- Product Card 13 -->
          <div class="category-product-card" data-category="pouches" data-price="15.99">
            <div class="card-media-box">
              <div class="card-badges-wrap">
                <span class="badge-hot-tag">🔥 HOT</span>
              </div>
              <a href="<?= url('product') ?>" class="card-img-link">
                <img src="assets/images/nicotine-pouches.webp" alt="ZYN Wintergreen 6mg Pouches" class="card-product-img">
              </a>
              <button type="button" class="btn-card-add-cart">ADD TO CART</button>
            </div>
            <div class="card-info-box">
              <h3 class="card-product-title">
                <a href="<?= url('product') ?>">ZYN Wintergreen Nicotine Pouches - 6mg Refreshing Mint, 15-Pack</a>
              </h3>
              <div class="card-price-row">
                <span class="card-current-price">$15.99</span>
              </div>
            </div>
          </div>

          <!-- Product Card 14 -->
          <div class="category-product-card" data-category="eliquid" data-price="21.99">
            <div class="card-media-box">
              <div class="card-badges-wrap">
                <span class="badge-discount-tag">-12%</span>
              </div>
              <a href="<?= url('product') ?>" class="card-img-link">
                <img src="assets/images/e-liquid.webp" alt="Sadboy Strawberry Jam E-Juice" class="card-product-img">
              </a>
              <button type="button" class="btn-card-add-cart">ADD TO CART</button>
            </div>
            <div class="card-info-box">
              <h3 class="card-product-title">
                <a href="<?= url('product') ?>">Sadboy Bloodline Strawberry Jam - 100mL Sweet Cookie &amp; Berry</a>
              </h3>
              <div class="card-price-row">
                <span class="card-current-price">$21.99</span>
                <span class="card-old-price">$24.99</span>
              </div>
            </div>
          </div>

          <!-- Product Card 15 -->
          <div class="category-product-card" data-category="10k" data-price="15.99">
            <div class="card-media-box">
              <a href="<?= url('product') ?>" class="card-img-link">
                <img src="assets/images/vape-image.webp" alt="Foger CT10000 Clear Tank Vape" class="card-product-img">
              </a>
              <button type="button" class="btn-card-add-cart">ADD TO CART</button>
            </div>
            <div class="card-info-box">
              <h3 class="card-product-title">
                <a href="<?= url('product') ?>">Foger CT10000 Clear Tank Vape - 10,000 Puffs Transparent Design</a>
              </h3>
              <div class="card-price-row">
                <span class="card-current-price">$15.99</span>
              </div>
            </div>
          </div>

          <!-- Product Card 16 -->
          <div class="category-product-card" data-category="pouches" data-price="13.99">
            <div class="card-media-box">
              <div class="card-badges-wrap">
                <span class="badge-new-tag">NEW</span>
              </div>
              <a href="<?= url('product') ?>" class="card-img-link">
                <img src="assets/images/nicotine-pouches.webp" alt="Rogue Honey Lemon Pouches" class="card-product-img">
              </a>
              <button type="button" class="btn-card-add-cart">ADD TO CART</button>
            </div>
            <div class="card-info-box">
              <h3 class="card-product-title">
                <a href="<?= url('product') ?>">Rogue Honey Lemon Nicotine Pouches - 6mg Slow Release, 20-Pack</a>
              </h3>
              <div class="card-price-row">
                <span class="card-current-price">$13.99</span>
              </div>
            </div>
          </div>

          <!-- Product Card 17 (Page 2) -->
          <div class="category-product-card" data-category="eliquid" data-price="14.99">
            <div class="card-media-box">
              <a href="<?= url('product') ?>" class="card-img-link">
                <img src="assets/images/e-liquid.webp" alt="Pod Juice Blue Razz Ice Salt Nic" class="card-product-img">
              </a>
              <button type="button" class="btn-card-add-cart">ADD TO CART</button>
            </div>
            <div class="card-info-box">
              <h3 class="card-product-title">
                <a href="<?= url('product') ?>">Pod Juice Blue Razz Ice - 30mL Premium Salt Nicotine 35mg</a>
              </h3>
              <div class="card-price-row">
                <span class="card-current-price">$14.99</span>
              </div>
            </div>
          </div>

          <!-- Product Card 18 (Page 2) -->
          <div class="category-product-card" data-category="20k" data-price="18.99">
            <div class="card-media-box">
              <div class="card-badges-wrap">
                <span class="badge-new-tag">NEW</span>
              </div>
              <a href="<?= url('product') ?>" class="card-img-link">
                <img src="assets/images/vape-image.webp" alt="Spaceman Prism 20K Vape" class="card-product-img">
              </a>
              <button type="button" class="btn-card-add-cart">ADD TO CART</button>
            </div>
            <div class="card-info-box">
              <h3 class="card-product-title">
                <a href="<?= url('product') ?>">Spaceman Prism 20K Disposable Vape - 3 Modes, 1.77-inch Screen</a>
              </h3>
              <div class="card-price-row">
                <span class="card-current-price">$18.99</span>
              </div>
            </div>
          </div>

          <!-- Product Card 19 (Page 2) -->
          <div class="category-product-card" data-category="pouches" data-price="12.99">
            <div class="card-media-box">
              <a href="<?= url('product') ?>" class="card-img-link">
                <img src="assets/images/nicotine-pouches.webp" alt="On! Coffee 4mg Nicotine Pouches" class="card-product-img">
              </a>
              <button type="button" class="btn-card-add-cart">ADD TO CART</button>
            </div>
            <div class="card-info-box">
              <h3 class="card-product-title">
                <a href="<?= url('product') ?>">On! Coffee 4mg Nicotine Pouches - Rich Roast Dry Minis, 20-Pack</a>
              </h3>
              <div class="card-price-row">
                <span class="card-current-price">$12.99</span>
              </div>
            </div>
          </div>

          <!-- Product Card 20 (Page 2) -->
          <div class="category-product-card" data-category="eliquid" data-price="19.99">
            <div class="card-media-box">
              <div class="card-badges-wrap">
                <span class="badge-discount-tag">-15%</span>
              </div>
              <a href="<?= url('product') ?>" class="card-img-link">
                <img src="assets/images/e-liquid.webp" alt="Juice Head Peach Pear 100mL" class="card-product-img">
              </a>
              <button type="button" class="btn-card-add-cart">ADD TO CART</button>
            </div>
            <div class="card-info-box">
              <h3 class="card-product-title">
                <a href="<?= url('product') ?>">Juice Head Peach Pear E-Liquid - 100mL Crisp Sweet Fruit</a>
              </h3>
              <div class="card-price-row">
                <span class="card-current-price">$19.99</span>
                <span class="card-old-price">$23.99</span>
              </div>
            </div>
          </div>

        </div>

        <!-- ========================================
             PAGINATION BAR
             ======================================== -->
        <div class="category-pagination-bar" id="categoryPaginationBar">
          <!-- Left: Items range count -->
          <div class="pagination-info">
            Items <span id="paginationRangeText">1 to 16</span> of <span id="paginationTotalText">20</span>
          </div>

          <!-- Center: Page numbers + Arrow controls -->
          <div class="pagination-controls" id="paginationControls">
            <button type="button" class="pagination-arrow-btn prev-btn disabled" id="btnPagePrev" aria-label="Previous Page">
              <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="15 18 9 12 15 6"></polyline>
              </svg>
            </button>
            <button type="button" class="pagination-num-btn active" data-page="1">1</button>
            <button type="button" class="pagination-num-btn" data-page="2">2</button>
            <button type="button" class="pagination-arrow-btn next-btn" id="btnPageNext" aria-label="Next Page">
              <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="9 18 15 12 9 6"></polyline>
              </svg>
            </button>
          </div>

          <!-- Right: Per Page Select (Show 16 / 20 / 24) -->
          <div class="pagination-per-page">
            <label for="itemsPerPageSelect" class="per-page-label">Show</label>
            <div class="per-page-select-wrap">
              <select id="itemsPerPageSelect" class="per-page-select" aria-label="Items per page">
                <option value="16" selected>16</option>
                <option value="20">20</option>
                <option value="24">24</option>
              </select>
              <span class="select-chevron" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </span>
            </div>
          </div>
        </div>

      </main>

    </div>

    <!-- ========================================
         BOTTOM SEO DESCRIPTION SECTION (FULL CONTAINER WIDTH)
         ======================================== -->
    <section class="category-bottom-description">
      <h2 class="category-bottom-title">Buy Disposable Vapes Online: Top Brands &amp; High Puff Counts</h2>
      <div class="category-bottom-text-wrap" id="categoryBottomTextWrap">
        <p class="category-bottom-text">
          Looking to <strong>buy disposable vapes online</strong>? New Vape carries the largest selection of premium disposable vapes from brands you trust, including <strong>Geek Bar</strong>, <strong>RAZ</strong>, <strong>Lost Mary</strong>, <strong>Sea</strong>, <strong>Off-Stamp</strong>, <strong>Luffbar</strong>, <strong>Mazaya</strong>, and dozens more. If you want a compact 5,000-puff device or a rechargeable 100K-puff powerhouse, we have the right disposable vape for you with fast USA shipping on qualifying orders.
        </p>
        <p class="category-bottom-text extra-text">
          From advanced smart LED screens displaying real-time e-liquid and battery levels to dual mesh hyper coils, pulse modes, and customizable airflow switches, modern disposable vapes deliver unmatched flavor and convenience. Whether you are craving refreshing Miami Mint, crisp Blue Razz Ice, tropical Watermelon blends, or zero nicotine alternatives, browse our complete inventory knowing every unit is 100% authentic and guaranteed fresh.
        </p>
      </div>
      <button type="button" class="btn-read-more-toggle" id="btnReadMoreToggle" aria-expanded="false">
        <span class="btn-read-more-label">Read More</span>
        <svg class="read-more-chevron" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="6 9 12 15 18 9"></polyline>
        </svg>
      </button>
    </section>

    <!-- ========================================
         CATEGORY FAQS ACCORDION SECTION
         ======================================== -->
    <section class="category-faqs-section">
      <h2 class="category-faqs-title">Frequently Asked Questions</h2>
      <div class="category-faqs-list">

        <!-- 1 -->
        <div class="category-faq-item">
          <button type="button" class="category-faq-question-btn" aria-expanded="false">
            <span class="faq-q-text">What are disposable vapes and how do they work?</span>
            <span class="faq-q-chevron" aria-hidden="true">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </span>
          </button>
          <div class="category-faq-answer-collapse">
            <div class="category-faq-answer-inner">
              <p>Disposable vapes are compact, all-in-one vaping devices that arrive pre-filled with e-liquid and pre-charged. They feature automatic draw activation, meaning there are no buttons to press or settings to adjust—simply inhale through the mouthpiece to create smooth, flavorful vapor. Once the pre-filled e-liquid is depleted, the device can be safely replaced.</p>
            </div>
          </div>
        </div>

        <!-- 2 -->
        <div class="category-faq-item">
          <button type="button" class="category-faq-question-btn" aria-expanded="false">
            <span class="faq-q-text">How long does a disposable vape last?</span>
            <span class="faq-q-chevron" aria-hidden="true">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </span>
          </button>
          <div class="category-faq-answer-collapse">
            <div class="category-faq-answer-inner">
              <p>A disposable vape's lifespan depends on its rated puff count and your daily usage. Moderate vapers typically get 1 to 2 weeks out of a 5,000-to-10,000 puff device, while high-capacity devices ranging from 20,000 to 50,000 puffs can easily last 3 to 6 weeks.</p>
            </div>
          </div>
        </div>

        <!-- 3 -->
        <div class="category-faq-item">
          <button type="button" class="category-faq-question-btn" aria-expanded="false">
            <span class="faq-q-text">Do disposable vapes contain nicotine?</span>
            <span class="faq-q-chevron" aria-hidden="true">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </span>
          </button>
          <div class="category-faq-answer-collapse">
            <div class="category-faq-answer-inner">
              <p>Most standard disposable vapes contain salt nicotine, typically at a 5% (50mg/mL) strength for a satisfying and smooth throat hit. However, we also stock 2% (20mg) and 0% (Zero Nicotine) options for vapers looking to lower their nicotine intake.</p>
            </div>
          </div>
        </div>

        <!-- 4 -->
        <div class="category-faq-item">
          <button type="button" class="category-faq-question-btn" aria-expanded="false">
            <span class="faq-q-text">Are disposable vapes rechargeable?</span>
            <span class="faq-q-chevron" aria-hidden="true">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </span>
          </button>
          <div class="category-faq-answer-collapse">
            <div class="category-faq-answer-inner">
              <p>Yes, the vast majority of modern disposable vapes offering 5,000 puffs or more feature a rechargeable battery via USB Type-C. This ensures the battery lasts until the very last drop of pre-filled e-liquid is vaporized.</p>
            </div>
          </div>
        </div>

        <!-- 5 -->
        <div class="category-faq-item">
          <button type="button" class="category-faq-question-btn" aria-expanded="false">
            <span class="faq-q-text">Are disposable vapes good for beginners?</span>
            <span class="faq-q-chevron" aria-hidden="true">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </span>
          </button>
          <div class="category-faq-answer-collapse">
            <div class="category-faq-answer-inner">
              <p>Yes, disposable vapes are the most beginner-friendly devices on the market. They require no coil changes, no manual tank refills, and no button configurations. Simply unbox and start puffing.</p>
            </div>
          </div>
        </div>

        <!-- 6 -->
        <div class="category-faq-item">
          <button type="button" class="category-faq-question-btn" aria-expanded="false">
            <span class="faq-q-text">What should I consider when choosing a disposable vape?</span>
            <span class="faq-q-chevron" aria-hidden="true">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </span>
          </button>
          <div class="category-faq-answer-collapse">
            <div class="category-faq-answer-inner">
              <p>When selecting your ideal device, consider your flavor preferences (fruity, icy mint, dessert, or classic tobacco), your target puff count, nicotine concentration, and modern features such as smart LED battery/juice screens, dual mesh coils, and adjustable airflow.</p>
            </div>
          </div>
        </div>

        <!-- 7 -->
        <div class="category-faq-item">
          <button type="button" class="category-faq-question-btn" aria-expanded="false">
            <span class="faq-q-text">What is the best 50,000 puff disposable vape?</span>
            <span class="faq-q-chevron" aria-hidden="true">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </span>
          </button>
          <div class="category-faq-answer-collapse">
            <div class="category-faq-answer-inner">
              <p>Top-rated 50K options include the HQD Snap Kit 50K and RAZ RX50K series. These cutting-edge devices feature high-capacity dual reservoirs, modular magnetic swappable pods, and dual mesh hyper coils for rich, sustained vapor delivery.</p>
            </div>
          </div>
        </div>

        <!-- 8 -->
        <div class="category-faq-item">
          <button type="button" class="category-faq-question-btn" aria-expanded="false">
            <span class="faq-q-text">Can I buy disposable vapes online in the USA?</span>
            <span class="faq-q-chevron" aria-hidden="true">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </span>
          </button>
          <div class="category-faq-answer-collapse">
            <div class="category-faq-answer-inner">
              <p>Yes, adult customers of legal smoking age (21+) can safely and legally purchase authentic disposable vapes online at New Vape. We use strict age verification technology at checkout and ship in compliance with federal and state regulations.</p>
            </div>
          </div>
        </div>

        <!-- 9 -->
        <div class="category-faq-item">
          <button type="button" class="category-faq-question-btn" aria-expanded="false">
            <span class="faq-q-text">What are rechargeable disposable vapes?</span>
            <span class="faq-q-chevron" aria-hidden="true">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </span>
          </button>
          <div class="category-faq-answer-collapse">
            <div class="category-faq-answer-inner">
              <p>Rechargeable disposable vapes come equipped with a standard USB-C charging port. While the e-liquid chamber is sealed and cannot be manually refilled, recharging the battery lets you vape massive e-liquid volumes (up to 20-30mL) without the battery dying prematurely.</p>
            </div>
          </div>
        </div>

        <!-- 10 -->
        <div class="category-faq-item">
          <button type="button" class="category-faq-question-btn" aria-expanded="false">
            <span class="faq-q-text">Which disposable vape brands does New Vape carry?</span>
            <span class="faq-q-chevron" aria-hidden="true">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </span>
          </button>
          <div class="category-faq-answer-collapse">
            <div class="category-faq-answer-inner">
              <p>We carry all top trusted brands including Geek Bar, RAZ, Lost Mary, VIHO, Foger, HQD, Oxbar, Tyson 2.0, Spaceman, Flum, Off-Stamp, and many more—all 100% genuine with scratch-off authenticity verification codes.</p>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- ========================================
         RELATED CATEGORIES SECTION
         ======================================== -->
    <section class="related-categories-section">
      <h2 class="related-categories-title">Related Categories</h2>
      <div class="related-categories-grid">

        <a href="javascript:void(0);" class="related-category-card">
          <span class="related-cat-name">Nicotine Pouches</span>
          <span class="related-cat-arrow" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </span>
        </a>

        <a href="javascript:void(0);" class="related-category-card">
          <span class="related-cat-name">Vape Juices</span>
          <span class="related-cat-arrow" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </span>
        </a>

        <a href="javascript:void(0);" class="related-category-card">
          <span class="related-cat-name">HQD Vapes</span>
          <span class="related-cat-arrow" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </span>
        </a>

        <a href="javascript:void(0);" class="related-category-card">
          <span class="related-cat-name">RAZ Vapes</span>
          <span class="related-cat-arrow" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </span>
        </a>

        <a href="javascript:void(0);" class="related-category-card">
          <span class="related-cat-name">Lost Mary Vapes</span>
          <span class="related-cat-arrow" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </span>
        </a>

        <a href="javascript:void(0);" class="related-category-card">
          <span class="related-cat-name">Hemp &amp; THC Products</span>
          <span class="related-cat-arrow" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </span>
        </a>

        <a href="javascript:void(0);" class="related-category-card">
          <span class="related-cat-name">Fume Vapes</span>
          <span class="related-cat-arrow" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </span>
        </a>

        <a href="javascript:void(0);" class="related-category-card">
          <span class="related-cat-name">Foger Vapes</span>
          <span class="related-cat-arrow" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </span>
        </a>

        <a href="javascript:void(0);" class="related-category-card">
          <span class="related-cat-name">Off-Stamp Vapes</span>
          <span class="related-cat-arrow" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </span>
        </a>

        <a href="javascript:void(0);" class="related-category-card">
          <span class="related-cat-name">Geek Bar THC Vape</span>
          <span class="related-cat-arrow" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </span>
        </a>

      </div>
    </section>

  </div>
</section>

<!-- Mobile Filter Backdrop -->
<div class="mobile-filter-backdrop" id="mobileFilterBackdrop"></div>

<?php
include dirname(__DIR__) . '/includes/footer.php';
?>
