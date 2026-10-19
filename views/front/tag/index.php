<?php
$tag_slug = isset($_GET['tag']) && !empty($_GET['tag']) ? htmlspecialchars(trim($_GET['tag'])) : 'puff-count';
$tag_title = ucwords(str_replace(['-', '_'], ' ', $tag_slug));
$current_page = isset($_GET['page']) ? max(1, min(2, (int)$_GET['page'])) : 1;

$page_title = $tag_title . ' | New Vape Blog';
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
      <li class="breadcrumb-item active" aria-current="page">
        <?php echo htmlspecialchars($tag_title); ?>
      </li>
    </ol>
  </div>
</nav>

<!-- ==========================================
     2. TAG PAGE MAIN LAYOUT (CONTENT + SIDEBAR)
     ========================================== -->
<section class="tag-layout-section">
  <div class="container">
    <div class="blog-layout-grid">
      
      <!-- ========================================
           LEFT COLUMN: TAG TITLE & ARTICLE CARDS
           ======================================== -->
      <div class="tag-main-col">
        
        <!-- Tag Page H1 Heading -->
        <div class="tag-page-header">
          <h1 class="tag-page-title"><?php echo htmlspecialchars($tag_title); ?></h1>
        </div>

        <!-- Tag Horizontal Posts List (16 Cards Total: 12 on Page 1, 4 on Page 2) -->
        <div class="tag-posts-list" id="tagPostsList">
          
          <!-- Card 1 (Page 1) -->
          <article class="tag-post-card" data-page="1" style="<?php echo $current_page === 1 ? '' : 'display: none;'; ?>">
            <a href="<?= url('blog-detail') ?>?post=how-long-do-juulpods-last" class="tag-post-thumb-link" aria-label="How Long Do JUULpods Last? Puffs, Nicotine and Pod Care">
              <img src="assets/images/blog-1.jpg" alt="How Long Do JUULpods Last? Puffs, Nicotine and Pod Care" class="tag-post-thumb-img" loading="lazy">
            </a>
            <div class="tag-post-body">
              <h2 class="tag-post-title">
                <a href="<?= url('blog-detail') ?>?post=how-long-do-juulpods-last">How Long Do JUULpods Last? Puffs, Nicotine and Pod Care</a>
              </h2>
              <div class="tag-post-meta">
                <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                <span class="meta-separator">|</span>
                <span class="meta-date">Sep 18, 2026</span>
                <span class="meta-separator">|</span>
                <span class="meta-read-time">9 min read</span>
              </div>
              <p class="tag-post-excerpt">
                A JUUL pod holds about 0.7mL of nicotine salt e-liquid and runs roughly 200 puffs, which is JUUL's estimate rather than a measured spec. How many days that buys you depends entirely on how often you draw,
              </p>
              <div class="tag-post-badges">
                <a href="<?= url('blog') ?>?cat=vaping-guides" class="tag-badge-pill">Vaping Guides</a>
              </div>
            </div>
          </article>

          <!-- Card 2 (Page 1) -->
          <article class="tag-post-card" data-page="1" style="<?php echo $current_page === 1 ? '' : 'display: none;'; ?>">
            <a href="<?= url('blog-detail') ?>?post=how-to-use-an-adjust-vape" class="tag-post-thumb-link" aria-label="How to Use an Adjust Vape: Every Dial Explained">
              <img src="assets/images/foger-switch-pro-new-pod-flavors-d-banner.webp" alt="How to Use an Adjust Vape: Every Dial Explained" class="tag-post-thumb-img" loading="lazy">
            </a>
            <div class="tag-post-body">
              <h2 class="tag-post-title">
                <a href="<?= url('blog-detail') ?>?post=how-to-use-an-adjust-vape">How to Use an Adjust Vape: Every Dial Explained</a>
              </h2>
              <div class="tag-post-meta">
                <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                <span class="meta-separator">|</span>
                <span class="meta-date">Sep 15, 2026</span>
                <span class="meta-separator">|</span>
                <span class="meta-read-time">7 min read</span>
              </div>
              <p class="tag-post-excerpt">
                Every Adjust vape has a dial, and each model tunes something different: coolness, flavor blending, sweetness or power. Here's what each one does and how to set it.
              </p>
              <div class="tag-post-badges">
                <a href="<?= url('blog') ?>?cat=industry-news" class="tag-badge-pill">Industry News</a>
                <a href="<?= url('blog') ?>?cat=vaping-guides" class="tag-badge-pill">Vaping Guides</a>
              </div>
            </div>
          </article>

          <!-- Card 3 (Page 1) -->
          <article class="tag-post-card" data-page="1" style="<?php echo $current_page === 1 ? '' : 'display: none;'; ?>">
            <a href="<?= url('blog-detail') ?>?post=what-is-a-purse-vape" class="tag-post-thumb-link" aria-label="What Is a Purse Vape? The Chain-Strap Trend Explained">
              <img src="assets/images/vape-image.webp" alt="What Is a Purse Vape? The Chain-Strap Trend Explained" class="tag-post-thumb-img" loading="lazy">
            </a>
            <div class="tag-post-body">
              <h2 class="tag-post-title">
                <a href="<?= url('blog-detail') ?>?post=what-is-a-purse-vape">What Is a Purse Vape? The Chain-Strap Trend Explained</a>
              </h2>
              <div class="tag-post-meta">
                <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                <span class="meta-separator">|</span>
                <span class="meta-date">Sep 11, 2026</span>
                <span class="meta-separator">|</span>
                <span class="meta-read-time">7 min read</span>
              </div>
              <p class="tag-post-excerpt">
                A purse vape is a disposable shaped like a tiny handbag, with a leather-look body and a chain you can wear. Here's what they are, what they're called, and whether one is worth buying.
              </p>
              <div class="tag-post-badges">
                <a href="<?= url('blog') ?>?cat=product-reviews" class="tag-badge-pill">Product Reviews</a>
                <a href="<?= url('blog') ?>?cat=vaping-guides" class="tag-badge-pill">Vaping Guides</a>
              </div>
            </div>
          </article>

          <!-- Card 4 (Page 1) -->
          <article class="tag-post-card" data-page="1" style="<?php echo $current_page === 1 ? '' : 'display: none;'; ?>">
            <a href="<?= url('blog-detail') ?>?post=lost-mary-mt35000-pixy-edition" class="tag-post-thumb-link" aria-label="Lost Mary MT35000 Pixy Edition: 5 Candy Flavors Ranked by Puffs">
              <img src="assets/images/blog-4.jpg" alt="Lost Mary MT35000 Pixy Edition: 5 Candy Flavors Ranked by Puffs" class="tag-post-thumb-img" loading="lazy">
            </a>
            <div class="tag-post-body">
              <h2 class="tag-post-title">
                <a href="<?= url('blog-detail') ?>?post=lost-mary-mt35000-pixy-edition">Lost Mary MT35000 Pixy Edition: 5 Candy Flavors Ranked by Puffs</a>
              </h2>
              <div class="tag-post-meta">
                <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                <span class="meta-separator">|</span>
                <span class="meta-date">May 19, 2026</span>
                <span class="meta-separator">|</span>
                <span class="meta-read-time">11 min read</span>
              </div>
              <p class="tag-post-excerpt">
                35,000 puffs with dual mesh coils and rapid charging. We put the MT35000 through real-world duration testing to see how long each pod truly lasts.
              </p>
              <div class="tag-post-badges">
                <a href="<?= url('blog') ?>?cat=flavor-profiles" class="tag-badge-pill">Flavor Profiles</a>
                <a href="<?= url('blog') ?>?cat=vaping-guides" class="tag-badge-pill">Vaping Guides</a>
              </div>
            </div>
          </article>

          <!-- Card 5 (Page 1) -->
          <article class="tag-post-card" data-page="1" style="<?php echo $current_page === 1 ? '' : 'display: none;'; ?>">
            <a href="<?= url('blog-detail') ?>?post=lost-mary-vapes-5-devices" class="tag-post-thumb-link" aria-label="Lost Mary Vapes: 5 Devices from 20K to 70K Puffs Compared">
              <img src="assets/images/img-1.png" alt="Lost Mary Vapes: 5 Devices from 20K to 70K Puffs Compared" class="tag-post-thumb-img" loading="lazy">
            </a>
            <div class="tag-post-body">
              <h2 class="tag-post-title">
                <a href="<?= url('blog-detail') ?>?post=lost-mary-vapes-5-devices">Lost Mary Vapes: 5 Devices from 20K to 70K Puffs Compared</a>
              </h2>
              <div class="tag-post-meta">
                <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                <span class="meta-separator">|</span>
                <span class="meta-date">Mar 19, 2026</span>
                <span class="meta-separator">|</span>
                <span class="meta-read-time">8 min read</span>
              </div>
              <p class="tag-post-excerpt">
                From pocketable 20K disposables to massive 70K cloud machines. How puff counts are measured across the top 2026 Lost Mary models.
              </p>
              <div class="tag-post-badges">
                <a href="<?= url('blog') ?>?cat=comparisons" class="tag-badge-pill">Comparisons</a>
                <a href="<?= url('blog') ?>?cat=vaping-guides" class="tag-badge-pill">Vaping Guides</a>
              </div>
            </div>
          </article>

          <!-- Card 6 (Page 1) -->
          <article class="tag-post-card" data-page="1" style="<?php echo $current_page === 1 ? '' : 'display: none;'; ?>">
            <a href="<?= url('blog-detail') ?>?post=chillax-psylo-35k-review" class="tag-post-thumb-link" aria-label="Chillax Psylo 35K Review: Lock System, Smart Chip & Performance">
              <img src="assets/images/blog-3.jpg" alt="Chillax Psylo 35K Review: Lock System, Smart Chip & Performance" class="tag-post-thumb-img" loading="lazy">
            </a>
            <div class="tag-post-body">
              <h2 class="tag-post-title">
                <a href="<?= url('blog-detail') ?>?post=chillax-psylo-35k-review">Chillax Psylo 35K Review: Lock System, Smart Chip &amp; Performance</a>
              </h2>
              <div class="tag-post-meta">
                <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                <span class="meta-separator">|</span>
                <span class="meta-date">Apr 07, 2026</span>
                <span class="meta-separator">|</span>
                <span class="meta-read-time">10 min read</span>
              </div>
              <p class="tag-post-excerpt">
                High puff count devices demand robust battery efficiency. The Chillax Psylo pairs 35K capacity with smart voltage management and leak-proof seals.
              </p>
              <div class="tag-post-badges">
                <a href="<?= url('blog') ?>?cat=product-reviews" class="tag-badge-pill">Product Reviews</a>
                <a href="<?= url('blog') ?>?cat=vaping-guides" class="tag-badge-pill">Vaping Guides</a>
              </div>
            </div>
          </article>

          <!-- Card 7 (Page 1) -->
          <article class="tag-post-card" data-page="1" style="<?php echo $current_page === 1 ? '' : 'display: none;'; ?>">
            <a href="<?= url('blog-detail') ?>?post=geek-bar-pulse-test" class="tag-post-thumb-link" aria-label="Geek Bar Pulse 15000 vs Pulse X 25000: Real Puff Count Test">
              <img src="assets/images/geek-bar.webp" alt="Geek Bar Pulse 15000 vs Pulse X 25000: Real Puff Count Test" class="tag-post-thumb-img" loading="lazy">
            </a>
            <div class="tag-post-body">
              <h2 class="tag-post-title">
                <a href="<?= url('blog-detail') ?>?post=geek-bar-pulse-test">Geek Bar Pulse 15000 vs Pulse X 25000: Real Puff Count Test</a>
              </h2>
              <div class="tag-post-meta">
                <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                <span class="meta-separator">|</span>
                <span class="meta-date">Aug 22, 2026</span>
                <span class="meta-separator">|</span>
                <span class="meta-read-time">9 min read</span>
              </div>
              <p class="tag-post-excerpt">
                Does the Pulse X really last 10,000 puffs longer than the original Pulse? We ran battery and liquid tests to determine actual puff output.
              </p>
              <div class="tag-post-badges">
                <a href="<?= url('blog') ?>?cat=comparisons" class="tag-badge-pill">Comparisons</a>
                <a href="<?= url('blog') ?>?cat=product-reviews" class="tag-badge-pill">Product Reviews</a>
              </div>
            </div>
          </article>

          <!-- Card 8 (Page 1) -->
          <article class="tag-post-card" data-page="1" style="<?php echo $current_page === 1 ? '' : 'display: none;'; ?>">
            <a href="<?= url('blog-detail') ?>?post=best-high-puff-disposables" class="tag-post-thumb-link" aria-label="Best High Puff Disposable Vapes of 2026 (25K to 50K Puffs)">
              <img src="assets/images/disposible.webp" alt="Best High Puff Disposable Vapes of 2026 (25K to 50K Puffs)" class="tag-post-thumb-img" loading="lazy">
            </a>
            <div class="tag-post-body">
              <h2 class="tag-post-title">
                <a href="<?= url('blog-detail') ?>?post=best-high-puff-disposables">Best High Puff Disposable Vapes of 2026 (25K to 50K Puffs)</a>
              </h2>
              <div class="tag-post-meta">
                <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                <span class="meta-separator">|</span>
                <span class="meta-date">Aug 15, 2026</span>
                <span class="meta-separator">|</span>
                <span class="meta-read-time">12 min read</span>
              </div>
              <p class="tag-post-excerpt">
                Our definitive buyer's guide to ultra high puff vapes. We test battery life, tank capacity, coil resistance and flavor consistency from puff 1 to 30,000.
              </p>
              <div class="tag-post-badges">
                <a href="<?= url('blog') ?>?cat=buying-guide" class="tag-badge-pill">Buying Guide</a>
                <a href="<?= url('blog') ?>?cat=vaping-guides" class="tag-badge-pill">Vaping Guides</a>
              </div>
            </div>
          </article>

          <!-- Card 9 (Page 1) -->
          <article class="tag-post-card" data-page="1" style="<?php echo $current_page === 1 ? '' : 'display: none;'; ?>">
            <a href="<?= url('blog-detail') ?>?post=why-vape-runs-out-early" class="tag-post-thumb-link" aria-label="Why Does My Vape Run Out of Puffs Early? 6 Common Causes">
              <img src="assets/images/blog-2.jpg" alt="Why Does My Vape Run Out of Puffs Early? 6 Common Causes" class="tag-post-thumb-img" loading="lazy">
            </a>
            <div class="tag-post-body">
              <h2 class="tag-post-title">
                <a href="<?= url('blog-detail') ?>?post=why-vape-runs-out-early">Why Does My Vape Run Out of Puffs Early? 6 Common Causes</a>
              </h2>
              <div class="tag-post-meta">
                <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                <span class="meta-separator">|</span>
                <span class="meta-date">Aug 08, 2026</span>
                <span class="meta-separator">|</span>
                <span class="meta-read-time">6 min read</span>
              </div>
              <p class="tag-post-excerpt">
                If your 20,000 puff disposable dies in four days, you are likely taking 5-second deep lung hits. Here is how manufacturers measure puffs vs reality.
              </p>
              <div class="tag-post-badges">
                <a href="<?= url('blog') ?>?cat=vaping-guides" class="tag-badge-pill">Vaping Guides</a>
                <a href="<?= url('blog') ?>?cat=how-to" class="tag-badge-pill">How To</a>
              </div>
            </div>
          </article>

          <!-- Card 10 (Page 1) -->
          <article class="tag-post-card" data-page="1" style="<?php echo $current_page === 1 ? '' : 'display: none;'; ?>">
            <a href="<?= url('blog-detail') ?>?post=foger-switch-pro-longevity" class="tag-post-thumb-link" aria-label="Foger Switch Pro 30K Pod Longevity & Refill Myths Debunked">
              <img src="assets/images/foger-switch-pro-new-pod-flavors-d-banner.webp" alt="Foger Switch Pro 30K Pod Longevity & Refill Myths Debunked" class="tag-post-thumb-img" loading="lazy">
            </a>
            <div class="tag-post-body">
              <h2 class="tag-post-title">
                <a href="<?= url('blog-detail') ?>?post=foger-switch-pro-longevity">Foger Switch Pro 30K Pod Longevity &amp; Refill Myths Debunked</a>
              </h2>
              <div class="tag-post-meta">
                <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                <span class="meta-separator">|</span>
                <span class="meta-date">Jul 27, 2026</span>
                <span class="meta-separator">|</span>
                <span class="meta-read-time">8 min read</span>
              </div>
              <p class="tag-post-excerpt">
                Can a replaceable pod device hit 30K puffs with consistent airflow? We inspect the coil breakdown, e-liquid absorption and power draw.
              </p>
              <div class="tag-post-badges">
                <a href="<?= url('blog') ?>?cat=product-reviews" class="tag-badge-pill">Product Reviews</a>
                <a href="<?= url('blog') ?>?cat=vaping-guides" class="tag-badge-pill">Vaping Guides</a>
              </div>
            </div>
          </article>

          <!-- Card 11 (Page 1) -->
          <article class="tag-post-card" data-page="1" style="<?php echo $current_page === 1 ? '' : 'display: none;'; ?>">
            <a href="<?= url('blog-detail') ?>?post=puff-count-vs-nicotine" class="tag-post-thumb-link" aria-label="Puff Count vs Nicotine Strength: How to Choose the Right Setup">
              <img src="assets/images/twin-banner.webp" alt="Puff Count vs Nicotine Strength: How to Choose the Right Setup" class="tag-post-thumb-img" loading="lazy">
            </a>
            <div class="tag-post-body">
              <h2 class="tag-post-title">
                <a href="<?= url('blog-detail') ?>?post=puff-count-vs-nicotine">Puff Count vs Nicotine Strength: How to Choose the Right Setup</a>
              </h2>
              <div class="tag-post-meta">
                <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                <span class="meta-separator">|</span>
                <span class="meta-date">Jul 19, 2026</span>
                <span class="meta-separator">|</span>
                <span class="meta-read-time">7 min read</span>
              </div>
              <p class="tag-post-excerpt">
                Higher puff devices often have larger tanks, but nicotine satisfaction depends on milligram strength and coil wattage. Calculate your optimal daily dosage.
              </p>
              <div class="tag-post-badges">
                <a href="<?= url('blog') ?>?cat=beginner-guide" class="tag-badge-pill">Beginner Guide</a>
                <a href="<?= url('blog') ?>?cat=vaping-guides" class="tag-badge-pill">Vaping Guides</a>
              </div>
            </div>
          </article>

          <!-- Card 12 (Page 1) -->
          <article class="tag-post-card" data-page="1" style="<?php echo $current_page === 1 ? '' : 'display: none;'; ?>">
            <a href="<?= url('blog-detail') ?>?post=off-stamp-modular-analysis" class="tag-post-thumb-link" aria-label="Off-Stamp SW9000 & SW16000 Modular Battery Puff Analysis">
              <img src="assets/images/img-2.png" alt="Off-Stamp SW9000 & SW16000 Modular Battery Puff Analysis" class="tag-post-thumb-img" loading="lazy">
            </a>
            <div class="tag-post-body">
              <h2 class="tag-post-title">
                <a href="<?= url('blog-detail') ?>?post=off-stamp-modular-analysis">Off-Stamp SW9000 &amp; SW16000 Modular Battery Puff Analysis</a>
              </h2>
              <div class="tag-post-meta">
                <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                <span class="meta-separator">|</span>
                <span class="meta-date">Jul 10, 2026</span>
                <span class="meta-separator">|</span>
                <span class="meta-read-time">9 min read</span>
              </div>
              <p class="tag-post-excerpt">
                The detachable power bank concept changes how long pod cartridges last. We break down the true puff yield of the SW9000 and SW16000 pods.
              </p>
              <div class="tag-post-badges">
                <a href="<?= url('blog') ?>?cat=product-reviews" class="tag-badge-pill">Product Reviews</a>
                <a href="<?= url('blog') ?>?cat=industry-news" class="tag-badge-pill">Industry News</a>
              </div>
            </div>
          </article>

          <!-- ==============================================
               12 K BAAD: PAGE 2 ARTICLES (CARDS 13 TO 16)
               ============================================== -->

          <!-- Card 13 (Page 2) -->
          <article class="tag-post-card" data-page="2" style="<?php echo $current_page === 2 ? '' : 'display: none;'; ?>">
            <a href="<?= url('blog-detail') ?>?post=e-liquid-capacity-vs-puff-count" class="tag-post-thumb-link" aria-label="E-Liquid Capacity vs Stated Puff Count: What the Numbers Mean">
              <img src="assets/images/e-liquid.webp" alt="E-Liquid Capacity vs Stated Puff Count: What the Numbers Mean" class="tag-post-thumb-img" loading="lazy">
            </a>
            <div class="tag-post-body">
              <h2 class="tag-post-title">
                <a href="<?= url('blog-detail') ?>?post=e-liquid-capacity-vs-puff-count">E-Liquid Capacity vs Stated Puff Count: What the Numbers Mean</a>
              </h2>
              <div class="tag-post-meta">
                <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                <span class="meta-separator">|</span>
                <span class="meta-date">Jun 28, 2026</span>
                <span class="meta-separator">|</span>
                <span class="meta-read-time">8 min read</span>
              </div>
              <p class="tag-post-excerpt">
                A device with 18mL says 20K puffs while another with 22mL says 15K. Understand how coil wattage and draw duration dictate actual vapor yield.
              </p>
              <div class="tag-post-badges">
                <a href="<?= url('blog') ?>?cat=buying-guide" class="tag-badge-pill">Buying Guide</a>
                <a href="<?= url('blog') ?>?cat=vaping-guides" class="tag-badge-pill">Vaping Guides</a>
              </div>
            </div>
          </article>

          <!-- Card 14 (Page 2) -->
          <article class="tag-post-card" data-page="2" style="<?php echo $current_page === 2 ? '' : 'display: none;'; ?>">
            <a href="<?= url('blog-detail') ?>?post=top-5-rechargeables-two-weeks" class="tag-post-thumb-link" aria-label="Top 5 Rechargeable Disposables That Last More Than Two Weeks">
              <img src="assets/images/img-3.png" alt="Top 5 Rechargeable Disposables That Last More Than Two Weeks" class="tag-post-thumb-img" loading="lazy">
            </a>
            <div class="tag-post-body">
              <h2 class="tag-post-title">
                <a href="<?= url('blog-detail') ?>?post=top-5-rechargeables-two-weeks">Top 5 Rechargeable Disposables That Last More Than Two Weeks</a>
              </h2>
              <div class="tag-post-meta">
                <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                <span class="meta-separator">|</span>
                <span class="meta-date">Jun 14, 2026</span>
                <span class="meta-separator">|</span>
                <span class="meta-read-time">10 min read</span>
              </div>
              <p class="tag-post-excerpt">
                Tested for daily heavy vaping: these five heavy hitters guarantee consistent vapor production past the two-week mark without burnt coil taste.
              </p>
              <div class="tag-post-badges">
                <a href="<?= url('blog') ?>?cat=best-of" class="tag-badge-pill">Best Of</a>
                <a href="<?= url('blog') ?>?cat=product-reviews" class="tag-badge-pill">Product Reviews</a>
              </div>
            </div>
          </article>

          <!-- Card 15 (Page 2) -->
          <article class="tag-post-card" data-page="2" style="<?php echo $current_page === 2 ? '' : 'display: none;'; ?>">
            <a href="<?= url('blog-detail') ?>?post=smart-screen-puff-counters" class="tag-post-thumb-link" aria-label="Smart Screen Vapes: Accurate Puff Counters vs Estimated Indicators">
              <img src="assets/images/blog-1.jpg" alt="Smart Screen Vapes: Accurate Puff Counters vs Estimated Indicators" class="tag-post-thumb-img" loading="lazy">
            </a>
            <div class="tag-post-body">
              <h2 class="tag-post-title">
                <a href="<?= url('blog-detail') ?>?post=smart-screen-puff-counters">Smart Screen Vapes: Accurate Puff Counters vs Estimated Indicators</a>
              </h2>
              <div class="tag-post-meta">
                <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                <span class="meta-separator">|</span>
                <span class="meta-date">Jun 02, 2026</span>
                <span class="meta-separator">|</span>
                <span class="meta-read-time">7 min read</span>
              </div>
              <p class="tag-post-excerpt">
                Modern smart displays count every puff and show battery/juice percentage. How reliable are these sensors and can they prevent dry hits?
              </p>
              <div class="tag-post-badges">
                <a href="<?= url('blog') ?>?cat=industry-news" class="tag-badge-pill">Industry News</a>
                <a href="<?= url('blog') ?>?cat=vaping-guides" class="tag-badge-pill">Vaping Guides</a>
              </div>
            </div>
          </article>

          <!-- Card 16 (Page 2) -->
          <article class="tag-post-card" data-page="2" style="<?php echo $current_page === 2 ? '' : 'display: none;'; ?>">
            <a href="<?= url('blog-detail') ?>?post=extend-disposable-vape-life" class="tag-post-thumb-link" aria-label="How to Extend the Life of Your High Puff Disposable Vape">
              <img src="assets/images/img-4.png" alt="How to Extend the Life of Your High Puff Disposable Vape" class="tag-post-thumb-img" loading="lazy">
            </a>
            <div class="tag-post-body">
              <h2 class="tag-post-title">
                <a href="<?= url('blog-detail') ?>?post=extend-disposable-vape-life">How to Extend the Life of Your High Puff Disposable Vape</a>
              </h2>
              <div class="tag-post-meta">
                <a href="<?= url('blog') ?>?author=marcus-reyes" class="meta-author">Marcus Reyes</a>
                <span class="meta-separator">|</span>
                <span class="meta-date">May 21, 2026</span>
                <span class="meta-separator">|</span>
                <span class="meta-read-time">6 min read</span>
              </div>
              <p class="tag-post-excerpt">
                Simple habits like avoiding chain vaping, keeping devices upright, and charging at 1A can add hundreds of extra clean puffs to your device.
              </p>
              <div class="tag-post-badges">
                <a href="<?= url('blog') ?>?cat=vape-maintenance" class="tag-badge-pill">Vape Maintenance</a>
                <a href="<?= url('blog') ?>?cat=how-to" class="tag-badge-pill">How To</a>
              </div>
            </div>
          </article>

        </div>

        <!-- ==============================================
             PAGINATION: 12 K BAAD (NO PER-PAGE TEXT)
             ============================================== -->
        <nav class="tag-pagination-nav" aria-label="Tag Articles Pagination">
          <ul class="tag-pagination-list">
            <li class="page-item">
              <a href="<?= url('tag') ?>?page=1" class="page-link prev-btn <?php echo $current_page <= 1 ? 'disabled' : ''; ?>" id="tagPrevBtn" aria-label="Previous Page">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
              </a>
            </li>
            <li class="page-item">
              <a href="<?= url('tag') ?>?page=1" class="page-link page-num-btn <?php echo $current_page === 1 ? 'active' : ''; ?>" data-page="1">1</a>
            </li>
            <li class="page-item">
              <a href="<?= url('tag') ?>?page=2" class="page-link page-num-btn <?php echo $current_page === 2 ? 'active' : ''; ?>" data-page="2">2</a>
            </li>
            <li class="page-item">
              <a href="<?= url('tag') ?>?page=2" class="page-link next-btn <?php echo $current_page >= 2 ? 'disabled' : ''; ?>" id="tagNextBtn" aria-label="Next Page">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
              </a>
            </li>
          </ul>
        </nav>

      </div>

      <!-- ========================================
           RIGHT COLUMN: SIDEBAR (SAME AS BLOG PAGE)
           Direct copy in tag.php without separate include
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
            <li class="category-list-item">
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
            <a href="<?= url('tag') ?>" class="blog-tag-pill active" data-tag="puff-count">Puff Count</a>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
  const pageLinks = document.querySelectorAll('.page-num-btn');
  const prevBtn = document.getElementById('tagPrevBtn');
  const nextBtn = document.getElementById('tagNextBtn');
  const allCards = document.querySelectorAll('.tag-post-card');
  let activePage = <?php echo (int)$current_page; ?>;

  function goToPage(page) {
    activePage = page;
    allCards.forEach(card => {
      const cardPage = parseInt(card.dataset.page, 10);
      if (cardPage === activePage) {
        card.style.display = 'flex';
      } else {
        card.style.display = 'none';
      }
    });

    pageLinks.forEach(btn => {
      btn.classList.toggle('active', parseInt(btn.dataset.page, 10) === activePage);
    });

    if (prevBtn) {
      prevBtn.classList.toggle('disabled', activePage <= 1);
      prevBtn.setAttribute('href', 'tag.php?page=' + (activePage - 1));
    }
    if (nextBtn) {
      nextBtn.classList.toggle('disabled', activePage >= 2);
      nextBtn.setAttribute('href', 'tag.php?page=' + (activePage + 1));
    }

    const postsWrap = document.querySelector('.tag-posts-list');
    if (postsWrap) {
      postsWrap.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }

  pageLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const targetPage = parseInt(this.dataset.page, 10);
      goToPage(targetPage);
    });
  });

  if (prevBtn) {
    prevBtn.addEventListener('click', function(e) {
      e.preventDefault();
      if (activePage > 1) {
        goToPage(activePage - 1);
      }
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', function(e) {
      e.preventDefault();
      if (activePage < 2) {
        goToPage(activePage + 1);
      }
    });
  }
});
</script>

<?php
include dirname(__DIR__) . '/includes/footer.php';
?>
