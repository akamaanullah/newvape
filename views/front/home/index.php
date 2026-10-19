<?php
/**
 * HOMEPAGE (index.php)
 */

$page_title = 'Online Vape Store | Every Flavor. In Stock.';
$page_js    = 'home';

include dirname(__DIR__) . '/includes/header.php';
?>

<!-- ==========================================
     HERO BANNER SECTION
     ========================================== -->
<section class="hero-banner-section">
  <div class="hero-banner-container">
    <div class="hero-banner-card">
      
      <!-- Background Banner Image -->
      <img 
        src="assets/images/foger-switch-pro-new-pod-flavors-d-banner.webp" 
        alt="Foger Switch Pro - Every Flavor. In Stock." 
        class="hero-banner-bg"
      >

      <!-- Left Text & CTA Content -->
      <div class="hero-banner-content">
        <div class="hero-pill-badge">
          <span class="hero-pill-dot"></span>
          NEW FLAVORS
        </div>
        
        <h1 class="hero-title">Every Flavor. In Stock.</h1>
        
        <p class="hero-subtitle">The full Foger Switch Pro lineup is here.</p>
        
        <a href="shop.php?brand=foger" class="hero-cta-btn">
          Find Your Flavor
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </a>
      </div>

    </div>
  </div>
</section>

<!-- ==========================================
     TRUST / FEATURES BAR SECTION
     ========================================== -->
<section class="features-bar-section">
  <div class="container">
    <div class="features-bar-card">
      
      <!-- Feature 1: Fast Shipping -->
      <div class="feature-item">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
        </div>
        <div class="feature-text">
          <h4 class="feature-title">Fast Shipping</h4>
          <p class="feature-desc">We ship same day</p>
        </div>
      </div>

      <div class="feature-divider"></div>

      <!-- Feature 2: Secure Checkout -->
      <div class="feature-item">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
            <polyline points="9 12 11 14 15 10"></polyline>
          </svg>
        </div>
        <div class="feature-text">
          <h4 class="feature-title">Secure Checkout</h4>
          <p class="feature-desc">SSL encrypted payments</p>
        </div>
      </div>

      <div class="feature-divider"></div>

      <!-- Feature 3: Lower Prices -->
      <div class="feature-item">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
            <line x1="7" y1="7" x2="7.01" y2="7"></line>
          </svg>
        </div>
        <div class="feature-text">
          <h4 class="feature-title">Lower Prices</h4>
          <p class="feature-desc">Price match guarantee</p>
        </div>
      </div>

      <div class="feature-divider"></div>

      <!-- Feature 4: Authentic Products -->
      <div class="feature-item">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="9 12 11 14 15 10"></polyline>
          </svg>
        </div>
        <div class="feature-text">
          <h4 class="feature-title">Authentic Products</h4>
          <p class="feature-desc">100% genuine brands</p>
        </div>
      </div>

      <div class="feature-divider"></div>

      <!-- Feature 5: Great Customer Service -->
      <div class="feature-item">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
            <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
          </svg>
        </div>
        <div class="feature-text">
          <h4 class="feature-title">Great Customer Service</h4>
          <p class="feature-desc">Support when you need it</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ==========================================
     BROWSE CATEGORIES SECTION
     ========================================== -->
<section class="browse-categories-section">
  <div class="container">
    
    <!-- Section Header -->
    <div class="section-header">
      <h2 class="section-title">Browse Our Vape Categories</h2>
      <p class="section-subtitle">Find disposable vapes, e-liquids, nicotine pouches and more.</p>
    </div>

    <!-- Category Cards Grid -->
    <div class="categories-grid">
      <?php $categories = $categories ?? []; ?>
      <?php if (!empty($categories)): ?>
        <?php foreach ($categories as $cat): 
          $catUrl = url('category') . '?cat=' . urlencode($cat['slug']);
          $imgUrl = !empty($cat['header_image_url']) ? $cat['header_image_url'] : 'assets/images/img-1.png';
          if (!preg_match('~^(https?://|//|#)~i', $imgUrl)) {
              $imgUrl = url($imgUrl);
          }
        ?>
          <a href="<?= htmlspecialchars($catUrl) ?>" class="category-card">
            <div class="category-card-media">
              <img src="<?= htmlspecialchars($imgUrl) ?>" alt="<?= htmlspecialchars($cat['name']) ?>" class="category-card-img">
            </div>
            <div class="category-card-info">
              <h3 class="category-card-title"><?= htmlspecialchars($cat['name']) ?></h3>
              <?php if (!empty($cat['short_description'])): ?>
                <p class="category-card-desc"><?= htmlspecialchars($cat['short_description']) ?></p>
              <?php endif; ?>
            </div>
          </a>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

  </div>
</section>

<!-- ==========================================
     SHOP BY BRAND SECTION
     ========================================== -->
