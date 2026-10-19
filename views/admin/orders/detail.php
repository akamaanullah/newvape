<?php
$order_id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '104820';
$page_title = 'Order #' . $order_id;
$current_admin_page = 'orders';
$page_script = 'order-detail.js';
include dirname(__DIR__) . '/includes/header.php';
?>

<!-- Title & Action Bar -->
<div class="page-title-bar">
  <div class="page-heading-group">
    <div class="d-flex align-center gap-md">
      <a href="<?= url('admin/orders') ?>" class="btn-icon-only" title="Back to Orders">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="19" y1="12" x2="5" y2="12"></line>
          <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
      </a>
      <h1>Order #VH-<?php echo $order_id; ?></h1>
      <span class="badge-status badge-completed">Completed</span>
    </div>
    <p class="page-subtitle">Placed on September 21, 2026 at 02:45 PM • Paid via Credit Card</p>
  </div>
  <div class="page-actions-group">
    <button type="button" class="btn-admin btn-admin-secondary" onclick="window.print()">
      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="6 9 6 2 18 2 18 9"></polyline>
        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
        <rect x="6" y="14" width="12" height="8"></rect>
      </svg>
      <span>Print Invoice</span>
    </button>
  </div>
</div>

<div class="detail-grid-layout">
  
  <!-- Left Side: Order Items & Financial Summary -->
  <div class="admin-col-main">
    
    <!-- Ordered Items Card -->
    <div class="admin-card">
      <div class="admin-card-header">
        <h2 class="admin-card-title">Order Items (2)</h2>
      </div>
      <div class="admin-card-body p-0">
        <div class="table-responsive">
          <table class="admin-table">
            <thead>
              <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th class="text-right">Total</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="table-product-cell">
                    <img src="../assets/images/product-1.webp" alt="Juice Head Salt" class="table-product-thumb">
                    <div class="table-product-info">
                      <span class="table-product-title">Juice Head Salt x Vaporesso 50K Bundle – Device + Juice 30mL</span>
                      <span class="table-product-meta">Flavor: Peach Pear • Strength: 50mg</span>
                    </div>
                  </div>
                </td>
                <td>$29.99</td>
                <td>1</td>
                <td class="text-right"><strong>$29.99</strong></td>
              </tr>
              <tr>
                <td>
                  <div class="table-product-cell">
                    <img src="../assets/images/most-popular-1.webp" alt="Geek Bar Pulse" class="table-product-thumb">
                    <div class="table-product-info">
                      <span class="table-product-title">Geek Bar Pulse 15K Disposable</span>
                      <span class="table-product-meta">Flavor: Watermelon Ice • Strength: 50mg</span>
                    </div>
                  </div>
                </td>
                <td>$14.99</td>
                <td>1</td>
                <td class="text-right"><strong>$14.99</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Financial Breakdown Card -->
    <div class="admin-card">
      <div class="admin-card-header">
        <h2 class="admin-card-title">Order Financials</h2>
      </div>
      <div class="admin-card-body">
        <div class="info-list-group">
          <div class="info-list-item">
            <span class="info-list-label">Items Subtotal</span>
            <span class="info-list-val">$44.98</span>
          </div>
          <div class="info-list-item">
            <span class="info-list-label">Discount (VAPOR10 applied)</span>
            <span class="info-list-val text-success">-$0.00</span>
          </div>
          <div class="info-list-item">
            <span class="info-list-label">Shipping (Standard Ground)</span>
            <span class="info-list-val">$5.99</span>
          </div>
          <div class="info-list-item">
            <span class="info-list-label">Estimated Sales Tax (4.5%)</span>
            <span class="info-list-val">$2.02</span>
          </div>
          <div class="info-list-item info-grand-total-row">
            <span class="info-list-label grand-total-label">Grand Total Paid</span>
            <span class="info-list-val grand-total-val">$52.99</span>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Right Side: Customer Details & Fulfillment Controls -->
  <div class="admin-col-side">
    
    <!-- Fulfillment & Status Card -->
    <div class="admin-card">
      <div class="admin-card-header">
        <h2 class="admin-card-title">Order Status &amp; Tracking</h2>
      </div>
      <div class="admin-card-body">
        <form class="admin-ajax-form" onsubmit="return false;">
          
          <div class="admin-form-group">
            <label for="orderStatusSelect" class="admin-form-label">Order Status</label>
            <select id="orderStatusSelect" class="admin-form-select">
              <option value="completed" selected>Completed</option>
              <option value="processing">Processing</option>
              <option value="shipped">Shipped</option>
              <option value="pending">Pending</option>
              <option value="cancelled">Cancelled</option>
            </select>
          </div>

          <div class="admin-form-group">
            <label for="trackingNumberInput" class="admin-form-label">Tracking Number (UPS Adult 21+)</label>
            <input type="text" id="trackingNumberInput" class="admin-form-input" value="1Z9999999999999999">
          </div>

          <button type="submit" class="btn-admin btn-admin-primary btn-full-width">Update Order</button>
        </form>
      </div>
    </div>

    <!-- Customer Profile Card -->
    <div class="admin-card">
      <div class="admin-card-header">
        <h2 class="admin-card-title">Customer Information</h2>
        <a href="<?= url('admin/customer-detail') ?>?id=1" class="btn-admin btn-admin-secondary btn-admin-sm">View Profile</a>
      </div>
      <div class="admin-card-body">
        <div class="table-customer-cell customer-card-header-user">
          <div class="table-customer-avatar customer-avatar-lg">JD</div>
          <div>
            <strong class="customer-detail-name">John Doe</strong>
            <div class="customer-since-meta">Customer since Sep 2026</div>
          </div>
        </div>

        <div class="info-list-group">
          <div class="info-list-item">
            <span class="info-list-label">Email</span>
            <span class="info-list-val"><a href="mailto:johndoe@gmail.com" class="link-primary">johndoe@gmail.com</a></span>
          </div>
          <div class="info-list-item">
            <span class="info-list-label">Phone</span>
            <span class="info-list-val">(405) 555-0199</span>
          </div>
          <div class="info-list-item">
            <span class="info-list-label">Age Verified</span>
            <span class="info-list-val text-success">✓ 21+ Confirmed</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Shipping & Billing Address Card -->
    <div class="admin-card">
      <div class="admin-card-header">
        <h2 class="admin-card-title">Shipping &amp; Billing</h2>
      </div>
      <div class="admin-card-body">
        <div class="address-block">
          <div class="address-title">Shipping Address</div>
          <p class="address-text">
            John Doe<br>
            10800 S Penn Ave, Suite 16 #827<br>
            Oklahoma City, OK 73170<br>
            United States
          </p>
        </div>

        <div>
          <div class="address-title">Billing Address</div>
          <p class="address-text-muted">Same as shipping address</p>
        </div>
      </div>
    </div>

  </div>

</div>

<?php
include dirname(__DIR__) . '/includes/footer.php';
?>
