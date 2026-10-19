/**
 * New Vape - Products Listing JavaScript
 * Handles products table bulk actions, quick status toggles, and catalog management
 */

document.addEventListener('DOMContentLoaded', () => {
  // Master Select All Products
  const selectAllProducts = document.getElementById('selectAllProducts');
  if (selectAllProducts) {
    selectAllProducts.addEventListener('change', function() {
      document.querySelectorAll('.product-checkbox').forEach(cb => {
        cb.checked = selectAllProducts.checked;
      });
    });
  }
});