<section class="shop-by-brand-section">
  <div class="container">
    <div class="brand-showcase-card">
      
      <!-- Section Header -->
      <div class="section-header">
        <h2 class="section-title">Shop by Brand</h2>
        <p class="section-subtitle">We carry the top brands you know and love</p>
      </div>

      <!-- Brands 4x3 Grid -->
      <div class="brands-grid">
        <?php $brands = $brands ?? []; ?>
        <?php if (!empty($brands)): ?>
          <?php foreach ($brands as $b): ?>
            <?php
              $bSlug = $b['slug'] ?? '';
              $bName = $b['name'] ?? '';
              $bDesc = $b['description'] ?? 'Official Verified Vendor';
              $bLogo = !empty($b['logo_url']) ? $b['logo_url'] : 'assets/images/geek-bar.webp';
              if (!preg_match('~^(https?://|//|#)~i', $bLogo)) {
                  $bLogo = url($bLogo);
              }
            ?>
            <a href="<?= url('category?b=' . urlencode($bSlug)) ?>" class="brand-item-card">
              <div class="brand-logo-wrap">
                <img src="<?= htmlspecialchars($bLogo) ?>" alt="<?= htmlspecialchars($bName) ?>" class="brand-logo-img" onerror="this.src='<?= url('assets/images/geek-bar.webp') ?>';">
              </div>
              <div class="brand-item-info">
                <h3 class="brand-item-name"><?= htmlspecialchars($bName) ?></h3>
                <p class="brand-item-desc"><?= htmlspecialchars($bDesc) ?></p>
              </div>
            </a>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>

<!-- ==========================================
     NEW ARRIVALS: LATEST PRODUCTS SECTION
     ========================================== -->
<section class="products-showcase-section">
  <div class="container">
    
    <!-- Section Header with Title & Navigation Controls -->
    <div class="products-section-header">
      <div class="products-header-left">
        <h2 class="products-section-title">New Arrivals: Latest Products</h2>
        <p class="products-section-subtitle">Our newest products, shipped same day.</p>
      </div>
      <div class="products-header-right">
        <a href="<?= url('category') ?>?cat=new-arrivals" class="view-all-link">
          View All New Arrivals
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </a>
        <div class="slider-nav-arrows">
          <button type="button" class="slider-arrow-btn prev-btn" aria-label="Previous">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
          </button>
          <button type="button" class="slider-arrow-btn next-btn" aria-label="Next">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
          </button>
        </div>
      </div>
    </div>

            <!-- Products Grid (6 Columns) -->
    <div class="products-grid">
      <?php $newArrivals = $newArrivals ?? []; ?>
      <?php if (!empty($newArrivals)): ?>
        <?php foreach ($newArrivals as $prod): ?>
          <?php
            $pId = $prod['id'];
            $pSlug = !empty($prod['slug']) ? $prod['slug'] : $pId;
            $pTitle = $prod['title'] ?? $prod['name'] ?? '';
            $pPrice = (float)($prod['base_price'] ?? 0);
            $pCompare = !empty($prod['compare_price']) ? (float)$prod['compare_price'] : 0;
            $pImg = !empty($prod['featured_image']) ? $prod['featured_image'] : 'assets/images/no-image.svg';
            if (!preg_match('~^(https?://|//|#)~i', $pImg)) {
                $pImg = url($pImg);
            }
            $pBadgeText = $prod['badge_text'] ?? '';
            $pBadgeType = $prod['badge_type'] ?? '';
          ?>
          <div class="product-card">
            <div class="product-card-media">
              <div class="product-badges">
                <?php if ($pCompare > $pPrice): ?>
                  <?php $discountPct = round((($pCompare - $pPrice) / $pCompare) * 100); ?>
                  <span class="badge badge-discount">-<?= $discountPct ?>%</span>
                <?php endif; ?>
                <?php if (!empty($prod['is_new'])): ?>
                  <span class="badge badge-new">NEW</span>
                <?php endif; ?>
                <?php if (!empty($pBadgeText) && $pBadgeType !== 'discount' && $pBadgeText !== 'NEW'): ?>
                  <span class="badge badge-<?= htmlspecialchars($pBadgeType ?: 'hot') ?>"><?= htmlspecialchars($pBadgeText) ?></span>
                <?php endif; ?>
              </div>
              <a href="<?= url('product') ?>?id=<?= urlencode($pSlug) ?>" class="product-img-wrap">
                <img src="<?= htmlspecialchars($pImg) ?>" alt="<?= htmlspecialchars($pTitle) ?>" class="product-img" onerror="this.onerror=null;this.src='<?= url('assets/images/no-image.svg') ?>';">
              </a>
              <div class="product-action-wrap">
                <button type="button" class="btn-add-to-cart" data-id="<?= $pId ?>">ADD TO CART</button>
              </div>
            </div>
            <div class="product-card-info">
              <h3 class="product-title">
                <a href="<?= url('product') ?>?id=<?= urlencode($pSlug) ?>"><?= htmlspecialchars($pTitle) ?></a>
              </h3>
              <div class="product-price-row">
                <span class="current-price">$<?= number_format($pPrice, 2) ?></span>
                <?php if ($pCompare > $pPrice): ?>
                  <span class="old-price">$<?= number_format($pCompare, 2) ?></span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- ==========================================
     BEST SELLING VAPES & E-LIQUIDS SECTION
     ========================================== -->
