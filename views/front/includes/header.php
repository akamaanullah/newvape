<?php
/**
 * NEW VAPE - GLOBAL HEADER
 * Included on all pages. Supports dynamic $page_title, $page_css, and $active_page.
 */
if (!isset($page_title)) {
    $page_title = 'Online Vape Store | Premium Vapes, E-Liquids & Disposables';
}

// Fetch dynamic Main Menu tree with Mega Menus and Promotional Banners
$mainMenuTree = [];
if (class_exists('\\App\\Models\\Menu')) {
    $mainMenuTree = \App\Models\Menu::getTreeByLocation('main_menu');
}

// Helper to format storefront navigation links cleanly
$formatNavUrl = function($link) {
    if (empty($link) || $link === '#') return '#';
    if (preg_match('~^(https?://|//|#|mailto:|tel:)~i', $link)) {
        return $link;
    }
    return function_exists('url') ? url($link) : $link;
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($page_title); ?></title>
  <base href="<?php echo function_exists('base_url') ? base_url('/') . '/' : ''; ?>">
  
  <!-- Google Fonts (Outfit & Inter) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Global Single CSS (All styles organized in style.css) -->
  <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
</head>
<body>

  <!-- ==========================================
       TOP BAR 1: FDA NICOTINE WARNING
       ========================================== -->
  <div class="nicotine-warning-bar">
    <div class="container">
      <p class="nicotine-warning-text">
        <strong>WARNING:</strong> This product contains nicotine. Nicotine is an addictive chemical.
      </p>
    </div>
  </div>

  <!-- ==========================================
       TOP BAR 2: FREE SHIPPING PROMO
       ========================================== -->
  <div class="promo-announcement-bar">
    <div class="container">
      <p class="promo-announcement-text">
        Free shipping on orders over $150
      </p>
    </div>
  </div>

  <!-- ==========================================
       MAIN HEADER (LOGO, SEARCH, USER ACTIONS)
       ========================================== -->
  <header class="site-header-main">
    <div class="container">
      <div class="header-main-inner">
        
        <!-- Mobile Menu Toggle Button -->
        <button class="mobile-nav-toggle" id="mobileNavToggle" aria-label="Open navigation menu">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
          </svg>
        </button>

        <!-- Brand Logo -->
        <a href="<?= url() ?>" class="site-logo-link" aria-label="Homepage">
          <img src="assets/images/logo.svg" alt="Logo" class="site-logo-img">
        </a>

        <!-- Search Bar -->
        <div class="header-search-wrapper">
          <form class="header-search-form" id="headerSearchForm" action="<?= url('category') ?>" method="GET">
            <input 
              type="text" 
              name="q" 
              class="header-search-input" 
              id="headerSearchInput" 
              placeholder="Search entire store here..." 
              autocomplete="off"
            >
            <button type="submit" class="header-search-btn" aria-label="Search">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
              </svg>
            </button>
          </form>
        </div>

        <!-- Right Side Icons (Account, Cart) -->
        <div class="header-user-actions">
          <!-- Account Icon -->
          <a href="<?= url('my-account') ?>" class="header-action-btn" aria-label="My Account" title="My Account">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
          </a>

          <!-- Cart Icon with Badge -->
          <a href="cart.php" class="header-action-btn" id="headerCartBtn" aria-label="Shopping Cart" title="Shopping Cart">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="9" cy="21" r="1"></circle>
              <circle cx="20" cy="21" r="1"></circle>
              <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            <span class="header-cart-badge">0</span>
          </a>
        </div>

      </div>
    </div>
  </header>

  <!-- ==========================================
       CATEGORY NAVIGATION MENU
       ========================================== -->
  <nav class="site-nav-bar" aria-label="Main Navigation">
    <div class="container nav-container">
      <ul class="nav-menu-list">
        <?php foreach ($mainMenuTree as $item): 
          $hasChildren = !empty($item['children']);
          $columns = $hasChildren ? array_values(array_filter($item['children'], fn($c) => $c['link_type'] === 'mega_menu_column')) : [];
          $promos = $hasChildren ? array_values(array_filter($item['children'], fn($c) => $c['link_type'] === 'promo_banner')) : [];
          $otherLinks = $hasChildren ? array_values(array_filter($item['children'], fn($c) => $c['link_type'] !== 'mega_menu_column' && $c['link_type'] !== 'promo_banner')) : [];
          $isMegaMenu = !empty($columns) || !empty($promos);
          $isDropdown = $hasChildren && !$isMegaMenu;
        ?>
          <?php if ($isMegaMenu): 
            $colCount = count($columns);
            $gridClass = 'megamenu-grid';
            if ($colCount >= 4) {
              $gridClass = strtolower(trim($item['title'])) === 'brands' ? 'megamenu-grid megamenu-grid-brands' : 'megamenu-grid megamenu-grid-4';
            } elseif (strtolower(trim($item['title'])) === 'e-liquids') {
              $gridClass = 'megamenu-grid megamenu-grid-eliquid';
            }
          ?>
            <li class="nav-menu-item has-megamenu">
              <a href="<?= htmlspecialchars($formatNavUrl($item['link_value'] ?? '#')) ?>" class="nav-menu-link">
                <?= htmlspecialchars($item['title']) ?>
                <svg class="nav-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </a>
              <div class="megamenu-panel">
                <div class="megamenu-inner">
                  <div class="<?= $gridClass ?>">
                    <?php foreach ($columns as $col): ?>
                      <div class="megamenu-col">
                        <h4 class="megamenu-title"><?= htmlspecialchars($col['title']) ?></h4>
                        <?php if (!empty($col['children'])): ?>
                          <ul class="megamenu-links">
                            <?php foreach ($col['children'] as $link): 
                              $isHl = (!empty($link['subtitle']) && stripos($link['subtitle'], 'highlight') !== false) || 
                                      (stripos($link['title'], 'shop all') !== false) || 
                                      (stripos($link['title'], 'view all') !== false);
                            ?>
                              <li>
                                <a href="<?= htmlspecialchars($formatNavUrl($link['link_value'] ?? '#')) ?>" class="<?= $isHl ? 'megamenu-highlight-link' : '' ?>">
                                  <?= htmlspecialchars($link['title']) ?>
                                </a>
                              </li>
                            <?php endforeach; ?>
                          </ul>
                        <?php endif; ?>
                      </div>
                    <?php endforeach; ?>

                    <?php foreach ($promos as $promo): ?>
                      <div class="megamenu-promo-col">
                        <a href="<?= htmlspecialchars($formatNavUrl($promo['link_value'] ?? '#')) ?>" class="megamenu-promo-link" style="position: relative; display: block; overflow: hidden; border-radius: var(--radius-md);">
                          <?php if (!empty($promo['image_url'])): ?>
                            <img src="<?= htmlspecialchars($formatNavUrl($promo['image_url'])) ?>" alt="<?= htmlspecialchars($promo['title']) ?>" class="megamenu-promo-img">
                          <?php endif; ?>
                          <?php if (!empty($promo['subtitle'])): ?>
                            <div class="megamenu-promo-overlay" style="position: absolute; bottom: 0; left: 0; right: 0; padding: 14px 16px; background: linear-gradient(to top, rgba(15, 23, 42, 0.92) 0%, rgba(15, 23, 42, 0.55) 60%, transparent 100%); color: #fff;">
                              <span style="display: inline-block; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; background: #5c56e8; color: #fff; padding: 2px 7px; border-radius: 4px; margin-bottom: 4px;">Featured Offer</span>
                              <div style="font-weight: 700; font-size: 14px; color: #fff; line-height: 1.25;"><?= htmlspecialchars($promo['title']) ?></div>
                              <div style="font-size: 11.5px; color: #cbd5e1; margin-top: 3px; font-weight: 400;"><?= htmlspecialchars($promo['subtitle']) ?></div>
                            </div>
                          <?php endif; ?>
                        </a>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </li>
          <?php elseif ($isDropdown): ?>
            <li class="nav-menu-item has-dropdown">
              <a href="<?= htmlspecialchars($formatNavUrl($item['link_value'] ?? '#')) ?>" class="nav-menu-link">
                <?= htmlspecialchars($item['title']) ?>
                <svg class="nav-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </a>
              <ul class="nav-dropdown">
                <?php foreach ($otherLinks as $child): 
                  $isHl = (!empty($child['subtitle']) && stripos($child['subtitle'], 'highlight') !== false) || 
                          (stripos($child['title'], 'shop all') !== false);
                ?>
                  <li>
                    <a href="<?= htmlspecialchars($formatNavUrl($child['link_value'] ?? '#')) ?>" class="nav-dropdown-link <?= $isHl ? 'dropdown-highlight-link' : '' ?>">
                      <?= htmlspecialchars($child['title']) ?>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            </li>
          <?php else: ?>
            <li class="nav-menu-item">
              <a href="<?= htmlspecialchars($formatNavUrl($item['link_value'] ?? '#')) ?>" class="nav-menu-link">
                <?= htmlspecialchars($item['title']) ?>
              </a>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </nav>

  <!-- ==========================================
       MOBILE NAVIGATION DRAWER & BACKDROP
       ========================================== -->
  <div class="mobile-nav-backdrop" id="mobileNavBackdrop"></div>
  <aside class="mobile-nav-drawer" id="mobileNavDrawer">
    <div class="mobile-drawer-header">
      <img src="assets/images/logo.svg" alt="Logo" style="height: 32px;">
      <button class="mobile-drawer-close" id="mobileNavClose" aria-label="Close menu">
        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>
    <div class="mobile-drawer-body">
      <ul class="mobile-drawer-list">
        <?php foreach ($mainMenuTree as $item): 
          $hasChildren = !empty($item['children']);
          $columns = $hasChildren ? array_values(array_filter($item['children'], fn($c) => $c['link_type'] === 'mega_menu_column')) : [];
          $promos = $hasChildren ? array_values(array_filter($item['children'], fn($c) => $c['link_type'] === 'promo_banner')) : [];
          $otherLinks = $hasChildren ? array_values(array_filter($item['children'], fn($c) => $c['link_type'] !== 'mega_menu_column' && $c['link_type'] !== 'promo_banner')) : [];
        ?>
          <?php if ($hasChildren): ?>
            <li class="mobile-nav-item has-dropdown">
              <button type="button" class="mobile-dropdown-btn" aria-expanded="false">
                <span><?= htmlspecialchars($item['title']) ?></span>
                <svg class="mobile-chevron-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </button>
              <div class="mobile-submenu-collapse">
                <div class="mobile-submenu-inner">
                  <?php if (!empty($item['link_value']) && $item['link_value'] !== '#'): ?>
                    <a href="<?= htmlspecialchars($formatNavUrl($item['link_value'])) ?>" class="mobile-submenu-link highlight">
                      Shop All <?= htmlspecialchars($item['title']) ?> &rarr;
                    </a>
                  <?php endif; ?>

                  <!-- Columns with Sub-links -->
                  <?php foreach ($columns as $col): ?>
                    <div class="mobile-subgroup">
                      <h4 class="mobile-subgroup-title"><?= htmlspecialchars($col['title']) ?></h4>
                      <?php if (!empty($col['children'])): ?>
                        <ul class="mobile-subgroup-list">
                          <?php foreach ($col['children'] as $sub): 
                            $isHl = (!empty($sub['subtitle']) && stripos($sub['subtitle'], 'highlight') !== false) || 
                                    (stripos($sub['title'], 'shop all') !== false) || 
                                    (stripos($sub['title'], 'view all') !== false);
                          ?>
                            <li>
                              <a href="<?= htmlspecialchars($formatNavUrl($sub['link_value'] ?? '#')) ?>" class="mobile-submenu-link <?= $isHl ? 'highlight' : '' ?>">
                                <?= htmlspecialchars($sub['title']) ?>
                              </a>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                      <?php endif; ?>
                    </div>
                  <?php endforeach; ?>

                  <!-- Direct Sub-links (Dropdown items like Pouches, Hemp) -->
                  <?php if (!empty($otherLinks)): ?>
                    <div class="mobile-subgroup">
                      <ul class="mobile-subgroup-list">
                        <?php foreach ($otherLinks as $child): 
                          $isHl = (!empty($child['subtitle']) && stripos($child['subtitle'], 'highlight') !== false) || 
                                  (stripos($child['title'], 'shop all') !== false);
                        ?>
                          <li>
                            <a href="<?= htmlspecialchars($formatNavUrl($child['link_value'] ?? '#')) ?>" class="mobile-submenu-link <?= $isHl ? 'highlight' : '' ?>">
                              <?= htmlspecialchars($child['title']) ?>
                            </a>
                          </li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                  <?php endif; ?>

                  <!-- Promotional Banners in Mobile Drawer -->
                  <?php foreach ($promos as $promo): ?>
                    <div class="mobile-promo-banner-wrap" style="margin: 12px 0 6px; border-radius: 8px; overflow: hidden; border: 1px solid #e2e8f0; background: #fff; box-shadow: 0 2px 6px rgba(0,0,0,0.04);">
                      <a href="<?= htmlspecialchars($formatNavUrl($promo['link_value'] ?? '#')) ?>" style="display: block; text-decoration: none;">
                        <?php if (!empty($promo['image_url'])): ?>
                          <img src="<?= htmlspecialchars($formatNavUrl($promo['image_url'])) ?>" alt="<?= htmlspecialchars($promo['title']) ?>" style="width: 100%; height: 110px; object-fit: cover; display: block;">
                        <?php endif; ?>
                        <div style="padding: 10px 12px; background: #f8fafc;">
                          <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px;">
                            <span style="font-weight: 700; font-size: 13px; color: #1e293b;"><?= htmlspecialchars($promo['title']) ?></span>
                            <span style="font-size: 10px; font-weight: 700; text-transform: uppercase; background: #5c56e8; color: #fff; padding: 2px 6px; border-radius: 4px;">Offer</span>
                          </div>
                          <?php if (!empty($promo['subtitle'])): ?>
                            <div style="font-size: 11px; color: #64748b; margin-top: 3px;"><?= htmlspecialchars($promo['subtitle']) ?></div>
                          <?php endif; ?>
                        </div>
                      </a>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </li>
          <?php else: ?>
            <li class="mobile-nav-item">
              <a href="<?= htmlspecialchars($formatNavUrl($item['link_value'] ?? '#')) ?>" class="mobile-direct-link">
                <?= htmlspecialchars($item['title']) ?>
              </a>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </aside>

  <!-- Main Content Wrapper Starts -->
  <main class="site-main-content">
