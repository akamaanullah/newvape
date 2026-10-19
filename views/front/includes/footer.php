<?php
/**
 * NEW VAPE - GLOBAL FOOTER
 * Included on all pages. Closes main tag and loads scripts.
 */
?>
  </main>
  <!-- Main Content Wrapper Ends -->

  <!-- ==========================================
       GLOBAL SITE FOOTER
       ========================================== -->
  <footer class="site-footer-modern">

    <!-- 1. Top Bar: Help & Socials -->
    <div class="footer-top-bar">
      <div class="container">
        <div class="footer-top-inner">
          
          <!-- Left: Need Help Info -->
          <div class="footer-help-wrap">
            <div class="footer-help-icon">
              <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
              </svg>
            </div>
            <div class="footer-help-text">
              <h3 class="footer-help-title">Need help? We're here for you</h3>
              <p class="footer-help-desc">Check our <a href="<?= url('faq') ?>">FAQ</a>, <a href="<?= url('track-order') ?>">track your order</a> or <a href="<?= url('contact') ?>">contact us</a>. We're happy to help!</p>
            </div>
          </div>

          <!-- Right: Follow Us & Social Icons -->
          <div class="footer-social-wrap">
            <span class="footer-social-label">Follow us</span>
            <div class="footer-social-icons">
              <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="Facebook">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
              </a>
              <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="Instagram">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
              </a>
              <a href="https://tiktok.com" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="TikTok">
                <svg viewBox="0 0 24 24" width="15" height="15" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 3 15.68a6.34 6.34 0 0 0 6.34 6.32 6.34 6.34 0 0 0 6.35-6.32V8.62a8.3 8.3 0 0 0 4.9 1.58V6.75a4.85 4.85 0 0 1-1-.06z"></path></svg>
              </a>
              <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="YouTube">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33zM9.75 15.02V8.48l5.75 3.27-5.75 3.27z"></path></svg>
              </a>
              <a href="https://x.com" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="X">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></svg>
              </a>
              <a href="https://pinterest.com" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="Pinterest">
                <svg viewBox="0 0 24 24" width="15" height="15" fill="currentColor"><path d="M12 0a12 12 0 0 0-4.37 23.18c-.05-.98-.1-2.48.02-3.55l1.04-4.42s-.26-.52-.26-1.3c0-1.22.7-2.13 1.59-2.13.75 0 1.11.56 1.11 1.24 0 .76-.48 1.89-.73 2.94-.21.88.44 1.6 1.3 1.6 1.57 0 2.78-1.65 2.78-4.04 0-2.11-1.52-3.59-3.69-3.59-2.51 0-3.99 1.89-3.99 3.84 0 .76.29 1.58.66 2.02.07.09.08.17.06.26l-.25 1.02c-.04.16-.14.2-.32.12-1.18-.55-1.92-2.27-1.92-3.65 0-2.98 2.16-5.71 6.24-5.71 3.28 0 5.82 2.34 5.82 5.46 0 3.26-2.05 5.88-4.9 5.88-.96 0-1.86-.5-2.17-1.09l-.59 2.26c-.22.84-.8 1.89-1.2 2.52A12 12 0 1 0 12 0z"></path></svg>
              </a>
              <a href="contact.php" class="footer-social-btn" aria-label="Community">
                <svg viewBox="0 0 24 24" width="15" height="15" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"></path></svg>
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- 2. Newsletter Section with Logo on Left and Centered Subscription -->
    <div class="footer-newsletter-section">
      <div class="container">
        <div class="footer-newsletter-grid">
          
          <!-- Left: Brand Logo (Aligned with Left Column) -->
          <div class="footer-newsletter-logo-col">
            <a href="<?= url() ?>" class="footer-brand-logo-link" aria-label="Homepage">
              <img src="assets/images/logo.svg" alt="Logo" class="footer-brand-logo-img">
            </a>
          </div>

          <!-- Center: Newsletter Content & Form (Strictly Centered) -->
          <div class="footer-newsletter-content-col">
            <h3 class="footer-newsletter-title">Be the first to know</h3>
            <p class="footer-newsletter-desc">Get exclusive deals, new product alerts &amp; vape news.</p>
            <form class="footer-newsletter-form" action="javascript:void(0)" method="POST" onsubmit="event.preventDefault(); alert('Thank you for subscribing!');">
              <input type="email" placeholder="Enter your email address" class="newsletter-input" required>
              <button type="submit" class="newsletter-btn">Subscribe</button>
            </form>
          </div>

          <!-- Right: Spacer (Ensures Center stays mathematically centered) -->
          <div class="footer-newsletter-spacer" aria-hidden="true"></div>

        </div>
      </div>
    </div>

    <!-- 3. Navigation Links Columns -->
    <div class="footer-links-section">
      <div class="container">
        <div class="footer-columns-grid">
          
          <!-- Col 1: Shop -->
          <div class="footer-col">
            <h4 class="footer-col-title">Shop</h4>
            <ul class="footer-col-list">
              <li><a href="<?= url('category') ?>?cat=disposables">Disposables</a></li>
              <li><a href="<?= url('category') ?>?cat=eliquids">E-Liquids</a></li>
              <li><a href="<?= url('category') ?>?cat=pouches">Nicotine Pouches</a></li>
              <li><a href="<?= url('category') ?>?cat=hemp-thc">Hemp &amp; CBD</a></li>
              <li><a href="shop.php?filter=new">New Arrivals</a></li>
              <li><a href="shop.php?filter=bestsellers">Best Sellers</a></li>
            </ul>
          </div>

          <!-- Col 2: Customer Service -->
          <div class="footer-col">
            <h4 class="footer-col-title">Customer Service</h4>
            <ul class="footer-col-list">
              <li><a href="shipping.php">Shipping Information</a></li>
              <li><a href="returns.php">Returns &amp; Exchanges</a></li>
              <li><a href="faq.php">FAQ</a></li>
              <li><a href="contact.php">Contact Us</a></li>
              <li><a href="track-order.php">Track Your Order</a></li>
            </ul>
          </div>

          <!-- Col 3: About Us -->
          <div class="footer-col">
            <h4 class="footer-col-title">About Us</h4>
            <ul class="footer-col-list">
              <li><a href="about.php">About Us</a></li>
              <li><a href="<?= url('blog') ?>">Blog</a></li>
              <li><a href="age-verification.php">Age Verification</a></li>
            </ul>
          </div>

          <!-- Col 4: My Account -->
          <div class="footer-col">
            <h4 class="footer-col-title">My Account</h4>
            <ul class="footer-col-list">
              <li><a href="<?= url('my-account') ?>">Sign In</a></li>
              <li><a href="my-account.php?action=register">Create an Account</a></li>
              <li><a href="my-account.php?tab=orders">Order History</a></li>
            </ul>
          </div>

        </div>

        <!-- 4. Trust Badges Row -->
        <div class="footer-trust-badges">
          <div class="footer-trust-item">
            <svg class="trust-check-icon" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            <span>Authentic Products</span>
          </div>
          <div class="footer-trust-item">
            <svg class="trust-check-icon" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            <span>Fast Shipping</span>
          </div>
          <div class="footer-trust-item">
            <svg class="trust-check-icon" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            <span>Secure Payment</span>
          </div>
          <div class="footer-trust-item">
            <svg class="trust-check-icon" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            <span>21+ Age Verified</span>
          </div>
        </div>

        <!-- 5. Payment Methods Row -->
        <div class="footer-payment-methods">
          <!-- Visa -->
          <div class="payment-card-badge" title="Visa">
            <span class="visa-badge-text">VISA</span>
          </div>
          <!-- AMEX -->
          <div class="payment-card-badge amex-badge" title="American Express">
            <span class="amex-badge-text">AMERICAN<br>EXPRESS</span>
          </div>
          <!-- Discover -->
          <div class="payment-card-badge discover-badge" title="Discover">
            <span class="discover-badge-text">DISCOVER</span>
          </div>
        </div>

      </div>
    </div>

    <!-- 6. Bottom Copyright & Legal Links -->
    <div class="footer-bottom-bar">
      <div class="container">
        <div class="footer-bottom-inner">
          <p class="footer-copy-text">&copy; <?php echo date('Y'); ?> All rights reserved.</p>
          <div class="footer-legal-links">
            <a href="<?= url('terms') ?>">Terms &amp; Conditions</a>
            <a href="<?= url('privacy') ?>">Privacy Policy</a>
            <a href="<?= url('shipping') ?>">Shipping Policy</a>
            <a href="<?= url('cookies') ?>">Cookie Policy</a>
          </div>
        </div>
      </div>
    </div>

  </footer>

  <!-- Global Slide-Out Cart Drawer Component -->
  <?php include __DIR__ . '/cart-drawer.php'; ?>

  <!-- Global Cart Drawer JavaScript -->
  <script src="assets/js/cart-drawer.js?v=<?php echo time(); ?>"></script>

  <!-- Global JavaScript -->
  <script src="assets/js/main.js?v=<?php echo time(); ?>"></script>

  <!-- Page Specific JavaScript (if defined) -->
  <?php if (!empty($page_js)): ?>
    <script src="assets/js/<?php echo htmlspecialchars($page_js); ?>.js?v=<?php echo time(); ?>"></script>
  <?php endif; ?>

</body>
</html>