<section class="products-showcase-section">
  <div class="container">
    
    <!-- Section Header with Title & Navigation Controls -->
    <div class="products-section-header">
      <div class="products-header-left">
        <h2 class="products-section-title">Best Selling Vapes &amp; E-Liquids</h2>
        <p class="products-section-subtitle">Most popular vapes and e-liquids chosen by our customers.</p>
      </div>
      <div class="products-header-right">
        <a href="<?= url('category') ?>?cat=best-sellers" class="view-all-link">
          View All Best Sellers
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </a>
        <div class="slider-nav-arrows">
          <button type="button" class="slider-arrow-btn prev-btn" aria-label="Previous">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
          </button>
          <button type="button" class="slider-arrow-btn next-btn" aria-label="Next">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
          </button>
        </div>
      </div>
    </div>

            <!-- Products Carousel Track (10 Products) -->
    <div class="products-grid">
      <?php $bestSellers = $bestSellers ?? []; ?>
      <?php if (!empty($bestSellers)): ?>
        <?php foreach ($bestSellers as $prod): ?>
          <?php
            $pId = $prod['id'];
            $pSlug = !empty($prod['slug']) ? $prod['slug'] : $pId;
            $pTitle = $prod['title'] ?? $prod['name'] ?? '';
            $pPrice = (float)($prod['base_price'] ?? 0);
            $pCompare = !empty($prod['compare_price']) ? (float)$prod['compare_price'] : 0;
            $pImg = !empty($prod['featured_image']) ? $prod['featured_image'] : 'assets/images/no-image.svg';
            if (!preg_match('~^(https?://|//|#)~i', $pImg)) {
                $pImg = url($pImg);
            }
            $pBadgeText = $prod['badge_text'] ?? '';
            $pBadgeType = $prod['badge_type'] ?? '';
            $ratingVal = round((float)($prod['rating_avg'] ?? 5));
            $reviewsCount = (int)($prod['reviews_count'] ?? 0);
          ?>
          <div class="product-card">
            <div class="product-card-media">
              <div class="product-badges">
                <?php if (!empty($pBadgeText) && $pBadgeType !== 'discount'): ?>
                  <span class="badge badge-<?= htmlspecialchars($pBadgeType ?: 'bogo') ?>"><?= htmlspecialchars($pBadgeText) ?></span>
                <?php endif; ?>
                <?php if ($pCompare > $pPrice): ?>
                  <?php $discountPct = round((($pCompare - $pPrice) / $pCompare) * 100); ?>
                  <span class="badge badge-discount">-<?= $discountPct ?>%</span>
                <?php endif; ?>
                <?php if ($reviewsCount >= 100 && $pBadgeText !== '🔥 HOT'): ?>
                  <span class="badge badge-hot">🔥 HOT</span>
                <?php endif; ?>
              </div>
              <a href="<?= url('product') ?>?id=<?= urlencode($pSlug) ?>" class="product-img-wrap">
                <img src="<?= htmlspecialchars($pImg) ?>" alt="<?= htmlspecialchars($pTitle) ?>" class="product-img" onerror="this.onerror=null;this.src='<?= url('assets/images/no-image.svg') ?>';">
              </a>
              <div class="product-action-wrap">
                <button type="button" class="btn-add-to-cart" data-id="<?= $pId ?>">ADD TO CART</button>
              </div>
            </div>
            <div class="product-card-info">
              <h3 class="product-title">
                <a href="<?= url('product') ?>?id=<?= urlencode($pSlug) ?>"><?= htmlspecialchars($pTitle) ?></a>
              </h3>
              <?php if ($reviewsCount > 0): ?>
                <div class="product-rating">
                  <div class="rating-stars">
                    <?php for ($s = 1; $s <= 5; $s++): ?>
                      <svg class="star-icon" viewBox="0 0 24 24" fill="<?= $s <= $ratingVal ? 'currentColor' : '#e2e8f0' ?>"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    <?php endfor; ?>
                  </div>
                  <span class="rating-count">(<?= $reviewsCount ?>)</span>
                </div>
              <?php endif; ?>
              <div class="product-price-row">
                <span class="current-price">$<?= number_format($pPrice, 2) ?></span>
                <?php if ($pCompare > $pPrice): ?>
                  <span class="old-price">$<?= number_format($pCompare, 2) ?></span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>



<!-- ==========================================
     TWIN PROMO BANNERS SECTION
     ========================================== -->
