<?php
/**
 * PRODUCT DETAILS PAGE (product.php)
 * Static template showcasing single product details with gallery, specs, flavor selector & buy box.
 */

$page_title = 'Lost Mary MT35000 Turbo Vape - 35,000 Puffs, 37 Flavors | New Vape';
$page_js    = 'product';

include dirname(__DIR__) . '/includes/header.php';
?>

<!-- ==========================================
     1. BREADCRUMB NAVIGATION
     ========================================== -->
<nav class="product-breadcrumb-nav" aria-label="Breadcrumb">
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
      <li class="breadcrumb-item">
        <a href="<?= url('category') ?>?cat=disposables">Disposables</a>
      </li>
      <li class="breadcrumb-separator" aria-hidden="true">
        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        Lost Mary MT35000 Turbo Vape - 35,000 Puffs, 37 Flavors, Hidden Display
      </li>
    </ol>
  </div>
</nav>

<!-- ==========================================
     2. PRODUCT MAIN SECTION (GALLERY & BUY BOX)
     ========================================== -->
<section class="product-main-section">
  <div class="container">
    <div class="product-main-grid">

      <!-- ========================================
           LEFT COLUMN: IMAGE GALLERY
           ======================================== -->
      <div class="product-gallery-col">
        <div class="product-gallery-sticky">
          
          <?php 
            $galleryList = [];
            if (!empty($productImages)) {
              foreach ($productImages as $pImg) {
                $galleryList[] = $pImg['image_url'];
              }
            }
            if (empty($galleryList)) {
              $galleryList[] = !empty($product['featured_image']) ? $product['featured_image'] : (!empty($product['img']) ? $product['img'] : 'assets/images/no-image.svg');
            }
            $mainImgSrc = $galleryList[0];
          ?>
          <!-- Main Large Image Card -->
          <div class="product-main-image-card">
            <div class="main-image-viewport">
              <img 
                id="productMainImage" 
                src="<?= asset($mainImgSrc) ?>" 
                alt="<?= e($product['title'] ?? 'Product') ?>" 
                class="product-main-img"
                onerror="this.onerror=null;this.src='<?= asset('assets/images/no-image.svg') ?>';"
              >
            </div>
          </div>

          <!-- Thumbnails Row -->
          <?php if (count($galleryList) > 1): ?>
          <div class="product-thumbnails-track">
            <?php foreach ($galleryList as $tIdx => $tImg): ?>
              <button type="button" class="product-thumb-btn <?= $tIdx === 0 ? 'active' : '' ?>" data-img="<?= asset($tImg) ?>" aria-label="View product image <?= $tIdx + 1 ?>">
                <img src="<?= asset($tImg) ?>" alt="<?= e($product['title'] ?? 'Product') ?> thumbnail <?= $tIdx + 1 ?>">
              </button>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>

        </div>
      </div>

      <!-- ========================================
           RIGHT COLUMN: PRODUCT DETAILS & BUY BOX
           ======================================== -->
      <div class="product-info-col">
        
        <!-- Brand Name -->
        <div class="product-brand-tag">
          <a href="<?= url('category') ?>?brand=<?= urlencode(strtolower($product['brand'] ?? 'LOST MARY')) ?>">
            <?= e($product['brand'] ?? 'LOST MARY') ?>
          </a>
        </div>

        <!-- Product Title -->
        <h1 class="product-details-title">
          <?= e($product['title'] ?? 'Lost Mary MT35000 Turbo Vape - 35,000 Puffs, 37 Flavors, Hidden Display') ?>
        </h1>

        <!-- SKU & Star Rating Row -->
        <div class="product-meta-row">
          <span class="product-sku">SKU: <?= e($product['sku'] ?? 'LM-MT35000-35K-DV') ?></span>
          <div class="product-rating-wrap">
            <div class="rating-stars" aria-label="5 out of 5 stars">
              ★★★★★
            </div>
            <a href="#reviews" class="rating-count"><?= !empty($productReviews) ? count($productReviews) : 3 ?> Reviews</a>
          </div>
        </div>

        <!-- Pricing Row -->
        <div class="product-price-section">
          <?php if (!empty($product['compare_price'])): ?>
          <span class="product-price-old"><?= strpos((string)$product['compare_price'], '$') === false ? '$' . number_format((float)$product['compare_price'], 2) : e($product['compare_price']) ?></span>
          <?php endif; ?>
          <span class="product-price-current"><?= strpos((string)($product['price'] ?? $product['base_price'] ?? '$18.49'), '$') === false ? '$' . number_format((float)($product['price'] ?? $product['base_price']), 2) : e($product['price'] ?? $product['base_price'] ?? '$18.49') ?></span>
          <span class="product-discount-pill">SAVE 13%</span>
        </div>

        <!-- Stock Status Strip -->
        <div class="product-stock-status in-stock">
          <span class="stock-dot"></span>
          <span class="stock-text">
            <strong><?= e($product['status'] ?? $product['stock_status'] ?? 'In Stock') ?>.</strong> Ships today if ordered by 3:00 PM EST
          </span>
        </div>

        <!-- Short Description Paragraph -->
        <p class="product-short-desc">
          <?= !empty($product['short_desc']) ? $product['short_desc'] : 'The <strong>Lost Mary MT35000 Turbo</strong> is a 35,000 puff disposable vape with 18ml of 5% nicotine salt, dual mesh coils and a 1000mAh battery. A hidden display shows battery mode and e-liquid when you draw. 37 flavors in stock.' ?>
        </p>

        <!-- Dynamic Spec / Feature Boxes Grid -->
        <?php if (!empty($productHighlights)): ?>
        <div class="product-spec-boxes-grid">
          <?php foreach ($productHighlights as $highlight): ?>
          <div class="spec-box">
            <div class="spec-icon">
              <?php
                $icon = strtolower($highlight['icon_type'] ?? $highlight['label'] ?? '');
                if (strpos($icon, 'puff') !== false):
              ?>
              <!-- Puffs Vapor Icon -->
              <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 3v3m6.366 1.634l-2.12 2.12M21 12h-3m-1.634 6.366l-2.12-2.12M12 21v-3m-6.366-1.634l2.12-2.12M3 12h3m1.634-6.366l2.12 2.12"></path>
              </svg>
              <?php elseif (strpos($icon, 'nic') !== false || strpos($icon, 'strength') !== false): ?>
              <!-- Nicotine Icon -->
              <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="9"></circle>
                <path d="M12 3a9 9 0 0 0 0 18z" fill="currentColor"></path>
              </svg>
              <?php elseif (strpos($icon, 'batt') !== false): ?>
              <!-- Battery Icon -->
              <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="7" width="16" height="10" rx="2" ry="2"></rect>
                <line x1="22" y1="11" x2="22" y2="13"></line>
                <line x1="6" y1="11" x2="6" y2="13"></line>
                <line x1="10" y1="11" x2="10" y2="13"></line>
              </svg>
              <?php else: ?>
              <!-- Capacity / Flask Icon -->
              <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M10 2v5l-4.5 9A4 4 0 0 0 9 21h6a4 4 0 0 0 3.5-5L14 7V2"></path>
                <line x1="8.5" y1="14" x2="15.5" y2="14"></line>
              </svg>
              <?php endif; ?>
            </div>
            <div class="spec-details">
              <span class="spec-label"><?= e($highlight['label']) ?></span>
              <span class="spec-value"><?= e($highlight['value']) ?></span>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Dynamic Flavor / Variant Selector Dropdown -->
        <?php if (!empty($productVariants)): ?>
        <div class="product-variant-group">
          <label for="flavorSelect" class="variant-label">
            Flavor / Option
          </label>
          <div class="flavor-select-wrapper">
            <select id="flavorSelect" class="product-flavor-select">
              <?php foreach ($productVariants as $idx => $variant): ?>
              <option value="<?= e($variant['variant_name']) ?>" <?= $idx === 0 ? 'selected' : '' ?>>
                <?= e($variant['variant_name']) ?>
              </option>
              <?php endforeach; ?>
            </select>
            <div class="select-chevron-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <!-- Actions Row: Quantity Selector + Add to Cart -->
        <div class="product-purchase-row">
          
          <!-- Quantity Counter -->
          <div class="product-qty-selector">
            <button type="button" class="qty-btn" id="qtyMinus" aria-label="Decrease quantity">&minus;</button>
            <input type="number" id="productQuantity" class="qty-input" value="1" min="1" max="99" readonly>
            <button type="button" class="qty-btn" id="qtyPlus" aria-label="Increase quantity">&plus;</button>
          </div>

          <!-- Add to Cart (Gold/Yellow Button) -->
          <button type="button" class="btn-product-add-cart" id="btnProductAddToCart">
            Add to cart
          </button>
        </div>

        <!-- Buy It Now Button (Black Solid Button) -->
        <button type="button" class="btn-product-buy-now" id="btnProductBuyNow">
          Buy it now
        </button>

        <!-- Limited-Time Bundle Promotional Banner -->
        <div class="product-promo-banner-card">
          <a href="shop.php?bundle=promo" class="product-promo-link">
            <img 
              src="assets/images/limited-time.webp" 
              alt="Limited-Time Bundle: Buy The Kit, Get 2 Pods Free" 
              class="product-promo-img"
            >
          </a>
        </div>

        <!-- Trust / Features Bar -->
        <div class="product-trust-features-strip">
          
          <div class="trust-feature-item">
            <div class="trust-feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
            </div>
            <div class="trust-feature-text">
              <span class="trust-feature-title">Fast Shipping</span>
              <span class="trust-feature-desc">We ship same day</span>
            </div>
          </div>

          <div class="trust-feature-item">
            <div class="trust-feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                <polyline points="9 12 11 14 15 10"></polyline>
              </svg>
            </div>
            <div class="trust-feature-text">
              <span class="trust-feature-title">Secure Checkout</span>
              <span class="trust-feature-desc">SSL encrypted payments</span>
            </div>
          </div>

          <div class="trust-feature-item">
            <div class="trust-feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                <line x1="7" y1="7" x2="7.01" y2="7"></line>
              </svg>
            </div>
            <div class="trust-feature-text">
              <span class="trust-feature-title">Lower Prices</span>
              <span class="trust-feature-desc">Price match guarantee</span>
            </div>
          </div>

          <div class="trust-feature-item">
            <div class="trust-feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="9 12 11 14 15 10"></polyline>
              </svg>
            </div>
            <div class="trust-feature-text">
              <span class="trust-feature-title">Authentic Products</span>
              <span class="trust-feature-desc">100% genuine brands</span>
            </div>
          </div>

        </div>

      </div>

    </div>
  </div>
