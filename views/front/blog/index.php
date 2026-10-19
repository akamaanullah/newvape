<?php

$page_title = 'New Vape Blog | Vaping Guides, Reviews & Industry News';
$page_js    = 'blog';

include dirname(__DIR__) . '/includes/header.php';
?>

<!-- ==========================================
     1. BREADCRUMBS
     ========================================== -->
<nav class="blog-breadcrumb-nav" aria-label="Breadcrumb">
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
        New Vape Blog
      </li>
    </ol>
  </div>
</nav>

<!-- ==========================================
     2. BLOG HEADER (TITLE & SUBTITLE)
     ========================================== -->
<header class="blog-header-section">
  <div class="container">
    <div class="blog-header-content">
      <h1 class="blog-main-title">New Vape Blog</h1>
      <p class="blog-main-subtitle">
        Your go-to resource for vaping guides, honest product reviews, flavor recommendations, and the latest industry news. Whether you are new to vaping or a seasoned enthusiast, we have got you covered.
      </p>
    </div>
  </div>
</header>

<!-- ==========================================
     3. MAIN BLOG LAYOUT (CONTENT + SIDEBAR)
     ========================================== -->
<section class="blog-layout-section">
  <div class="container">
    <div class="blog-layout-grid">
      
      <!-- ========================================
           LEFT COLUMN: MAIN CONTENT
           ======================================== -->
      <main class="blog-main-col">
        
        <!-- SECTION 1: LATEST VAPING GUIDES -->
        <section class="blog-guides-section">
          <div class="blog-section-header">
            <h2 class="blog-section-heading">Latest Vaping Guides</h2>
          </div>

          <div class="blog-featured-grid">
            
            <!-- Left Sub-col: Big Lead Featured Post Card -->
            <article class="featured-lead-card blog-post-item" data-category="vaping-guides industry-news" data-title="pa vape ban 2026 whats still legal after october 19">
              <a href="<?= url('blog-detail') ?>?post=pa-vape-ban-2026" class="featured-media-link">
                <img 
                  src="assets/images/blog-1.jpg" 
                  alt="PA Vape Ban 2026: What's Still Legal After October 19" 
                  class="featured-lead-img"
                  loading="eager"
                >
              </a>
              <div class="featured-lead-content">
                <h3 class="featured-lead-title">
                  <a href="<?= url('blog-detail') ?>?post=pa-vape-ban-2026">PA Vape Ban 2026: What's Still Legal After October 19</a>
                </h3>
                <div class="blog-meta-row">
                  <span class="meta-author"><a href="<?= url('blog') ?>?author=marcus-reyes">Marcus Reyes</a></span>
                  <span class="meta-separator">|</span>
                  <span class="meta-date">Oct 06, 2026</span>
                  <span class="meta-separator">|</span>
                  <span class="meta-read-time">9 min read</span>
                </div>
                <p class="featured-lead-excerpt">
                  Pennsylvania didn't ban vaping. Act 57 created a state directory, and from October 19, 2026 any nicotine vape not on it can be seized. Here's what qualifies and how to check.
                </p>
              </div>
            </article>

            <!-- Right Sub-col: 3 Stacked Horizontal Compact Cards -->
            <div class="featured-side-stack">
              
              <!-- Stack Item 1 -->
              <article class="side-post-card blog-post-item" data-category="vaping-guides hemp-cbd" data-title="what is a live resin cart how its made and how to spot one">
                <a href="<?= url('blog-detail') ?>?post=what-is-a-live-resin-cart" class="side-post-thumb-link">
                  <img 
                    src="assets/images/blog-2.jpg" 
                    alt="What Is a Live Resin Cart? How It's Made and How to Spot One" 
                    class="side-post-thumb-img">
                </a>
                <div class="side-post-content">
                  <h4 class="side-post-title">
                    <a href="<?= url('blog-detail') ?>?post=what-is-a-live-resin-cart">What Is a Live Resin Cart? How It's Made and How to Spot One</a>
                  </h4>
                  <div class="blog-meta-row">
                    <span class="meta-author"><a href="<?= url('blog') ?>?author=marcus-reyes">Marcus Reyes</a></span>
                    <span class="meta-separator">|</span>
                    <span class="meta-date">Oct 02, 2026</span>
                    <span class="meta-separator">|</span>
                    <span class="meta-read-time">9 min read</span>
                  </div>
                </div>
              </article>

              <!-- Stack Item 2 -->
              <article class="side-post-card blog-post-item" data-category="brand-spotlights vaping-guides" data-title="where to buy a foger vape and what to check first">
                <a href="<?= url('blog-detail') ?>?post=where-to-buy-a-foger-vape" class="side-post-thumb-link">
                  <img 
                    src="assets/images/blog-3.jpg" 
                    alt="Where to Buy a Foger Vape (And What to Check First)" 
                    class="side-post-thumb-img"
                  >
                </a>
                <div class="side-post-content">
                  <h4 class="side-post-title">
                    <a href="<?= url('blog-detail') ?>?post=where-to-buy-a-foger-vape">Where to Buy a Foger Vape (And What to Check First)</a>
                  </h4>
                  <div class="blog-meta-row">
                    <span class="meta-author"><a href="<?= url('blog') ?>?author=marcus-reyes">Marcus Reyes</a></span>
                    <span class="meta-separator">|</span>
                    <span class="meta-date">Oct 01, 2026</span>
                    <span class="meta-separator">|</span>
                    <span class="meta-read-time">6 min read</span>
                  </div>
                </div>
              </article>

              <!-- Stack Item 3 -->
              <article class="side-post-card blog-post-item" data-category="vaping-guides product-reviews" data-title="can you refill a foger vape what to do instead">
                <a href="<?= url('blog-detail') ?>?post=can-you-refill-a-foger-vape" class="side-post-thumb-link">
                  <img 
                    src="assets/images/blog-4.jpg" 
                    alt="Can You Refill a Foger Vape? What to Do Instead" 
                    class="side-post-thumb-img"
                  >
                </a>
                <div class="side-post-content">
                  <h4 class="side-post-title">
                    <a href="<?= url('blog-detail') ?>?post=can-you-refill-a-foger-vape">Can You Refill a Foger Vape? What to Do Instead</a>
                  </h4>
                  <div class="blog-meta-row">
                    <span class="meta-author"><a href="<?= url('blog') ?>?author=marcus-reyes">Marcus Reyes</a></span>
                    <span class="meta-separator">|</span>
                    <span class="meta-date">Sep 28, 2026</span>
                    <span class="meta-separator">|</span>
                    <span class="meta-read-time">7 min read</span>
                  </div>
                </div>
              </article>

            </div>

          </div>
        </section>

        <!-- SECTION 2: TOP PRODUCT REVIEWS -->
        <section class="blog-top-reviews-section">
          <div class="blog-section-header">
            <h2 class="blog-section-heading">Top Product Reviews</h2>
          </div>

          <div class="top-reviews-grid">
            
            <!-- Review Card 1: Best Live Resin Carts -->
            <article class="top-review-card blog-post-item" data-category="hemp-cbd product-reviews" data-title="best live resin carts and disposables we stock 2026">
              <a href="<?= url('blog-detail') ?>?post=best-live-resin-carts" class="top-review-card-link" aria-label="Best Live Resin Carts and Disposables We Stock (2026)">
                <img 
                  src="assets/images/blog-2.jpg" 
                  alt="Best Live Resin Carts and Disposables We Stock (2026)" 
                  class="top-review-bg-img"
                  loading="lazy"
                >
                <div class="top-review-overlay"></div>
                <div class="top-review-content">
                  <h3 class="top-review-title">Best Live Resin Carts and Disposables We Stock (2026)</h3>
                  <div class="top-review-meta">
                    <span class="meta-author">Marcus Reyes</span>
                    <span class="meta-separator">|</span>
                    <span class="meta-date">Oct 05, 2026</span>
                    <span class="meta-separator">|</span>
                    <span class="meta-read-time">8 min read</span>
                  </div>
                  <div class="top-review-badges">
                    <span class="review-tag-badge">Hemp &amp; CBD</span>
                    <span class="review-tag-badge">Product Reviews</span>
                  </div>
                </div>
              </a>
            </article>

            <!-- Review Card 2: Foger Vape Guide -->
            <article class="top-review-card blog-post-item" data-category="product-reviews vaping-guides" data-title="foger vape guide every device flavor and feature explained">
              <a href="<?= url('blog-detail') ?>?post=foger-vape-guide" class="top-review-card-link" aria-label="Foger Vape Guide: Every Device, Flavor and Feature Explained">
                <img 
                  src="assets/images/foger-switch-pro-new-pod-flavors-d-banner.webp" 
                  alt="Foger Vape Guide: Every Device, Flavor and Feature Explained" 
                  class="top-review-bg-img"
                  loading="lazy"
                >
                <div class="top-review-overlay"></div>
                <div class="top-review-content">
                  <h3 class="top-review-title">Foger Vape Guide: Every Device, Flavor and Feature Explained</h3>
                  <div class="top-review-meta">
                    <span class="meta-author">Marcus Reyes</span>
                    <span class="meta-separator">|</span>
                    <span class="meta-date">Sep 25, 2026</span>
                    <span class="meta-separator">|</span>
                    <span class="meta-read-time">10 min read</span>
                  </div>
                  <div class="top-review-badges">
                    <span class="review-tag-badge">Product Reviews</span>
                    <span class="review-tag-badge">Vaping Guides</span>
                  </div>
                </div>
              </a>
            </article>

            <!-- Review Card 3: Purse Vape -->
            <article class="top-review-card blog-post-item" data-category="product-reviews vaping-guides" data-title="what is a purse vape the chain strap trend explained">
              <a href="<?= url('blog-detail') ?>?post=what-is-a-purse-vape" class="top-review-card-link" aria-label="What Is a Purse Vape? The Chain-Strap Trend Explained">
                <img 
                  src="assets/images/vape-image.webp" 
                  alt="What Is a Purse Vape? The Chain-Strap Trend Explained" 
                  class="top-review-bg-img"
                  loading="lazy"
                >
                <div class="top-review-overlay"></div>
                <div class="top-review-content">
                  <h3 class="top-review-title">What Is a Purse Vape? The Chain-Strap Trend Explained</h3>
                  <div class="top-review-meta">
                    <span class="meta-author">Marcus Reyes</span>
                    <span class="meta-separator">|</span>
                    <span class="meta-date">Sep 11, 2026</span>
                    <span class="meta-separator">|</span>
                    <span class="meta-read-time">7 min read</span>
                  </div>
                  <div class="top-review-badges">
                    <span class="review-tag-badge">Product Reviews</span>
                    <span class="review-tag-badge">Vaping Guides</span>
                  </div>
                </div>
              </a>
            </article>

          </div>
        </section>

        <!-- SECTION 3: EXPLORE FLAVOR PROFILES -->
        <section class="blog-flavor-profiles-section">
          <div class="blog-section-header">
            <h2 class="blog-section-heading">Explore Flavor Profiles</h2>
          </div>

          <article class="flavor-lead-card blog-post-item" data-category="flavor-profiles vaping-guides" data-title="best foger vape flavors 2026 top picks ranked">
            <a href="<?= url('blog-detail') ?>?post=best-foger-vape-flavors" class="flavor-lead-media-link" aria-label="Best Foger Vape Flavors 2026: Top Picks Ranked">
              <img 
                src="assets/images/blog-4.jpg" 
                alt="Best Foger Vape Flavors 2026: Top Picks Ranked" 
                class="flavor-lead-img"
                loading="lazy"
              >
            </a>
            <div class="flavor-lead-content">
              <h3 class="flavor-lead-title">
                <a href="<?= url('blog-detail') ?>?post=best-foger-vape-flavors">Best Foger Vape Flavors 2026: Top Picks Ranked</a>
              </h3>
              <div class="blog-meta-row">
                <span class="meta-author"><a href="<?= url('blog') ?>?author=marcus-reyes">Marcus Reyes</a></span>
                <span class="meta-separator">|</span>
                <span class="meta-date">Sep 23, 2026</span>
                <span class="meta-separator">|</span>
                <span class="meta-read-time">16 min read</span>
              </div>
              <p class="flavor-lead-excerpt">
                We ranked the best Foger vape flavors across the Bit 35K and Switch Pro 30K. Real customer reviews, taste profiles, exclusive picks, and a quick-pick guide to find your next all-day flavor.
              </p>
              <div class="flavor-lead-badges">
                <a href="<?= url('blog') ?>?cat=flavor-profiles" class="flavor-tag-badge">Flavor Profiles</a>
                <a href="<?= url('blog') ?>?cat=vaping-guides" class="flavor-tag-badge">Vaping Guides</a>
              </div>
            </div>
          </article>
        </section>

        <!-- SECTION 4: NICOTINE POUCHES & HEMP GUIDES (2-COLUMN GRID, 4 CARDS, NO CARD BORDER) -->
        <section class="blog-articles-grid-section">
          <div class="blog-section-header">
            <h2 class="blog-section-heading">Nicotine Pouches &amp; Hemp Guides</h2>
          </div>

          <!-- Active Filter Pill Bar (Hidden initially, visible when search or category is active) -->
          <div class="active-filter-bar" id="activeFilterBar" style="display: none;">
            <span class="filter-status-label">Filtered by: <strong id="currentFilterLabel">All</strong></span>
            <button type="button" class="btn-clear-filter" id="btnClearFilter">Clear filter &times;</button>
          </div>

          <div class="blog-articles-grid" id="blogArticlesGrid">
            
            <!-- Card 1: Delta 8, THCA & THC Vapes in Texas -->
            <article class="blog-article-card blog-post-item" data-category="industry-news hemp-cbd" data-title="delta 8 thca thc vapes in texas legal status in 2026">
              <a href="<?= url('blog-detail') ?>?post=delta-8-texas-law" class="article-card-thumb-link">
                <img src="assets/images/twin-banner.webp" alt="Delta 8, THCA & THC Vapes in Texas: Legal Status in 2026" class="article-card-img" loading="lazy">
              </a>
              <div class="article-card-body">
                <h3 class="article-card-title">
                  <a href="<?= url('blog-detail') ?>?post=delta-8-texas-law">Delta 8, THCA &amp; THC Vapes in Texas: Legal Status in 2026</a>
                </h3>
                <div class="blog-meta-row">
                  <span class="meta-author"><a href="<?= url('blog') ?>?author=marcus-reyes">Marcus Reyes</a></span>
                  <span class="meta-separator">|</span>
                  <span class="meta-date">Aug 31, 2026</span>
                  <span class="meta-separator">|</span>
                  <span class="meta-read-time">9 min read</span>
                </div>
                <p class="article-card-excerpt">
                  Is Delta 8 legal in Texas in 2026? The honest answer is that it's unsettled. Hemp-derived cannabinoids have been sold under the Farm Bill, but SB 2024 now restricts cannabinoid vapes and lawmakers keep
                </p>
                <div class="article-badges-row">
                  <a href="<?= url('blog') ?>?cat=industry-news" class="flavor-tag-badge">Industry News</a>
                  <a href="<?= url('blog') ?>?cat=hemp-cbd" class="flavor-tag-badge">Hemp &amp; CBD</a>
                </div>
              </div>
            </article>

            <!-- Card 2: Best Jelly Gummies 2026 -->
            <article class="blog-article-card blog-post-item" data-category="comparisons hemp-cbd" data-title="best jelly gummies 2026 focus rise snooze delta 9 and cbd compared">
              <a href="<?= url('blog-detail') ?>?post=best-jelly-gummies-2026" class="article-card-thumb-link">
                <img src="assets/images/blog-4.jpg" alt="Best Jelly Gummies 2026: Focus, Rise, Snooze, Delta 9 and CBD Compared" class="article-card-img" loading="lazy">
              </a>
              <div class="article-card-body">
                <h3 class="article-card-title">
                  <a href="<?= url('blog-detail') ?>?post=best-jelly-gummies-2026">Best Jelly Gummies 2026: Focus, Rise, Snooze, Delta 9 and CBD Compared</a>
                </h3>
                <div class="blog-meta-row">
                  <span class="meta-author"><a href="<?= url('blog') ?>?author=marcus-reyes">Marcus Reyes</a></span>
                  <span class="meta-separator">|</span>
                  <span class="meta-date">Aug 28, 2026</span>
                  <span class="meta-separator">|</span>
                  <span class="meta-read-time">9 min read</span>
                </div>
                <p class="article-card-excerpt">
                  The best Jelly gummy depends on the effect you want and how much THC you're after. We compare all six Jelly gummies, from THC-free CBD to the 10mg Delta 9, so you can pick the right one in a minute.
                </p>
                <div class="article-badges-row">
                  <a href="<?= url('blog') ?>?cat=comparisons" class="flavor-tag-badge">Comparisons</a>
                  <a href="<?= url('blog') ?>?cat=hemp-cbd" class="flavor-tag-badge">Hemp &amp; CBD</a>
                </div>
              </div>
            </article>

            <!-- Card 3: Nicotine Pouches 101 -->
            <article class="blog-article-card blog-post-item" data-category="nicotine-pouches vaping-guides" data-title="nicotine pouches 101 how to choose strength flavor and brand">
              <a href="<?= url('blog-detail') ?>?post=nicotine-pouches-101" class="article-card-thumb-link">
                <img src="assets/images/nicotine-pouches.webp" alt="Nicotine Pouches 101: How to Choose Strength, Flavor &amp; Brand" class="article-card-img" loading="lazy">
              </a>
              <div class="article-card-body">
                <h3 class="article-card-title">
                  <a href="<?= url('blog-detail') ?>?post=nicotine-pouches-101">Nicotine Pouches 101: How to Choose Strength, Flavor &amp; Brand</a>
                </h3>
                <div class="blog-meta-row">
                  <span class="meta-author"><a href="<?= url('blog') ?>?author=marcus-reyes">Marcus Reyes</a></span>
                  <span class="meta-separator">|</span>
                  <span class="meta-date">Aug 20, 2026</span>
                  <span class="meta-separator">|</span>
                  <span class="meta-read-time">8 min read</span>
                </div>
                <p class="article-card-excerpt">
                  Switching to tobacco-free nicotine pouches? Learn about milligram ratings (3mg to 9mg), dry vs moist pouches, and flavor recommendations from ZYN to Lucy.
                </p>
                <div class="article-badges-row">
                  <a href="<?= url('blog') ?>?cat=nicotine-pouches" class="flavor-tag-badge">Nicotine Pouches</a>
                  <a href="<?= url('blog') ?>?cat=vaping-guides" class="flavor-tag-badge">Vaping Guides</a>
                </div>
              </div>
            </article>

            <!-- Card 4: ZYN vs Lucy vs VELO -->
            <article class="blog-article-card blog-post-item" data-category="comparisons nicotine-pouches" data-title="zyn vs lucy vs velo comprehensive 2026 pouch face off">
              <a href="<?= url('blog-detail') ?>?post=zyn-vs-lucy-vs-velo" class="article-card-thumb-link">
                <img src="assets/images/blog-2.jpg" alt="ZYN vs Lucy vs VELO: Comprehensive 2026 Pouch Face-Off" class="article-card-img" loading="lazy">
              </a>
              <div class="article-card-body">
                <h3 class="article-card-title">
                  <a href="<?= url('blog-detail') ?>?post=zyn-vs-lucy-vs-velo">ZYN vs Lucy vs VELO: Comprehensive 2026 Pouch Face-Off</a>
                </h3>
                <div class="blog-meta-row">
                  <span class="meta-author"><a href="<?= url('blog') ?>?author=marcus-reyes">Marcus Reyes</a></span>
                  <span class="meta-separator">|</span>
                  <span class="meta-date">Aug 14, 2026</span>
                  <span class="meta-separator">|</span>
                  <span class="meta-read-time">7 min read</span>
                </div>
                <p class="article-card-excerpt">
                  We breakdown the top three nicotine pouch brands across pouch moisture, nicotine release speed, flavor longevity, and mouthfeel comfort.
                </p>
                <div class="article-badges-row">
                  <a href="<?= url('blog') ?>?cat=comparisons" class="flavor-tag-badge">Comparisons</a>
                  <a href="<?= url('blog') ?>?cat=nicotine-pouches" class="flavor-tag-badge">Nicotine Pouches</a>
                </div>
              </div>
            </article>

          </div>
        </section>

        <!-- SECTION 5: LATEST POSTS (3-COLUMN COMPACT GRID, 6 CARDS) -->
        <section class="blog-latest-posts-section">
          <div class="blog-section-header">
            <h2 class="blog-section-heading">Latest Posts</h2>
          </div>

          <div class="latest-posts-grid">
            
            <!-- Latest Post 1 -->
            <article class="latest-post-card blog-post-item" data-category="vaping-guides" data-title="how to charge a juul dock charge time and indicators">
              <a href="<?= url('blog-detail') ?>?post=how-to-charge-juul" class="latest-post-thumb-link">
                <img src="assets/images/blog-3.jpg" alt="How to Charge a JUUL: Dock, Charge Time and..." class="latest-post-thumb-img" loading="lazy">
              </a>
              <div class="latest-post-content">
                <h3 class="latest-post-title">
                  <a href="<?= url('blog-detail') ?>?post=how-to-charge-juul">How to Charge a JUUL: Dock, Charge Time and...</a>
                </h3>
                <div class="latest-post-meta">
                  <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                  <span class="meta-date-read">| Sep 24, 2026 | 9 min read</span>
                </div>
              </div>
            </article>

            <!-- Latest Post 2 -->
            <article class="latest-post-card blog-post-item" data-category="vaping-guides" data-title="how to charge a foger vape charger time and battery tips">
              <a href="<?= url('blog-detail') ?>?post=how-to-charge-foger-vape" class="latest-post-thumb-link">
                <img src="assets/images/foger-switch-pro-new-pod-flavors-d-banner.webp" alt="How to Charge a Foger Vape: Charger, Time and..." class="latest-post-thumb-img" loading="lazy">
              </a>
              <div class="latest-post-content">
                <h3 class="latest-post-title">
                  <a href="<?= url('blog-detail') ?>?post=how-to-charge-foger-vape">How to Charge a Foger Vape: Charger, Time and...</a>
                </h3>
                <div class="latest-post-meta">
                  <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                  <span class="meta-date-read">| Sep 22, 2026 | 6 min read</span>
                </div>
              </div>
            </article>

            <!-- Latest Post 3 -->
            <article class="latest-post-card blog-post-item" data-category="vaping-guides" data-title="where is the juul serial number how to find and verify">
              <a href="<?= url('blog-detail') ?>?post=where-is-juul-serial-number" class="latest-post-thumb-link">
                <img src="assets/images/img-2.png" alt="Where Is the JUUL Serial Number? How to Find..." class="latest-post-thumb-img" loading="lazy">
              </a>
              <div class="latest-post-content">
                <h3 class="latest-post-title">
                  <a href="<?= url('blog-detail') ?>?post=where-is-juul-serial-number">Where Is the JUUL Serial Number? How to Find...</a>
                </h3>
                <div class="latest-post-meta">
                  <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                  <span class="meta-date-read">| Sep 21, 2026 | 8 min read</span>
                </div>
              </div>
            </article>

            <!-- Latest Post 4 -->
            <article class="latest-post-card blog-post-item" data-category="vaping-guides" data-title="how long do juulpods last puffs nicotine and pod life">
              <a href="<?= url('blog-detail') ?>?post=how-long-do-juulpods-last" class="latest-post-thumb-link">
                <img src="assets/images/blog-1.jpg" alt="How Long Do JUULpods Last? Puffs, Nicotine an..." class="latest-post-thumb-img" loading="lazy">
              </a>
              <div class="latest-post-content">
                <h3 class="latest-post-title">
                  <a href="<?= url('blog-detail') ?>?post=how-long-do-juulpods-last">How Long Do JUULpods Last? Puffs, Nicotine an...</a>
                </h3>
                <div class="latest-post-meta">
                  <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                  <span class="meta-date-read">| Sep 18, 2026 | 9 min read</span>
                </div>
              </div>
            </article>

            <!-- Latest Post 5 -->
            <article class="latest-post-card blog-post-item" data-category="industry-news" data-title="is juul still sold in 2026 fda status explained">
              <a href="<?= url('blog-detail') ?>?post=is-juul-still-sold-in-2026" class="latest-post-thumb-link">
                <img src="assets/images/twin-banner.webp" alt="Is JUUL Still Sold in 2026? FDA Status Explained" class="latest-post-thumb-img" loading="lazy">
              </a>
              <div class="latest-post-content">
                <h3 class="latest-post-title">
                  <a href="<?= url('blog-detail') ?>?post=is-juul-still-sold-in-2026">Is JUUL Still Sold in 2026? FDA Status Explained</a>
                </h3>
                <div class="latest-post-meta">
                  <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                  <span class="meta-date-read">| Sep 17, 2026 | 8 min read</span>
                </div>
              </div>
            </article>

            <!-- Latest Post 6 -->
            <article class="latest-post-card blog-post-item" data-category="vaping-guides" data-title="juul vape guide device pods colors and 2026 updates">
              <a href="<?= url('blog-detail') ?>?post=juul-vape-guide-2026" class="latest-post-thumb-link">
                <img src="assets/images/all-shop.webp" alt="JUUL Vape Guide: Device, Pods, Colors and 2026..." class="latest-post-thumb-img" loading="lazy">
              </a>
              <div class="latest-post-content">
                <h3 class="latest-post-title">
                  <a href="<?= url('blog-detail') ?>?post=juul-vape-guide-2026">JUUL Vape Guide: Device, Pods, Colors and 2026...</a>
                </h3>
                <div class="latest-post-meta">
                  <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                  <span class="meta-date-read">| Sep 16, 2026 | 10 min read</span>
                </div>
              </div>
            </article>

          </div>
        </section>

      </main>

      <!-- ========================================
           RIGHT COLUMN: SIDEBAR (SEARCH, CATEGORIES, RECENT POSTS)
           ======================================== -->
      <aside class="blog-sidebar-col" aria-label="Blog Sidebar">
        
        <!-- WIDGET 1: SEARCH BAR -->
        <div class="blog-widget blog-search-widget">
          <form class="blog-search-form" id="blogSearchForm" action="javascript:void(0);">
            <div class="search-input-wrapper">
              <input 
                type="text" 
                id="blogSearchInput" 
                class="blog-search-input" 
                placeholder="Search posts here..." 
                autocomplete="off"
                aria-label="Search posts"
              >
              <button type="submit" class="blog-search-btn" aria-label="Search posts">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="11" cy="11" r="8"></circle>
                  <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
              </button>
            </div>
          </form>
        </div>

        <!-- WIDGET 2: CATEGORIES CARD -->
        <div class="blog-widget blog-card-widget blog-categories-widget">
          <h3 class="blog-widget-title">Categories</h3>
          <ul class="blog-categories-list" id="blogCategoriesList">
            <li class="category-list-item active" data-cat="all">
              <a href="javascript:void(0);" class="category-link">
                <span class="category-name">All Articles</span>
                <span class="category-count">(94)</span>
              </a>
            </li>
            <li class="category-list-item" data-cat="comparisons">
              <a href="javascript:void(0);" class="category-link">
                <span class="category-name">Comparisons</span>
                <span class="category-count">(14)</span>
              </a>
            </li>
            <li class="category-list-item" data-cat="brand-spotlights">
              <a href="javascript:void(0);" class="category-link">
                <span class="category-name">Brand Spotlights</span>
                <span class="category-count">(18)</span>
              </a>
            </li>
            <li class="category-list-item" data-cat="deals-savings">
              <a href="javascript:void(0);" class="category-link">
                <span class="category-name">Deals &amp; Savings</span>
                <span class="category-count">(3)</span>
              </a>
            </li>
            <li class="category-list-item" data-cat="industry-news">
              <a href="javascript:void(0);" class="category-link">
                <span class="category-name">Industry News</span>
                <span class="category-count">(26)</span>
              </a>
            </li>
            <li class="category-list-item" data-cat="hemp-cbd">
              <a href="javascript:void(0);" class="category-link">
                <span class="category-name">Hemp &amp; CBD</span>
                <span class="category-count">(18)</span>
              </a>
            </li>
            <li class="category-list-item" data-cat="nicotine-pouches">
              <a href="javascript:void(0);" class="category-link">
                <span class="category-name">Nicotine Pouches</span>
                <span class="category-count">(11)</span>
              </a>
            </li>
            <li class="category-list-item" data-cat="flavor-profiles">
              <a href="javascript:void(0);" class="category-link">
                <span class="category-name">Flavor Profiles</span>
                <span class="category-count">(11)</span>
              </a>
            </li>
            <li class="category-list-item" data-cat="product-reviews">
              <a href="javascript:void(0);" class="category-link">
                <span class="category-name">Product Reviews</span>
                <span class="category-count">(30)</span>
              </a>
            </li>
            <li class="category-list-item" data-cat="vaping-guides">
              <a href="javascript:void(0);" class="category-link">
                <span class="category-name">Vaping Guides</span>
                <span class="category-count">(76)</span>
              </a>
            </li>
          </ul>
        </div>

        <!-- WIDGET 3: RECENT POSTS CARD -->
        <div class="blog-widget blog-card-widget blog-recent-posts-widget">
          <h3 class="blog-widget-title">Recent Posts</h3>
          <ul class="recent-posts-list">
            
            <!-- Recent Item 1 -->
            <li class="recent-post-item">
              <a href="<?= url('blog-detail') ?>?post=pa-vape-ban-2026" class="recent-post-thumb-link" aria-label="PA Vape Ban 2026">
                <img src="assets/images/blog-1.jpg" alt="PA Vape Ban 2026: What's Still Legal After October 19" class="recent-post-thumb-img" loading="lazy">
              </a>
              <div class="recent-post-info">
                <h4 class="recent-post-title">
                  <a href="<?= url('blog-detail') ?>?post=pa-vape-ban-2026">PA Vape Ban 2026: What's Still Legal After October 19</a>
                </h4>
                <span class="recent-post-date">Oct 06, 2026</span>
              </div>
            </li>

            <!-- Recent Item 2 -->
            <li class="recent-post-item">
              <a href="<?= url('blog-detail') ?>?post=best-live-resin-carts" class="recent-post-thumb-link" aria-label="Best Live Resin Carts">
                <img src="assets/images/blog-2.jpg" alt="Best Live Resin Carts and Disposables We Stock..." class="recent-post-thumb-img" loading="lazy">
              </a>
              <div class="recent-post-info">
                <h4 class="recent-post-title">
                  <a href="<?= url('blog-detail') ?>?post=best-live-resin-carts">Best Live Resin Carts and Disposables We Stock...</a>
                </h4>
                <span class="recent-post-date">Oct 05, 2026</span>
              </div>
            </li>

          </ul>
        </div>

        <!-- WIDGET 4: FEATURED POSTS CARD -->
        <div class="blog-widget blog-card-widget blog-featured-post-widget">
          <h3 class="blog-widget-title">Featured Posts</h3>
          <div class="featured-post-item">
            <h4 class="featured-post-title">
              <a href="<?= url('blog-detail') ?>?post=geek-bar-ban-explained-2026">Geek Bar Ban Explained: Is Geek Bar Really Banned in 2026?</a>
            </h4>
            <span class="featured-post-date">Mar 26, 2026</span>
          </div>
        </div>

        <!-- WIDGET 5: POPULAR POSTS CARD -->
        <div class="blog-widget blog-card-widget blog-popular-posts-widget">
          <h3 class="blog-widget-title">Popular Posts</h3>
          <ul class="popular-posts-list">
            
            <!-- Popular Item 1: Chillax Psylo 35K -->
            <li class="popular-post-item">
              <a href="<?= url('blog-detail') ?>?post=chillax-psylo-35k-review" class="popular-post-thumb-link" aria-label="Chillax Psylo 35K Review">
                <img src="assets/images/blog-3.jpg" alt="Chillax Psylo 35K Review" class="popular-post-thumb-img" loading="lazy">
              </a>
              <div class="popular-post-info">
                <h4 class="popular-post-title">
                  <a href="<?= url('blog-detail') ?>?post=chillax-psylo-35k-review">Chillax Psylo 35K Review: Lock System, Smart Chip,...</a>
                </h4>
                <span class="popular-post-date">Apr 07, 2026</span>
              </div>
            </li>

            <!-- Popular Item 2: Lost Mary MT35000 Pixy Edition -->
            <li class="popular-post-item">
              <a href="<?= url('blog-detail') ?>?post=lost-mary-mt35000-pixy-edition" class="popular-post-thumb-link" aria-label="Lost Mary MT35000 Pixy Edition">
                <img src="assets/images/blog-4.jpg" alt="Lost Mary MT35000 Pixy Edition" class="popular-post-thumb-img" loading="lazy">
              </a>
              <div class="popular-post-info">
                <h4 class="popular-post-title">
                  <a href="<?= url('blog-detail') ?>?post=lost-mary-mt35000-pixy-edition">Lost Mary MT35000 Pixy Edition: 5 Candy Flavors...</a>
                </h4>
                <span class="popular-post-date">May 19, 2026</span>
              </div>
            </li>

            <!-- Popular Item 3: Lost Mary Vapes -->
            <li class="popular-post-item">
              <a href="<?= url('blog-detail') ?>?post=lost-mary-vapes-5-devices" class="popular-post-thumb-link" aria-label="Lost Mary Vapes: 5 Devices from 20K to 70K Puffs">
                <img src="assets/images/img-1.png" alt="Lost Mary Vapes: 5 Devices from 20K to 70K Puffs" class="popular-post-thumb-img" loading="lazy">
              </a>
              <div class="popular-post-info">
                <h4 class="popular-post-title">
                  <a href="<?= url('blog-detail') ?>?post=lost-mary-vapes-5-devices">Lost Mary Vapes: 5 Devices from 20K to 70K Puffs</a>
                </h4>
                <span class="popular-post-date">Mar 19, 2026</span>
              </div>
            </li>

          </ul>
        </div>

        <!-- WIDGET 6: ARCHIVE CARD -->
        <div class="blog-widget blog-card-widget blog-archive-widget">
          <h3 class="blog-widget-title">Archive</h3>
          <ul class="archive-list">
            <li class="archive-item"><a href="<?= url('blog') ?>?archive=2026-10" class="archive-link">October 2026</a></li>
            <li class="archive-item"><a href="<?= url('blog') ?>?archive=2026-09" class="archive-link">September 2026</a></li>
            <li class="archive-item"><a href="<?= url('blog') ?>?archive=2026-08" class="archive-link">August 2026</a></li>
            <li class="archive-item"><a href="<?= url('blog') ?>?archive=2026-07" class="archive-link">July 2026</a></li>
            <li class="archive-item"><a href="<?= url('blog') ?>?archive=2026-06" class="archive-link">June 2026</a></li>
            <li class="archive-item"><a href="<?= url('blog') ?>?archive=2026-05" class="archive-link">May 2026</a></li>
            <li class="archive-item"><a href="<?= url('blog') ?>?archive=2026-04" class="archive-link">April 2026</a></li>
            <li class="archive-item"><a href="<?= url('blog') ?>?archive=2026-03" class="archive-link">March 2026</a></li>
          </ul>
        </div>

        <!-- WIDGET 7: TAGS CARD -->
        <div class="blog-widget blog-card-widget blog-tags-widget">
          <h3 class="blog-widget-title">Tags</h3>
          <div class="blog-tags-cloud">
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="best-of">Best Of</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="beginner-guide">Beginner Guide</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="puff-count">Puff Count</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="regulations">Regulations</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="fda-updates">FDA Updates</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="salt-nic">Salt Nic</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="new-releases">New Releases</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="disposable-vapes">Disposable Vapes</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="nicotine-strengths">Nicotine Strengths</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="hemp-thc">Hemp &amp; THC</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="how-to">How To</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="cannabinoids">Cannabinoids</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="flavor-bans">Flavor Bans</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="mint-flavors">Mint Flavors</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="health-safety">Health &amp; Safety</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="candy-flavors">Candy Flavors</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="buying-guide">Buying Guide</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="vape-comparisons">Vape Comparisons</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="switching-from-smoking">Switching from Smoking</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="foger">Foger</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="live-resin">Live Resin</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="high-puff-vapes">High Puff Vapes</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="nicotine-pouches">Nicotine Pouches</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="vape-maintenance">Vape Maintenance</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="budget-picks">Budget Picks</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="delta-8">Delta-8</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="cookies">Cookies</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="vape-laws">Vape Laws</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="pmta">PMTA</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="flavor-review">Flavor Review</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="thc-vape">THC Vape</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="delta-9">Delta-9</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="battery-safety">Battery Safety</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="off-stamp">Off Stamp</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="thca">THCA</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="cbd-products">CBD Products</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="pod-systems">Pod Systems</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="beverage-flavors">Beverage Flavors</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="lost-mary">Lost Mary</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="farm-bill">Farm Bill</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="new-release">New Release</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill" data-tag="compact-vapes">Compact Vapes</a>
          </div>
        </div>

      </aside>

    </div>
  </div>
</section>

<?php
include dirname(__DIR__) . '/includes/footer.php';
?>