<section class="twin-banners-section">
  <div class="container">
    <div class="twin-banners-grid">
      
      <!-- Promo Banner 1: Foger Switch Pro -->
      <div class="promo-banner-card">
        <img src="assets/images/twin-banner.webp" alt="Foger Switch Pro" class="promo-banner-bg">
        <div class="promo-banner-content">
          <h3 class="promo-banner-title">Foger Switch Pro &mdash; Up to 30,000 Puffs</h3>
          <p class="promo-banner-subtitle">Pod system with power bank &amp; OLED display.</p>
          <a href="brand.php?b=foger" class="promo-banner-btn">
            Shop Foger Switch Pro
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
          </a>
        </div>
      </div>

      <!-- Promo Banner 2: Entire Adjust Lineup -->
      <div class="promo-banner-card">
        <img src="assets/images/twin-banner.webp" alt="Entire Adjust Lineup" class="promo-banner-bg">
        <div class="promo-banner-content">
          <h3 class="promo-banner-title">Entire Adjust Lineup</h3>
          <p class="promo-banner-subtitle">Tune your cool. Tune your flavor. Only $11.99.</p>
          <a href="brand.php?b=adjust" class="promo-banner-btn">
            Shop Adjust Series
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ==========================================
     SHOP DISPOSABLE VAPES (4x4 GRID - 16 CARDS)
     ========================================== -->
<section class="disposables-grid-section">
  <div class="container">
    
    <!-- Section Header -->
    <div class="products-section-header">
      <div class="products-header-left">
        <h2 class="products-section-title">Shop Disposable Vapes</h2>
        <p class="products-section-subtitle">Pre-filled disposable vape devices with high puff counts.</p>
      </div>
      <div class="products-header-right">
        <a href="<?= url('category') ?>?cat=disposables" class="view-all-link">
          Shop All Disposables
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </a>
      </div>
    </div>

        <!-- 4 Columns Grid (16 Cards) -->
    <div class="disposables-grid">
      <?php $disposableVapes = $disposableVapes ?? []; ?>
      <?php if (!empty($disposableVapes)): ?>
        <?php foreach ($disposableVapes as $prod): ?>
          <?php
            $pId = $prod['id'];
            $pSlug = !empty($prod['slug']) ? $prod['slug'] : $pId;
            $pTitle = $prod['title'] ?? $prod['name'] ?? '';
            $pPrice = (float)($prod['base_price'] ?? 0);
            $pCompare = !empty($prod['compare_price']) ? (float)$prod['compare_price'] : 0;
            $pImg = !empty($prod['featured_image']) ? $prod['featured_image'] : 'assets/images/no-image.svg';
            if (!preg_match('~^(https?://|//|#)~i', $pImg)) {
                $pImg = url($pImg);
            }
            $pBadgeText = $prod['badge_text'] ?? '';
            $pBadgeType = $prod['badge_type'] ?? '';
            $ratingVal = round((float)($prod['rating_avg'] ?? 5));
            $reviewsCount = (int)($prod['reviews_count'] ?? 0);
            $isUsa = (!empty($prod['tags']) && stripos($prod['tags'], 'USA') !== false);
          ?>
          <div class="product-card">
            <div class="product-card-media">
              <?php if ($pCompare > $pPrice || !empty($pBadgeText) || $isUsa): ?>
                <div class="product-badges">
                  <?php if ($pCompare > $pPrice): ?>
                    <?php $discountPct = round((($pCompare - $pPrice) / $pCompare) * 100); ?>
                    <span class="badge badge-discount">-<?= $discountPct ?>%</span>
                  <?php endif; ?>
                  <?php if ($isUsa): ?>
                    <span class="badge badge-usa">
                      <svg viewBox="0 0 16 12" width="12" height="9" style="border-radius:1px;"><rect width="16" height="12" fill="#b22234"/><rect y="1.85" width="16" height="1.85" fill="#fff"/><rect y="5.54" width="16" height="1.85" fill="#fff"/><rect y="9.23" width="16" height="1.85" fill="#fff"/><rect width="6.4" height="6.46" fill="#3c3b6e"/></svg>
                      USA
                    </span>
                  <?php endif; ?>
                  <?php if (!empty($pBadgeText) && $pBadgeType !== 'discount'): ?>
                    <span class="badge badge-<?= htmlspecialchars($pBadgeType ?: 'hot') ?>"><?= htmlspecialchars($pBadgeText) ?></span>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
              <a href="<?= url('product') ?>?id=<?= urlencode($pSlug) ?>" class="product-img-wrap">
                <img src="<?= htmlspecialchars($pImg) ?>" alt="<?= htmlspecialchars($pTitle) ?>" class="product-img" onerror="this.onerror=null;this.src='<?= url('assets/images/no-image.svg') ?>';">
              </a>
              <div class="product-action-wrap">
                <button type="button" class="btn-add-to-cart" data-id="<?= $pId ?>">ADD TO CART</button>
              </div>
            </div>
            <div class="product-card-info">
              <h3 class="product-title">
                <a href="<?= url('product') ?>?id=<?= urlencode($pSlug) ?>"><?= htmlspecialchars($pTitle) ?></a>
              </h3>
              <?php if ($reviewsCount > 0): ?>
                <div class="product-rating">
                  <div class="rating-stars">
                    <?php for ($s = 1; $s <= 5; $s++): ?>
                      <svg class="star-icon" viewBox="0 0 24 24" fill="<?= $s <= $ratingVal ? 'currentColor' : '#e2e8f0' ?>"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    <?php endfor; ?>
                  </div>
                  <span class="rating-count">(<?= $reviewsCount ?>)</span>
                </div>
              <?php endif; ?>
              <div class="product-price-row">
                <span class="current-price">$<?= number_format($pPrice, 2) ?></span>
                <?php if ($pCompare > $pPrice): ?>
                  <span class="old-price">$<?= number_format($pCompare, 2) ?></span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- ==========================================
     SHOP VAPE JUICES (1 ROW - 4 CARDS)
     ========================================== -->
