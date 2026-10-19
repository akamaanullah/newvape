/**
 * New Vape - Collections Listing JavaScript
 * Handles live search filtering, pagination, and bulk selection
 */

document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('adminTableSearch');
  const table = document.getElementById('collectionsTable');
  const rows = table ? table.querySelectorAll('tbody tr') : [];
  const counterText = document.querySelector('.table-counter-text strong');

  // Real-time live table filter
  if (searchInput && rows.length > 0) {
    searchInput.addEventListener('input', function() {
      const q = this.value.toLowerCase().trim();
      let visibleCount = 0;

      rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        if (text.includes(q)) {
          row.style.display = '';
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      });

      if (counterText) {
        counterText.textContent = visibleCount;
      }
    });
  }

  // Master Select All Collections
  const selectAllCollections = document.getElementById('selectAllCollections');
  if (selectAllCollections) {
    selectAllCollections.addEventListener('change', function() {
      document.querySelectorAll('.collection-checkbox').forEach(cb => {
        cb.checked = selectAllCollections.checked;
      });
    });
  }
});
