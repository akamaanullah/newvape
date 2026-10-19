/**
 * New Vape - Customers Listing JavaScript
 * Handles customers directory real-time search, per-page filtering, and pagination
 */

document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('adminTableSearch');
  const perPageSelect = document.getElementById('adminPerPageSelect');
  const rows = Array.from(document.querySelectorAll('.customer-row'));
  const totalCountEl = document.getElementById('customerTotalCount');
  const startEl = document.querySelector('.pagination-start');
  const endEl = document.querySelector('.pagination-end');
  const totalEl = document.querySelector('.pagination-total');
  const prevBtn = document.getElementById('prevPageBtn');
  const nextBtn = document.getElementById('nextPageBtn');
  const pagesWrap = document.getElementById('paginationPagesWrap');

  let currentPage = 1;
  let perPage = parseInt(perPageSelect ? perPageSelect.value : 10, 10);
  let filteredRows = [...rows];

  function updatePagination() {
    const total = filteredRows.length;
    const totalPages = Math.ceil(total / perPage) || 1;

    if (currentPage > totalPages) {
      currentPage = totalPages;
    }
    if (currentPage < 1) {
      currentPage = 1;
    }

    const startIdx = (currentPage - 1) * perPage;
    const endIdx = startIdx + perPage;

    // Show/hide rows
    rows.forEach(r => (r.style.display = 'none'));
    filteredRows.slice(startIdx, endIdx).forEach(r => (r.style.display = ''));

    // Update counter labels
    if (startEl) startEl.textContent = total > 0 ? (startIdx + 1) : 0;
    if (endEl) endEl.textContent = Math.min(endIdx, total);
    if (totalEl) totalEl.textContent = total;
    if (totalCountEl) totalCountEl.textContent = total;

    // Prev / Next button states
    if (prevBtn) prevBtn.disabled = currentPage <= 1;
    if (nextBtn) nextBtn.disabled = currentPage >= totalPages;

    // Numbered pagination buttons
    if (pagesWrap) {
      pagesWrap.innerHTML = '';
      for (let i = 1; i <= totalPages; i++) {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = `page-num ${i === currentPage ? 'active' : ''}`;
        btn.textContent = i;
        btn.addEventListener('click', () => {
          currentPage = i;
          updatePagination();
        });
        pagesWrap.appendChild(btn);
      }
    }
  }

  function filterCustomers() {
    const query = (searchInput ? searchInput.value : '').toLowerCase().trim();

    filteredRows = rows.filter(row => {
      if (!query) return true;
      const name = row.getAttribute('data-name') || '';
      const email = row.getAttribute('data-email') || '';
      const location = row.getAttribute('data-location') || '';
      return name.includes(query) || email.includes(query) || location.includes(query);
    });

    currentPage = 1;
    updatePagination();
  }

  if (searchInput) {
    searchInput.addEventListener('input', filterCustomers);
  }

  if (perPageSelect) {
    perPageSelect.addEventListener('change', () => {
      perPage = parseInt(perPageSelect.value, 10);
      currentPage = 1;
      updatePagination();
    });
  }

  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      if (currentPage > 1) {
        currentPage--;
        updatePagination();
      }
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      const totalPages = Math.ceil(filteredRows.length / perPage) || 1;
      if (currentPage < totalPages) {
        currentPage++;
        updatePagination();
      }
    });
  }

  // Initialize
  updatePagination();
});