<section class="disposables-grid-section vape-juices-section">
  <div class="container">
    
    <!-- Section Header -->
    <div class="products-section-header">
      <div class="products-header-left">
        <h2 class="products-section-title">Shop Vape Juices</h2>
        <p class="products-section-subtitle">E-liquids in nicotine salt, freebase and zero-nic options.</p>
      </div>
      <div class="products-header-right">
        <a href="<?= url('category') ?>?cat=eliquids" class="view-all-link">
          Shop All Vape Juices
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </a>
      </div>
    </div>

    <!-- 4 Columns Grid (4 Cards) -->
    <div class="disposables-grid">
      <?php $vapeJuices = $vapeJuices ?? []; ?>
      <?php if (!empty($vapeJuices)): ?>
        <?php foreach ($vapeJuices as $prod): ?>
          <?php
            $pId = $prod['id'];
            $pSlug = !empty($prod['slug']) ? $prod['slug'] : $pId;
            $pTitle = $prod['title'] ?? $prod['name'] ?? '';
            $pPrice = (float)($prod['base_price'] ?? 0);
            $pCompare = !empty($prod['compare_price']) ? (float)$prod['compare_price'] : 0;
            $pImg = !empty($prod['featured_image']) ? $prod['featured_image'] : 'assets/images/no-image.svg';
            if (!preg_match('~^(https?://|//|#)~i', $pImg)) {
                $pImg = url($pImg);
            }
            $pBadgeText = $prod['badge_text'] ?? '';
            $pBadgeType = $prod['badge_type'] ?? '';
            $ratingVal = round((float)($prod['rating_avg'] ?? 5));
            $reviewsCount = (int)($prod['reviews_count'] ?? 0);
          ?>
          <div class="product-card">
            <div class="product-card-media">
              <?php if ($pCompare > $pPrice || !empty($pBadgeText)): ?>
                <div class="product-badges">
                  <?php if ($pCompare > $pPrice): ?>
                    <?php $discountPct = round((($pCompare - $pPrice) / $pCompare) * 100); ?>
                    <span class="badge badge-discount">-<?= $discountPct ?>%</span>
                  <?php endif; ?>
                  <?php if (!empty($pBadgeText) && $pBadgeType !== 'discount'): ?>
                    <span class="badge badge-<?= htmlspecialchars($pBadgeType ?: 'hot') ?>"><?= htmlspecialchars($pBadgeText) ?></span>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
              <a href="<?= url('product') ?>?id=<?= urlencode($pSlug) ?>" class="product-img-wrap">
                <img src="<?= htmlspecialchars($pImg) ?>" alt="<?= htmlspecialchars($pTitle) ?>" class="product-img juice-product-img" onerror="this.onerror=null;this.src='<?= url('assets/images/no-image.svg') ?>';">
              </a>
              <div class="product-action-wrap">
                <button type="button" class="btn-add-to-cart" data-id="<?= $pId ?>">ADD TO CART</button>
              </div>
            </div>
            <div class="product-card-info">
              <h3 class="product-title">
                <a href="<?= url('product') ?>?id=<?= urlencode($pSlug) ?>"><?= htmlspecialchars($pTitle) ?></a>
              </h3>
              <?php if ($reviewsCount > 0): ?>
                <div class="product-rating">
                  <div class="rating-stars">
                    <?php for ($s = 1; $s <= 5; $s++): ?>
                      <svg class="star-icon" viewBox="0 0 24 24" fill="<?= $s <= $ratingVal ? 'currentColor' : '#e2e8f0' ?>"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    <?php endfor; ?>
                  </div>
                  <span class="rating-count">(<?= $reviewsCount ?>)</span>
                </div>
              <?php endif; ?>
              <div class="product-price-row">
                <span class="current-price">$<?= number_format($pPrice, 2) ?></span>
                <?php if ($pCompare > $pPrice): ?>
                  <span class="old-price">$<?= number_format($pCompare, 2) ?></span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- ==========================================
     SHOP NICOTINE POUCHES (1 ROW - 4 CARDS)
     ========================================== -->
