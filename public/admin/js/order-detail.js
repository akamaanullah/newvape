/**
 * New Vape - Order Detail JavaScript
 * Handles invoice printing, tracking number management, and fulfillment status updates
 */

document.addEventListener('DOMContentLoaded', () => {
  // Print Invoice Button
  const printInvoiceBtn = document.getElementById('btnPrintInvoice');
  if (printInvoiceBtn) {
    printInvoiceBtn.addEventListener('click', () => {
      window.print();
    });
  }

  // Tracking Number Form Action
  const trackingForm = document.getElementById('trackingNumberForm');
  if (trackingForm) {
    trackingForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const input = trackingForm.querySelector('input[name="tracking_number"]');
      if (input && input.value.trim()) {
        const badge = document.getElementById('fulfillmentBadge');
        if (badge) {
          badge.className = 'badge-status badge-shipped';
          badge.textContent = 'Shipped';
        }
      }
    });
  }
});
