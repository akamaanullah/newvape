<?php


$page_title = 'HQD Cuvie Plus 2.0: Flavors, Specs & How to Use | New Vape Blog';
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
      <li class="breadcrumb-item">
        <a href="<?= url('blog') ?>">New Vape Blog</a>
      </li>
      <li class="breadcrumb-separator" aria-hidden="true">
        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
      </li>
      <li class="breadcrumb-item">
        <a href="<?= url('blog') ?>?cat=product-reviews">Product Reviews</a>
      </li>
      <li class="breadcrumb-separator" aria-hidden="true">
        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        HQD Cuvie Plus 2.0: Flavors, Specs &amp; How to Use
      </li>
    </ol>
  </div>
</nav>

<!-- ==========================================
     2. BLOG DETAIL MAIN LAYOUT (ARTICLE + SIDEBAR)
     ========================================== -->
<section class="blog-detail-section">
  <div class="container">
    <div class="blog-layout-grid">
      
      <!-- ========================================
           LEFT COLUMN: FULL BLOG ARTICLE
           ======================================== -->
      <article class="blog-detail-article">
        
        <!-- Post Header -->
        <header class="blog-article-header">
          <h1 class="blog-article-title">HQD Cuvie Plus 2.0: Flavors, Specs &amp; How to Use</h1>
          
          <!-- Category Badges -->
          <div class="blog-article-categories">
            <a href="<?= url('blog') ?>?cat=product-reviews" class="detail-cat-badge">Product Reviews</a>
            <a href="<?= url('blog') ?>?cat=vaping-guides" class="detail-cat-badge">Vaping Guides</a>
          </div>

          <!-- Meta Author & Date Row -->
          <div class="blog-article-meta">
            <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
            <span class="meta-separator">|</span>
            <span class="meta-date">Sep 04, 2026</span>
            <span class="meta-separator">|</span>
            <span class="meta-read-time">7 min read</span>
          </div>
        </header>

        <!-- Featured Hero Image (HQD Cuvie Plus 2.0 Devices on Ice) -->
        <div class="blog-article-featured-media">
          <img 
            src="assets/images/hqd-cuvie-plus-banner.jpg" 
            alt="HQD Cuvie Plus 2.0: Flavors, Specs &amp; How to Use" 
            class="blog-article-hero-img"
            loading="eager"
          >
        </div>

        <!-- Tags Row Under Featured Image -->
        <div class="blog-article-tags-bar">
          <span class="tags-label">Tags:</span>
          <div class="tags-pills-wrap">
            <a href="<?= url('tag') ?>" class="blog-tag-pill">Puff Count</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill">New Releases</a>
            <a href="<?= url('tag') ?>" class="blog-tag-pill">How To</a>
          </div>
        </div>

        <!-- Article Prose Content -->
        <div class="blog-article-prose">
          
          <p>
            The HQD Cuvie Plus 2.0 is a 9,000-puff rechargeable disposable vape. It carries an 18mL prefilled tank, a dual mesh coil, and an LCD screen that shows your battery and juice levels. It comes in 5% (50mg) salt nicotine, plus a 0% zero-nicotine version for anyone who wants the flavor without the nicotine. One thing trips people up: the "2.0" is the device version, not a nicotine strength. It's not a 2% vape. The standard model is 50mg. HQD built this device for vapers who want a big tank, steady flavor, and fewer trips to the store. Below you'll find the full spec sheet, the flavor lineup, how to charge it, and who it fits best. You must be 21 or older to buy any vape product.
          </p>

          <!-- Key Takeaways Callout Card -->
          <div class="article-callout-box">
            <h3 class="callout-title">Key Takeaways</h3>
            <ul class="callout-list">
              <li>The HQD Cuvie Plus 2.0 delivers 9,000+ puffs from an 18mL prefilled tank.</li>
              <li>It uses a dual mesh coil and an LCD screen for battery and e-liquid levels.</li>
              <li>The device is USB-C rechargeable with a 600mAh battery.</li>
              <li>Nicotine is 5% (50mg) salt nic, with a separate 0% zero-nic version. The "2.0" is the device version, not 2%.</li>
              <li>It comes in 22 flavors at 5% and 5 flavors at 0%.</li>
            </ul>
          </div>

          <!-- Section 1 -->
          <h2>What Is the HQD Cuvie Plus 2.0?</h2>
          <p>
            The HQD Cuvie Plus 2.0 is a prefilled disposable vape from HQD. You don't refill it and you don't swap coils. You vape it until the juice runs out, then you recycle or replace it. What sets it apart is the size of the tank and the screen on the front.
          </p>
          <p>
            It's draw-activated, so there's no button to press. You inhale and it fires. The 18mL prefill is one of the largest in the 9,000-puff class, which is why the device can actually reach its puff rating without running dry early.
          </p>

          <!-- Subsection: 2.0 vs Original Cuvie Plus -->
          <h3>2.0 vs the Original Cuvie Plus</h3>
          <p>
            The original Cuvie Plus was a smaller device with a lower puff count and no screen. The 2.0 is the upgraded version. Here's what changed:
          </p>
          <ul>
            <li>The tank grew to 18mL for a longer runtime.</li>
            <li>HQD added an LCD screen for battery and e-liquid readouts.</li>
            <li>The coil moved to a dual mesh setup for more even heating.</li>
            <li>The puff rating jumped to 9,000+.</li>
          </ul>
          <p>
            Again, the "2.0" is a hardware label. It does not mean 2% nicotine. The standard version is 5% (50mg).
          </p>

          <!-- Section 2: Specs Table -->
          <h2>HQD Cuvie Plus 2.0 Specs</h2>
          <p>
            Here's the full rundown of what's inside the device. Every number below is pulled from the product listing.
          </p>

          <div class="specs-table-responsive">
            <table class="specs-detail-table">
              <thead>
                <tr>
                  <th>Spec</th>
                  <th>HQD Cuvie Plus 2.0</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Puff count</td>
                  <td>9,000+</td>
                </tr>
                <tr>
                  <td>E-liquid</td>
                  <td>18mL prefilled</td>
                </tr>
                <tr>
                  <td>Coil</td>
                  <td>Dual mesh</td>
                </tr>
                <tr>
                  <td>Display</td>
                  <td>LCD (battery + juice)</td>
                </tr>
                <tr>
                  <td>Battery</td>
                  <td>600mAh rechargeable</td>
                </tr>
                <tr>
                  <td>Charging</td>
                  <td>USB Type-C</td>
                </tr>
                <tr>
                  <td>Power output</td>
                  <td>9W</td>
                </tr>
                <tr>
                  <td>Activation</td>
                  <td>Draw-activated</td>
                </tr>
                <tr>
                  <td>Nicotine</td>
                  <td>5% (50mg) salt nic, or 0%</td>
                </tr>
              </tbody>
            </table>
          </div>

          <p class="specs-footnote">
            The 18mL tank is the headline number here. Most 9,000-puff devices carry 10mL to 14mL. The extra capacity is what keeps flavor consistent from your first puff to your last.
          </p>

          <!-- Section 3: Flavors -->
          <h2>HQD Cuvie Plus 2.0 Flavors</h2>
          <p>
            The 5% version comes in 22 flavors. They span fruit, menthol, dessert, and a few unusual blends. Here are several of the standouts:
          </p>
          <ul class="flavor-highlights-list">
            <li><strong>Black Ice:</strong> sweet blackberry with a crisp menthol chill.</li>
            <li><strong>Miami Mint:</strong> cool, clean mint with a tropical edge.</li>
            <li><strong>Pineapple Strawnana:</strong> tropical pineapple blended with sweet banana.</li>
            <li><strong>Red Mojito:</strong> refreshing lime and mint, inspired by the cocktail.</li>
            <li><strong>Colombian Coffee Ice:</strong> bold roast with a creamy, icy finish.</li>
            <li><strong>Triple Berry Ice:</strong> a trio of berries with a frosty exhale.</li>
            <li><strong>Watermelon Lychee:</strong> juicy watermelon paired with exotic lychee.</li>
          </ul>

          <!-- Section 4: Design & Build Quality -->
          <h2>Design, Ergonomics &amp; Build Quality</h2>
          <p>
            The original Cuvie Plus was famous for its sleek tubular pen form factor. With the Cuvie Plus 2.0, HQD maintained a cylindrical silhouette while broadening the chassis slightly to house an industry-leading 18mL e-liquid reservoir and an integrated digital dashboard.
          </p>
          <p>
            The exterior body is forged from lightweight aluminum alloy treated with an anodized satin gradient finish. It feels sturdy in hand, resists fingerprints, and easily slides into pockets without feeling bulky. The mouthpiece features an ergonomic duckbill contour that seals comfortably against your lips, directing the vapor stream straight to the palate without condensation leakage.
          </p>

          <!-- Section 5: The Smart LCD Screen -->
          <h2>The Smart LCD Screen: Real-Time Data Monitoring</h2>
          <p>
            One of the biggest pain points with early disposable vapes was the "blind draw"—never knowing whether your device had 10 puffs left or 1,000, or whether your battery would suddenly blink mid-commute. The Cuvie Plus 2.0 addresses this with an embedded front-facing LED screen that illuminates whenever you draw:
          </p>
          <ul>
            <li><strong>Battery Percentage Indicator:</strong> Displays exact real-time battery charge from 100% down to 0%, giving you advance warning when it's time to plug in.</li>
            <li><strong>E-Liquid Level Meter:</strong> A graduated droplet icon reflects current liquid saturation so you never experience surprise dry puffs or scorched wicks.</li>
            <li><strong>Firing Animation:</strong> A dynamic pulse shows active coil vaporization during inhalation.</li>
          </ul>

          <!-- Section 6: Dual Mesh Coil & Vapor Performance -->
          <h2>Dual Mesh Coil Technology &amp; Vapor Performance</h2>
          <p>
            Under the hood, HQD implemented an advanced dual mesh heating element powered by an intelligent chipset delivering a consistent 9W output. Many standard disposables suffer from severe flavor degradation as the battery voltage drops below 50%. The Cuvie Plus 2.0 features regulated voltage output, meaning your 200th puff tastes just as crisp, saturated, and punchy as your first.
          </p>
          <p>
            The draw resistance is tuned for an authentic Mouth-to-Lung (MTL) experience. It closely replicates the tight pull of traditional cigarettes, making it a prime choice for smokers making the switch. Vapor production is dense and aromatic without producing cloud-chasing room-filling plumes.
          </p>

          <!-- Section 7: Step-by-Step Usage Guide -->
          <h2>How to Use the HQD Cuvie Plus 2.0: Beginner Guide</h2>
          <p>
            Getting started with the Cuvie Plus 2.0 requires zero maintenance or prior vape knowledge. Follow these simple steps right out of the box:
          </p>

          <ol class="step-guide-list">
            <li class="step-guide-item">
              <div class="step-guide-badge">1</div>
              <h4 class="step-guide-title">Unbox and Inspect Packaging</h4>
              <p class="step-guide-desc">Carefully tear open the sealed foil pouch. Verify the authenticity scratch sticker on the retail packaging to confirm you have a genuine HQD product.</p>
            </li>
            <li class="step-guide-item">
              <div class="step-guide-badge">2</div>
              <h4 class="step-guide-title">Remove Mouthpiece Silicone Plug</h4>
              <p class="step-guide-desc">Pull out the food-grade silicone plug inserted into the top mouthpiece. This plug prevents oxidation and juice leakage during transit.</p>
            </li>
            <li class="step-guide-item">
              <div class="step-guide-badge">3</div>
              <h4 class="step-guide-title">Peel the Bottom Airflow Seal</h4>
              <p class="step-guide-desc">Peel away the clear protective film or sticker covering the USB-C port and airflow intake holes located at the device base.</p>
            </li>
            <li class="step-guide-item">
              <div class="step-guide-badge">4</div>
              <h4 class="step-guide-title">Draw to Activate</h4>
              <p class="step-guide-desc">Take a slow, steady 2 to 3-second draw from the mouthpiece. The internal air-sensor automatically triggers the coil, and the LCD screen lights up.</p>
            </li>
          </ol>

          <!-- Section 8: Battery Life & USB-C Fast Charging -->
          <h2>Battery Life &amp; Charging Best Practices</h2>
          <p>
            The device incorporates a 600mAh rechargeable lithium-ion cell. On a single charge, moderate vapers can expect between 24 to 36 hours of continuous usage. Once the battery readout hits 0%, charging is fast and straightforward:
          </p>
          <ul>
            <li>Connect any standard USB Type-C charging cable into the bottom port.</li>
            <li>Connect the cable to a low-voltage power supply (such as a 5V/1A wall adapter, power bank, or computer USB slot).</li>
            <li>Full recharge takes approximately 40 to 50 minutes. The LCD display will indicate when charging is complete.</li>
          </ul>
          <p>
            <strong>Safety Tip:</strong> Avoid using high-wattage smartphone fast-chargers (e.g., 65W or 100W PD adapters) as they can stress small lithium batteries. Do not leave the device charging unattended overnight.
          </p>

          <!-- Section 9: Comparison Table -->
          <h2>How Does It Compare to Competing High-Puff Disposables?</h2>
          <p>
            How does the Cuvie Plus 2.0 hold up against rival heavyweight disposables on the market? Here is a quick feature matchup:
          </p>

          <div class="specs-table-responsive">
            <table class="specs-detail-table">
              <thead>
                <tr>
                  <th>Device</th>
                  <th>E-Liquid Capacity</th>
                  <th>Puff Rating</th>
                  <th>Screen Type</th>
                  <th>Zero Nicotine?</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>HQD Cuvie Plus 2.0</strong></td>
                  <td>18mL</td>
                  <td>9,000 Puffs</td>
                  <td>Smart LCD (Battery &amp; Juice)</td>
                  <td>Yes (0% &amp; 5%)</td>
                </tr>
                <tr>
                  <td><strong>Lost Mary OS5000</strong></td>
                  <td>13mL</td>
                  <td>5,000 Puffs</td>
                  <td>3-Color LED Light</td>
                  <td>Select Flavors</td>
                </tr>
                <tr>
                  <td><strong>Geek Bar Pulse 15K</strong></td>
                  <td>16mL</td>
                  <td>15,000 (Reg) / 7,500 (Pulse)</td>
                  <td>Full Capsule Screen</td>
                  <td>Yes</td>
                </tr>
                <tr>
                  <td><strong>RAZ TN9000</strong></td>
                  <td>12mL</td>
                  <td>9,000 Puffs</td>
                  <td>0.96-inch HD Screen</td>
                  <td>No (5% Only)</td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Section 11: Who Should Buy It? -->
          <h2>Who Should Buy the HQD Cuvie Plus 2.0?</h2>
          <p>
            The HQD Cuvie Plus 2.0 hits the sweet spot for several categories of vapers:
          </p>
          <ul>
            <li><strong>Heavy Daily Vapers:</strong> With 18mL of juice, you won't have to replace your device every three days. Most moderate users get nearly two full weeks per unit.</li>
            <li><strong>Former Smokers:</strong> The tight, warm MTL pull coupled with 50mg nicotine salts delivers an authentic throat sensation that curbs cigarette cravings effectively.</li>
            <li><strong>Those Tapering Nicotine:</strong> Because HQD formulates 0% nicotine versions of their most popular flavors, you can step down without sacrificing your favorite taste profiles.</li>
            <li><strong>Busy Professionals &amp; Travelers:</strong> The reliable LCD gauge means you'll never be surprised by a drained device during meetings or road trips.</li>
          </ul>

          <!-- Section 12: FAQs -->
          <h2>Frequently Asked Questions (FAQ)</h2>
          
          <div class="article-faq-list">
            <div class="article-faq-item">
              <h4 class="article-faq-question">Q: Does the "2.0" mean this vape has 2% nicotine?</h4>
              <p class="article-faq-answer">
                No. The "2.0" is the hardware generation label indicating the upgraded edition with the 18mL tank and digital display. The device contains 5% (50mg) salt nicotine by default, with dedicated 0% zero-nicotine models available separately.
              </p>
            </div>

            <div class="article-faq-item">
              <h4 class="article-faq-question">Q: How many days will 9,000 puffs actually last?</h4>
              <p class="article-faq-answer">
                Longevity depends on inhalation habits. An average vaper taking 400 to 500 puffs daily will get approximately 14 to 18 days of use. Heavy chain vapers typically experience between 8 and 12 days before the 18mL reservoir is depleted.
              </p>
            </div>

            <div class="article-faq-item">
              <h4 class="article-faq-question">Q: Can I refill the HQD Cuvie Plus 2.0 with my own e-liquid?</h4>
              <p class="article-faq-answer">
                No. The Cuvie Plus 2.0 is a sealed, disposable device engineered to prevent leaks and maintain factory coil hygiene. Attempting to pry open the chassis will damage the internal chipset and voids product safety.
              </p>
            </div>

            <div class="article-faq-item">
              <h4 class="article-faq-question">Q: What should I do if the device doesn't fire when I inhale?</h4>
              <p class="article-faq-answer">
                First, check that both the silicone mouthpiece plug and the bottom airflow protective sticker have been fully removed. If the screen doesn't illuminate, plug the device into a USB-C charger for 30 minutes to replenish the battery.
              </p>
            </div>

            <div class="article-faq-item">
              <h4 class="article-faq-question">Q: How do I know when the device is completely finished?</h4>
              <p class="article-faq-answer">
                The liquid icon on the LCD will show empty, vapor output will become thinner, and the flavor will diminish. Once flavor output stops, responsibly dispose of or recycle the device at an e-waste drop point.
              </p>
            </div>
          </div>

        </div>

        <!-- ==============================================
             SOCIAL SHARE BUTTONS
             ============================================== -->
        <div class="blog-article-share-bar">
          <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://localhost/newvape/blog-detail.php'); ?>" target="_blank" rel="noopener noreferrer" class="btn-social-share share-fb" aria-label="Share on Facebook">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
              <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
            <span>Share on Facebook</span>
          </a>

          <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://localhost/newvape/blog-detail.php'); ?>&text=<?php echo urlencode('HQD Cuvie Plus 2.0: Flavors, Specs & How to Use'); ?>" target="_blank" rel="noopener noreferrer" class="btn-social-share share-x" aria-label="Share on X">
            <svg viewBox="0 0 24 24" width="15" height="15" fill="currentColor">
              <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
            </svg>
            <span>Share on X</span>
          </a>

          <a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode('http://localhost/newvape/blog-detail.php'); ?>&description=<?php echo urlencode('HQD Cuvie Plus 2.0: Flavors, Specs & How to Use'); ?>" target="_blank" rel="noopener noreferrer" class="btn-social-share share-pinterest" aria-label="Share on Pinterest">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
              <path d="M12 0a12 12 0 0 0-4.37 23.18c-.05-.98-.1-2.48.02-3.55l1.04-4.42s-.26-.52-.26-1.3c0-1.22.7-2.13 1.59-2.13.75 0 1.11.56 1.11 1.24 0 .76-.48 1.89-.73 2.94-.21.88.44 1.6 1.3 1.6 1.57 0 2.78-1.65 2.78-4.04 0-2.11-1.52-3.59-3.69-3.59-2.51 0-3.99 1.89-3.99 3.84 0 .76.29 1.58.66 2.02.07.09.08.17.06.26l-.25 1.02c-.04.16-.14.2-.32.12-1.18-.55-1.92-2.27-1.92-3.65 0-2.98 2.16-5.71 6.24-5.71 3.28 0 5.82 2.34 5.82 5.46 0 3.26-2.05 5.88-4.9 5.88-.96 0-1.86-.5-2.17-1.09l-.59 2.26c-.22.84-.8 1.89-1.2 2.52A12 12 0 1 0 12 0z"/>
            </svg>
            <span>Share on Pinterest</span>
          </a>
        </div>

      </article>

      <!-- ========================================
           RIGHT COLUMN: SIDEBAR (SAME AS BLOG & TAG)
           ======================================== -->
      <aside class="blog-sidebar-col" aria-label="Blog Sidebar">
        
        <!-- WIDGET 1: SEARCH BAR -->
        <div class="blog-widget blog-search-widget">
          <form class="blog-search-form" id="blogSearchForm" action="blog.php" method="GET">
            <div class="search-input-wrapper">
              <input 
                type="text" 
                name="search"
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
            <li class="category-list-item">
              <a href="<?= url('blog') ?>" class="category-link">
                <span class="category-name">All Articles</span>
                <span class="category-count">(94)</span>
              </a>
            </li>
            <li class="category-list-item">
              <a href="<?= url('blog') ?>?cat=comparisons" class="category-link">
                <span class="category-name">Comparisons</span>
                <span class="category-count">(14)</span>
              </a>
            </li>
            <li class="category-list-item">
              <a href="<?= url('blog') ?>?cat=brand-spotlights" class="category-link">
                <span class="category-name">Brand Spotlights</span>
                <span class="category-count">(18)</span>
              </a>
            </li>
            <li class="category-list-item">
              <a href="<?= url('blog') ?>?cat=deals-savings" class="category-link">
                <span class="category-name">Deals &amp; Savings</span>
                <span class="category-count">(3)</span>
              </a>
            </li>
            <li class="category-list-item">
              <a href="<?= url('blog') ?>?cat=industry-news" class="category-link">
                <span class="category-name">Industry News</span>
                <span class="category-count">(26)</span>
              </a>
            </li>
            <li class="category-list-item">
              <a href="<?= url('blog') ?>?cat=hemp-cbd" class="category-link">
                <span class="category-name">Hemp &amp; CBD</span>
                <span class="category-count">(18)</span>
              </a>
            </li>
            <li class="category-list-item">
              <a href="<?= url('blog') ?>?cat=nicotine-pouches" class="category-link">
                <span class="category-name">Nicotine Pouches</span>
                <span class="category-count">(11)</span>
              </a>
            </li>
            <li class="category-list-item">
              <a href="<?= url('blog') ?>?cat=flavor-profiles" class="category-link">
                <span class="category-name">Flavor Profiles</span>
                <span class="category-count">(11)</span>
              </a>
            </li>
            <li class="category-list-item active">
              <a href="<?= url('blog') ?>?cat=product-reviews" class="category-link">
                <span class="category-name">Product Reviews</span>
                <span class="category-count">(30)</span>
              </a>
            </li>
            <li class="category-list-item">
              <a href="<?= url('blog') ?>?cat=vaping-guides" class="category-link">
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