<section class="disposables-grid-section pouches-section">
  <div class="container">
    
    <!-- Section Header -->
    <div class="products-section-header">
      <div class="products-header-left">
        <h2 class="products-section-title">Shop Nicotine Pouches</h2>
        <p class="products-section-subtitle">Tobacco-free nicotine pouches from ZYN, VELO and more.</p>
      </div>
      <div class="products-header-right">
        <a href="<?= url('category') ?>?cat=pouches" class="view-all-link">
          Shop All Pouches
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </a>
      </div>
    </div>

    <!-- 4 Columns Grid (4 Cards) -->
    <div class="disposables-grid">
      <?php $nicotinePouches = $nicotinePouches ?? []; ?>
      <?php if (!empty($nicotinePouches)): ?>
        <?php foreach ($nicotinePouches as $prod): ?>
          <?php
            $pId = $prod['id'];
            $pSlug = !empty($prod['slug']) ? $prod['slug'] : $pId;
            $pTitle = $prod['title'] ?? $prod['name'] ?? '';
            $pPrice = (float)($prod['base_price'] ?? 0);
            $pCompare = !empty($prod['compare_price']) ? (float)$prod['compare_price'] : 0;
            $pImg = !empty($prod['featured_image']) ? $prod['featured_image'] : 'assets/images/no-image.svg';
            if (!preg_match('~^(https?://|//|#)~i', $pImg)) {
                $pImg = url($pImg);
            }
            $pBadgeText = $prod['badge_text'] ?? '';
            $pBadgeType = $prod['badge_type'] ?? '';
            $ratingVal = round((float)($prod['rating_avg'] ?? 5));
            $reviewsCount = (int)($prod['reviews_count'] ?? 0);
          ?>
          <div class="product-card">
            <div class="product-card-media">
              <?php if ($pCompare > $pPrice || !empty($pBadgeText)): ?>
                <div class="product-badges">
                  <?php if ($pCompare > $pPrice): ?>
                    <?php $discountPct = round((($pCompare - $pPrice) / $pCompare) * 100); ?>
                    <span class="badge badge-discount">-<?= $discountPct ?>%</span>
                  <?php endif; ?>
                  <?php if (!empty($pBadgeText) && $pBadgeType !== 'discount'): ?>
                    <span class="badge badge-<?= htmlspecialchars($pBadgeType ?: 'hot') ?>"><?= htmlspecialchars($pBadgeText) ?></span>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
              <a href="<?= url('product') ?>?id=<?= urlencode($pSlug) ?>" class="product-img-wrap">
                <img src="<?= htmlspecialchars($pImg) ?>" alt="<?= htmlspecialchars($pTitle) ?>" class="product-img pouch-product-img" onerror="this.onerror=null;this.src='<?= url('assets/images/no-image.svg') ?>';">
              </a>
              <div class="product-action-wrap">
                <button type="button" class="btn-add-to-cart" data-id="<?= $pId ?>">ADD TO CART</button>
              </div>
            </div>
            <div class="product-card-info">
              <h3 class="product-title">
                <a href="<?= url('product') ?>?id=<?= urlencode($pSlug) ?>"><?= htmlspecialchars($pTitle) ?></a>
              </h3>
              <?php if ($reviewsCount > 0): ?>
                <div class="product-rating">
                  <div class="rating-stars">
                    <?php for ($s = 1; $s <= 5; $s++): ?>
                      <svg class="star-icon" viewBox="0 0 24 24" fill="<?= $s <= $ratingVal ? 'currentColor' : '#e2e8f0' ?>"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    <?php endfor; ?>
                  </div>
                  <span class="rating-count">(<?= $reviewsCount ?>)</span>
                </div>
              <?php endif; ?>
              <div class="product-price-row">
                <span class="current-price">$<?= number_format($pPrice, 2) ?></span>
                <?php if ($pCompare > $pPrice): ?>
                  <span class="old-price">$<?= number_format($pCompare, 2) ?></span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- ==========================================
     SHOP HEMP & THC PRODUCTS (1 ROW - 4 CARDS)
     ========================================== -->
<section class="disposables-grid-section hemp-thc-section">
  <div class="container">
    
    <!-- Section Header -->
    <div class="products-section-header">
      <div class="products-header-left">
        <h2 class="products-section-title">Shop Hemp &amp; THC Products</h2>
        <p class="products-section-subtitle">THCA vapes, THC-P disposables, hemp prerolls &amp; more.</p>
      </div>
      <div class="products-header-right">
        <a href="<?= url('category') ?>?cat=hemp-thc" class="view-all-link">
          Shop All Hemp
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </a>
      </div>
    </div>

    <!-- 4 Columns Grid (4 Cards) -->
    <div class="disposables-grid">