</section>

<!-- ==========================================
     3. PRODUCT TABS SECTION
     (Description, More Information, Reviews, FAQs, Related Posts)
     ========================================== -->
<section class="product-tabs-section" id="productTabsSection">
  <div class="container">
    
    <!-- Tab Navigation Header Strip -->
    <div class="product-tabs-nav-wrap">
      <ul class="product-tabs-nav" role="tablist">
        <li class="product-tab-item" role="presentation">
          <button type="button" class="product-tab-btn active" role="tab" aria-selected="true" data-tab="tab-description" id="tabBtnDescription">
            Description
          </button>
        </li>
        <li class="product-tab-item" role="presentation">
          <button type="button" class="product-tab-btn" role="tab" aria-selected="false" data-tab="tab-more-info" id="tabBtnMoreInfo">
            More Information
          </button>
        </li>
        <li class="product-tab-item" role="presentation">
          <button type="button" class="product-tab-btn" role="tab" aria-selected="false" data-tab="tab-reviews" id="tabBtnReviews">
            Reviews
          </button>
        </li>
        <li class="product-tab-item" role="presentation">
          <button type="button" class="product-tab-btn" role="tab" aria-selected="false" data-tab="tab-faqs" id="tabBtnFaqs">
            FAQs
          </button>
        </li>
        <li class="product-tab-item" role="presentation">
          <button type="button" class="product-tab-btn" role="tab" aria-selected="false" data-tab="tab-related-posts" id="tabBtnRelatedPosts">
            Related Posts
          </button>
        </li>
      </ul>
    </div>

    <!-- Tab Panels Container -->
    <div class="product-tabs-content">

      <!-- ========================================
           TAB 1: DESCRIPTION
           ======================================== -->
      <div class="product-tab-pane active" id="tab-description" role="tabpanel" aria-labelledby="tabBtnDescription">
        <div class="tab-description-content">
          <h3 class="tab-content-title">What is the Lost Mary MT35000 Turbo?</h3>
          <p>
            The Lost Mary MT35000 Turbo is a rechargeable disposable vape rated for 35,000 puffs in Smooth Mode and about 20,000 in Turbo Mode. It carries 18mL of 5% nicotine salt, dual mesh coils, a 1,000mAh battery and a display that stays hidden until you draw. With 37 flavors in stock at New Vape, it has the widest menu of any 35K device we sell.
          </p>

          <h3 class="tab-content-title">How many puffs do you really get?</h3>
          <p>
            Treat 35,000 as the ceiling. That figure assumes Smooth Mode and short draws. Turbo Mode raises the power for warmer, denser vapor and a firmer throat hit, and it cuts the rating to about 20,000. Most people mix the two, so an average daily vaper lands around two months per device. Heavy Turbo use gets closer to a month.
          </p>
          <p>
            Smooth Mode is the everyday setting: cooler draws, steady flavor, maximum puff count. Turbo Mode is for the first pulls of the day or when you want a harder hit. A switch on the body changes modes, and the display confirms which one is active.
          </p>

          <h3 class="tab-content-title">Which of the 37 flavors should you pick?</h3>
          <p>
            Baja Splash is the crowd favorite and the one to start with. Scary Berry and Tigers Blood are the complex picks for fruit fans. Miami Mint, Winter Mint and Black Mint cover the mint side from light to deep. The Pixy editions (Red, Purple, White, Yellow and Orange) are candy-forward, and Half &amp; Half and Classic Tobacco are the two non-fruit options. Read our <a href="<?= url('blog') ?>?article=flavors-guide">MT35000 Turbo flavors guide</a> for every flavor ranked.
          </p>

          <h3 class="tab-content-title">Battery, charging and the hidden display</h3>
          <p>
            The 1,000mAh battery is the largest in the brand's 35K tier and charges by USB-C in about 90 minutes. No cable is included. The Blend-In display stays dark until you take a puff, then shows battery level, active mode and remaining e-liquid and switches off again. It saves battery and keeps the device discreet.
          </p>

          <h3 class="tab-content-title">Specs at a glance</h3>
          <ul class="tab-specs-bullet-list">
            <li><strong>Puffs:</strong> up to 35,000 in Smooth Mode, about 20,000 in Turbo Mode</li>
            <li><strong>E-liquid:</strong> 18mL, 5% (50mg/mL) nicotine salt</li>
            <li><strong>Coils:</strong> dual mesh</li>
            <li><strong>Battery:</strong> 1,000mAh, USB-C, about 90 minutes to full</li>
            <li><strong>Display:</strong> hidden Blend-In screen for battery, mode and e-liquid</li>
            <li><strong>Airflow:</strong> fixed, a slightly loose mouth-to-lung draw</li>
            <li><strong>Size:</strong> 43 x 23 x 106 mm, draw activated</li>
            <li><strong>Flavors:</strong> 37 at New Vape</li>
          </ul>

          <h3 class="tab-content-title">MT35000 Turbo or Ultrasonic 35K?</h3>
          <p>
            Both are Lost Mary at 35,000 puffs. Pick the MT35000 Turbo for the 37-flavor menu, the bigger battery and the hidden display. Pick the <a href="<?= url('product') ?>?id=ultrasonic-35k">Lost Mary Ultrasonic 35K</a> if you want a smoother draw, a 20mL tank and a dial that tunes flavor intensity, and you're fine with 10 flavors.
          </p>
          <p>
            It's in stock at New Vape. Unused devices in original packaging can be returned within 14 days. Adults 21 and over only.
          </p>
        </div>
      </div>

      <!-- ========================================
           TAB 2: MORE INFORMATION
           ======================================== -->
      <div class="product-tab-pane" id="tab-more-info" role="tabpanel" aria-labelledby="tabBtnMoreInfo">
        <div class="tab-specs-table-wrap">
          <table class="tab-specs-table">
            <tbody>
              <?php if (!empty($productSpecs)): ?>
                <?php foreach ($productSpecs as $specKey => $specVal): ?>
                <tr>
                  <th scope="row"><?= e($specKey) ?></th>
                  <td><?= e($specVal) ?></td>
                </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="2">No detailed specifications listed for this product.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- ========================================
           TAB 3: REVIEWS
           ======================================== -->
      <div class="product-tab-pane" id="tab-reviews" role="tabpanel" aria-labelledby="tabBtnReviews">
        <div class="tab-reviews-container">

          <!-- Reviews List -->
          <div class="reviews-list">
            <?php if (!empty($productReviews)): ?>
              <?php foreach ($productReviews as $rev): ?>
              <div class="review-item">
                <div class="review-stars-row" aria-label="<?= (int)($rev['rating'] ?? 5) ?> stars">
                  <?= str_repeat('★', (int)($rev['rating'] ?? 5)) ?>
                </div>
                <h4 class="review-item-title"><?= e($rev['title']) ?></h4>
                <p class="review-item-body"><?= e($rev['comment']) ?></p>
                <div class="review-meta"><?= e($rev['customer_name']) ?> &bull; <?= e($rev['created_at']) ?></div>
              </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p>No customer reviews yet. Be the first to write a review!</p>
            <?php endif; ?>
          </div>

          <!-- Reviews Bottom Bar (Count + Show dropdown) -->
          <div class="reviews-pagination-bar">
            <span class="reviews-count-text">3 Item(s)</span>
            <div class="reviews-show-select-wrap">
              <label for="reviewsShowSelect">Show</label>
              <select id="reviewsShowSelect" class="reviews-show-select">
                <option value="10" selected>10</option>
                <option value="20">20</option>
                <option value="50">50</option>
              </select>
            </div>
          </div>

          <!-- Write a Review Section -->
          <div class="write-review-section">
            <h3 class="write-review-heading">Write a Review</h3>

            <form class="write-review-form" id="writeReviewForm" action="javascript:void(0);">
              
              <!-- Star Rating Input -->
              <div class="form-group-rating">
                <label class="rating-input-label">Your Rating <span class="required-asterisk">*</span></label>
                <div class="interactive-star-rating" id="reviewStarRating" aria-label="Select rating">
                  <span class="star-rating-btn active" data-rating="1" title="1 star">&#9733;</span>
                  <span class="star-rating-btn active" data-rating="2" title="2 stars">&#9733;</span>
                  <span class="star-rating-btn active" data-rating="3" title="3 stars">&#9733;</span>
                  <span class="star-rating-btn active" data-rating="4" title="4 stars">&#9733;</span>
                  <span class="star-rating-btn active" data-rating="5" title="5 stars">&#9733;</span>
                </div>
                <input type="hidden" name="rating" id="selectedRating" value="5">
              </div>

              <!-- Nickname Field -->
              <div class="form-group-field">
                <label for="reviewNickname" class="field-label">Nickname <span class="required-asterisk">*</span></label>
                <input type="text" id="reviewNickname" class="review-input" placeholder="e.g. John D." required>
              </div>

              <!-- Review Title Field -->
              <div class="form-group-field">
                <label for="reviewTitle" class="field-label">Review Title <span class="required-asterisk">*</span></label>
                <input type="text" id="reviewTitle" class="review-input" placeholder="Summarize your experience" required>
              </div>

              <!-- Review Body Field -->
              <div class="form-group-field">
                <label for="reviewBody" class="field-label">Your Review <span class="required-asterisk">*</span></label>
                <textarea id="reviewBody" class="review-textarea" rows="4" placeholder="What did you like or dislike?" required></textarea>
              </div>

              <!-- Submit Button -->
              <button type="submit" class="btn-submit-review" id="btnSubmitReview">
                Submit Review
              </button>

            </form>
          </div>

        </div>
      </div>

      <!-- ========================================
           TAB 4: FAQS
           ======================================== -->
      <div class="product-tab-pane" id="tab-faqs" role="tabpanel" aria-labelledby="tabBtnFaqs">
        <div class="faqs-accordion-list">
          <?php if (!empty($productFaqs)): ?>
            <?php foreach ($productFaqs as $idx => $faq): ?>
            <div class="faq-accordion-card">
              <button type="button" class="faq-header-btn" aria-expanded="false">
                <span class="faq-question"><?= e($faq['question']) ?></span>
                <span class="faq-chevron-icon" aria-hidden="true">
                  <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2">
                    <polyline points="6 9 12 15 18 9"></polyline>
                  </svg>
                </span>
              </button>
              <div class="faq-body-collapse">
                <div class="faq-body-inner">
                  <?= e($faq['answer']) ?>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No frequently asked questions available for this product.</p>
          <?php endif; ?>
        </div>
      </div>

      <!-- ========================================
           TAB 5: RELATED POSTS
           ======================================== -->
      <div class="product-tab-pane" id="tab-related-posts" role="tabpanel" aria-labelledby="tabBtnRelatedPosts">
        <div class="tab-related-posts-content">
          <ul class="related-posts-link-list">
            <?php if (!empty($relatedPosts)): ?>
              <?php foreach ($relatedPosts as $post): ?>
              <li>
                <a href="<?= url('blog-detail') ?>?post=<?= urlencode($post['slug'] ?? '') ?>" class="related-post-link">
                  <?= e($post['title']) ?>
                </a>
              </li>
              <?php endforeach; ?>
            <?php else: ?>
              <li>No related posts available.</li>
            <?php endif; ?>
          </ul>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- ==========================================
     4. YOU MAY ALSO LIKE SECTION
     (Related Best Sellers Showcase)
     ========================================== -->
