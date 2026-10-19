/**
 * New Vape - Orders Listing JavaScript
 * Handles orders table filtering, selection, and status updates
 */

document.addEventListener('DOMContentLoaded', () => {
  // Master Select All Orders if needed
  const selectAllOrders = document.getElementById('selectAllOrders');
  if (selectAllOrders) {
    selectAllOrders.addEventListener('change', function() {
      document.querySelectorAll('.order-checkbox').forEach(cb => {
        cb.checked = selectAllOrders.checked;
      });
    });
  }
});