<?php $hempThc = $hempThc ?? []; ?>
      <?php if (!empty($hempThc)): ?>
        <?php foreach ($hempThc as $prod): ?>
          <?php
            $pId = $prod['id'];
            $pSlug = !empty($prod['slug']) ? $prod['slug'] : $pId;
            $pTitle = $prod['title'] ?? $prod['name'] ?? '';
            $pPrice = (float)($prod['base_price'] ?? 0);
            $pCompare = !empty($prod['compare_price']) ? (float)$prod['compare_price'] : 0;
            $pImg = !empty($prod['featured_image']) ? $prod['featured_image'] : 'assets/images/no-image.svg';
            if (!preg_match('~^(https?://|//|#)~i', $pImg)) {
                $pImg = url($pImg);
            }
            $pBadgeText = $prod['badge_text'] ?? '';
            $pBadgeType = $prod['badge_type'] ?? '';
            $isLowStock = ($prod['stock_status'] === 'Low Stock' || $pBadgeType === 'lowstock');
          ?>
          <div class="product-card">
            <div class="product-card-media">
              <?php if ($pCompare > $pPrice || !empty($pBadgeText) || $isLowStock): ?>
                <div class="product-badges">
                  <?php if ($isLowStock): ?>
                    <span class="badge badge-lowstock">LOW STOCK</span>
                  <?php endif; ?>
                  <?php if ($pCompare > $pPrice && $pBadgeType !== 'discount'): ?>
                    <?php $discountPct = round((($pCompare - $pPrice) / $pCompare) * 100); ?>
                    <span class="badge badge-discount">-<?= $discountPct ?>%</span>
                  <?php endif; ?>
                  <?php if (!empty($pBadgeText) && $pBadgeType !== 'lowstock' && $pBadgeType !== 'discount'): ?>
                    <span class="badge badge-<?= htmlspecialchars($pBadgeType ?: 'hot') ?>"><?= htmlspecialchars($pBadgeText) ?></span>
                  <?php elseif ($pBadgeType === 'discount' && !$isLowStock): ?>
                    <span class="badge badge-discount"><?= htmlspecialchars($pBadgeText) ?></span>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
              <a href="<?= url('product') ?>?id=<?= urlencode($pSlug) ?>" class="product-img-wrap">
                <img src="<?= htmlspecialchars($pImg) ?>" alt="<?= htmlspecialchars($pTitle) ?>" class="product-img hemp-product-img" onerror="this.onerror=null;this.src='<?= url('assets/images/no-image.svg') ?>';">
              </a>
              <div class="product-action-wrap">
                <button type="button" class="btn-add-to-cart" data-id="<?= $pId ?>">ADD TO CART</button>
              </div>
            </div>
            <div class="product-card-info">
              <h3 class="product-title">
                <a href="<?= url('product') ?>?id=<?= urlencode($pSlug) ?>"><?= htmlspecialchars($pTitle) ?></a>
              </h3>
              <div class="product-price-row">
                <span class="current-price">$<?= number_format($pPrice, 2) ?></span>
                <?php if ($pCompare > $pPrice): ?>
                  <span class="old-price">$<?= number_format($pCompare, 2) ?></span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>

  </div>
</section>


<!-- ==========================================
     SEO TRUSTED VAPE STORE CONTENT SECTION
     ========================================== -->
<section class="store-seo-content-section">
  <div class="container">
    <div class="seo-content-wrapper">
      <h2 class="seo-content-title">Your Trusted Online Vape Store</h2>
      <div class="seo-content-body">
        <p>We are a trusted online vape shop where you can buy vapes online with confidence. We stock a wide selection of <a href="javascript:void(0)">disposable vapes</a>, <a href="javascript:void(0)">e-liquids</a>, <a href="javascript:void(0)">nicotine pouches</a>, and <a href="javascript:void(0)">hemp &amp; THC products</a>, all from brands you know and love. Every product sold on our store is 100% authentic and ships fast from within the United States.</p>
        
        <p>How much does a vape cost? Disposable vapes start at $8.99, nicotine pouches at $6.99, and most high-puff devices stay under $25. We back that up with a price match guarantee: find a lower price at another online vape store and we will match it. No coupon hunting needed, the price you see is already the low one.</p>
        
        <p>Looking for high-puff devices? Browse our collection of <a href="javascript:void(0)">5,000 to 50,000+ puff disposable vapes</a> from top brands like Geek Bar, Lost Mary, RAZ, and more. We also carry vape juices in nicotine salt, freebase, TFN, and zero-nicotine options, plus vape pod systems and starter kits for every experience level. Interested in cannabinoids? Shop our <a href="javascript:void(0)">THCA vapes</a>, <a href="javascript:void(0)">THC-P disposables</a>, and <a href="javascript:void(0)">hemp prerolls</a>.</p>
        
        <p>So what makes us the best online vape store? Ask the people who shop here: our customers rate us 4.7 out of 5 stars across more than 1,700 reviews. Orders ship the same day, every purchase is covered by a 14-day return policy, and our support team actually answers when you need help with an order, a device, or a flavor recommendation.</p>
        
        <p class="seo-content-disclaimer">All products on this site are intended for adults of legal smoking age only. These products have not been evaluated by the Food and Drug Administration and are not intended to diagnose, treat, prevent, or cure any disease or condition. Keep all products out of the reach of children and pets.</p>
        
        <p class="seo-content-compliance">Our store is fully PACT Act compliant. We verify every order meets federal and state regulations so you can shop our online vape store worry-free.</p>
      </div>
    </div>
  </div>