<section class="products-showcase-section you-may-also-like-section">
  <div class="container">
    
    <!-- Section Header (Left-aligned Heading, No Navigation Arrows, No View All Link) -->
    <div class="products-section-header you-may-also-like-header">
      <div class="products-header-left">
        <h2 class="products-section-title">You May Also Like</h2>
      </div>
    </div>

    <!-- Products Grid (6 Product Cards - Fixed Non-Sliding Grid) -->
    <div class="products-grid you-may-also-like-grid">
      
      <!-- Card 1: RAZ LTX 25000 -->
      <div class="product-card">
        <div class="product-card-media">
          <div class="product-badges">
            <span class="badge badge-bogo">BOGO</span>
            <span class="badge badge-hot">🔥 HOT</span>
          </div>
          <a href="<?= url('product') ?>?id=raz-ltx-25000" class="product-img-wrap">
            <img src="assets/images/vape-image.webp" alt="RAZ LTX 25000 Vape" class="product-img">
          </a>
          <div class="product-action-wrap">
            <button type="button" class="btn-add-to-cart">ADD TO CART</button>
          </div>
        </div>
        <div class="product-card-info">
          <h3 class="product-title">
            <a href="<?= url('product') ?>?id=raz-ltx-25000">RAZ LTX 25000 Vape - 25K Puffs, Dual Mesh, 50 Flavors</a>
          </h3>
          <div class="product-price-row">
            <span class="current-price">$21.99</span>
          </div>
        </div>
      </div>

      <!-- Card 2: Sea XS 15000 -->
      <div class="product-card">
        <div class="product-card-media">
          <div class="product-badges">
            <span class="badge badge-bogo">BOGO</span>
          </div>
          <a href="<?= url('product') ?>?id=sea-xs-15000" class="product-img-wrap">
            <img src="assets/images/vape-image.webp" alt="Sea XS 15000 Disposable Vape" class="product-img">
          </a>
          <div class="product-action-wrap">
            <button type="button" class="btn-add-to-cart">ADD TO CART</button>
          </div>
        </div>
        <div class="product-card-info">
          <h3 class="product-title">
            <a href="<?= url('product') ?>?id=sea-xs-15000">Sea XS 15000 Disposable Vape - World's Slimmest 15K Puff Device</a>
          </h3>
          <div class="product-price-row">
            <span class="current-price">$15.99</span>
          </div>
        </div>
      </div>

      <!-- Card 3: VIHO TRX 50K -->
      <div class="product-card">
        <div class="product-card-media">
          <div class="product-badges">
            <span class="badge badge-bogo">BOGO</span>
          </div>
          <a href="<?= url('product') ?>?id=viho-trx-50k" class="product-img-wrap">
            <img src="assets/images/vape-image.webp" alt="VIHO TRX 50K Vape" class="product-img">
          </a>
          <div class="product-action-wrap">
            <button type="button" class="btn-add-to-cart">ADD TO CART</button>
          </div>
        </div>
        <div class="product-card-info">
          <h3 class="product-title">
            <a href="<?= url('product') ?>?id=viho-trx-50k">VIHO TRX 50K Vape - Quad Mesh Coil, Boost Mode, 50,000 Puffs</a>
          </h3>
          <div class="product-price-row">
            <span class="current-price">$19.99</span>
          </div>
        </div>
      </div>

      <!-- Card 4: Foger Switch Pro -->
      <div class="product-card">
        <div class="product-card-media">
          <div class="product-badges">
            <span class="badge badge-discount">-20%</span>
          </div>
          <a href="<?= url('product') ?>?id=foger-switch-pro-refill" class="product-img-wrap">
            <img src="assets/images/vape-image.webp" alt="Foger Switch Pro Refill Pods" class="product-img">
          </a>
          <div class="product-action-wrap">
            <button type="button" class="btn-add-to-cart">ADD TO CART</button>
          </div>
        </div>
        <div class="product-card-info">
          <h3 class="product-title">
            <a href="<?= url('product') ?>?id=foger-switch-pro-refill">Foger Switch Pro Refill Pods - 30K Replacement Pod, 19mL,...</a>
          </h3>
          <div class="product-price-row">
            <span class="current-price">$13.59</span>
            <span class="old-price">$16.99</span>
          </div>
        </div>
      </div>

      <!-- Card 5: Beri Crush 50K -->
      <div class="product-card">
        <div class="product-card-media">
          <div class="product-badges">
            <span class="badge badge-bogo">BOGO</span>
          </div>
          <a href="<?= url('product') ?>?id=beri-crush-50k" class="product-img-wrap">
            <img src="assets/images/vape-image.webp" alt="Beri Crush 50K Vape" class="product-img">
          </a>
          <div class="product-action-wrap">
            <button type="button" class="btn-add-to-cart">ADD TO CART</button>
          </div>
        </div>
        <div class="product-card-info">
          <h3 class="product-title">
            <a href="<?= url('product') ?>?id=beri-crush-50k">Beri Crush 50K Vape - Quad Coil, Crush Mode, 50,000 Puffs</a>
          </h3>
          <div class="product-price-row">
            <span class="current-price">$19.99</span>
          </div>
        </div>
      </div>

      <!-- Card 6: Lost Mary MT35000 -->
      <div class="product-card">
        <div class="product-card-media">
          <div class="product-badges">
            <span class="badge badge-bogo">BOGO</span>
          </div>
          <a href="<?= url('product') ?>?id=lost-mary-mt35000" class="product-img-wrap">
            <img src="assets/images/vape-image.webp" alt="Lost Mary MT35000 Turbo Vape" class="product-img">
          </a>
          <div class="product-action-wrap">
            <button type="button" class="btn-add-to-cart">ADD TO CART</button>
          </div>
        </div>
        <div class="product-card-info">
          <h3 class="product-title">
            <a href="<?= url('product') ?>?id=lost-mary-mt35000">Lost Mary MT35000 Turbo Vape - 35,000 Puffs, 37 Flavors, Hidde...</a>
          </h3>
          <div class="product-price-row">
            <span class="current-price">$19.99</span>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>

<?php
include dirname(__DIR__) . '/includes/footer.php';
?>