</section>


<!-- ==========================================
     FROM OUR BLOG SECTION
     ========================================== -->
<section class="blog-showcase-section">
  <div class="container">
    
    <!-- Section Header with Title & Navigation Controls -->
    <div class="products-section-header">
      <div class="products-header-left">
        <h2 class="products-section-title">From Our Blog</h2>
        <p class="products-section-subtitle">Expert guides, reviews, and the latest vaping news.</p>
      </div>
      <div class="products-header-right">
        <a href="javascript:void(0)" class="view-all-link">
          Read All Posts
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </a>
        <div class="slider-nav-arrows">
          <button type="button" class="slider-arrow-btn prev-btn blog-prev-btn" aria-label="Previous">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
          </button>
          <button type="button" class="slider-arrow-btn next-btn blog-next-btn" aria-label="Next">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Blog Cards Grid / Slider Track -->
    <div class="blog-cards-grid">
      
      <!-- Blog Card 1 -->
      <article class="blog-card">
        <a href="javascript:void(0)" class="blog-card-thumb-link">
          <div class="blog-card-media">
            <img src="assets/images/blog-1.jpg" alt="Can You Refill a Foger Vape? What to Do Instead" class="blog-card-img">
          </div>
        </a>
        <div class="blog-card-content">
          <span class="blog-card-date">Sep 28, 2026</span>
          <h3 class="blog-card-title">
            <a href="javascript:void(0)">Can You Refill a Foger Vape? What to Do Instead</a>
          </h3>
          <p class="blog-card-excerpt">Neither Foger device takes e-liquid from a bottle. Here's what actually happens when a Foger runs dry, why the Switch Pro is...</p>
        </div>
      </article>

      <!-- Blog Card 2 -->
      <article class="blog-card">
        <a href="javascript:void(0)" class="blog-card-thumb-link">
          <div class="blog-card-media">
            <img src="assets/images/blog-2.jpg" alt="Foger Vape Guide: Every Device, Flavor and Feature Explained" class="blog-card-img">
          </div>
        </a>
        <div class="blog-card-content">
          <span class="blog-card-date">Sep 25, 2026</span>
          <h3 class="blog-card-title">
            <a href="javascript:void(0)">Foger Vape Guide: Every Device, Flavor and Feature Explained</a>
          </h3>
          <p class="blog-card-excerpt">A complete guide to the Foger vape range. What the brand makes, how the sealed Bit 35K differs from the modular Switch...</p>
        </div>
      </article>

      <!-- Blog Card 3 -->
      <article class="blog-card">
        <a href="javascript:void(0)" class="blog-card-thumb-link">
          <div class="blog-card-media">
            <img src="assets/images/blog-3.jpg" alt="How to Charge a JUUL: Dock, Charge Time and Fixes" class="blog-card-img">
          </div>
        </a>
        <div class="blog-card-content">
          <span class="blog-card-date">Sep 24, 2026</span>
          <h3 class="blog-card-title">
            <a href="javascript:void(0)">How to Charge a JUUL: Dock, Charge Time and Fixes</a>
          </h3>
          <p class="blog-card-excerpt">A JUUL Device charges on the USB Charging Dock it ships with, and a full charge takes about 1 hour. The battery is 200 mAh...</p>
        </div>
      </article>

      <!-- Blog Card 4 -->
      <article class="blog-card">
        <a href="javascript:void(0)" class="blog-card-thumb-link">
          <div class="blog-card-media">
            <img src="assets/images/blog-4.jpg" alt="Best Foger Vape Flavors 2026: Top Picks Ranked" class="blog-card-img">
          </div>
        </a>
        <div class="blog-card-content">
          <span class="blog-card-date">Sep 23, 2026</span>
          <h3 class="blog-card-title">
            <a href="javascript:void(0)">Best Foger Vape Flavors 2026: Top Picks Ranked</a>
          </h3>
          <p class="blog-card-excerpt">We ranked the best Foger vape flavors across the Bit 35K &amp; Switch Pro 30K. Real customer reviews, taste profiles, excl...</p>
        </div>
      </article>

    </div>

  </div>
</section>

<?php
include dirname(__DIR__) . '/includes/footer.php';
?>
