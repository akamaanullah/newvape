/**
 * New Vape - Inventory Management Interactive JavaScript
 * Real-time stock adjustment calculation, expandable variant tree rows,
 * single & batch AJAX updates, live search, and status filtering.
 */

document.addEventListener('DOMContentLoaded', () => {
  const tableBody = document.getElementById('inventoryTableBody');
  const btnSaveAll = document.getElementById('btnSaveAllAdjustments');
  const searchInput = document.getElementById('invSearchInput');
  const statusFilter = document.getElementById('invStatusFilter');
  const rowsPerPageSelect = document.getElementById('invRowsPerPage');
  const selectAllCheckbox = document.getElementById('selectAllInv');

  // ==========================================================================
  // 1. Expand / Collapse Variant Tree Rows
  // ==========================================================================
  document.addEventListener('click', (e) => {
    const chevronBtn = e.target.closest('.inv-chevron-btn');
    if (chevronBtn) {
      e.stopPropagation();
      const targetGroup = chevronBtn.getAttribute('data-target');
      if (targetGroup) {
        const childRows = document.querySelectorAll(`.${targetGroup}`);
        const isOpening = !chevronBtn.classList.contains('open');

        chevronBtn.classList.toggle('open', isOpening);
        childRows.forEach(row => {
          row.classList.toggle('show', isOpening);
        });
      }
      return;
    }

    // Clicking parent product cell to expand
    const parentCell = e.target.closest('.inv-product-cell');
    if (parentCell && !e.target.closest('input') && !e.target.closest('button')) {
      const parentRow = parentCell.closest('.inv-parent-row');
      if (parentRow) {
        const rowBtn = parentRow.querySelector('.inv-chevron-btn');
        if (rowBtn) rowBtn.click();
      }
    }
  });

  // Open the first few groups by default for convenience
  const firstChevrons = document.querySelectorAll('.inv-parent-row:nth-child(-n+4) .inv-chevron-btn');
  firstChevrons.forEach(btn => btn.click());

  // ==========================================================================
  // 2. Real-time Live Adjustment Calculation
  // ==========================================================================
  function updateRowAdjustment(input) {
    const current = parseInt(input.getAttribute('data-current') || '0', 10);
    const adj = parseInt(input.value || '0', 10);
    const newStockVal = Math.max(0, current + adj);

    const type = input.getAttribute('data-type');
    const id = input.getAttribute('data-id');

    let newStockEl = null;
    if (type === 'variant') {
      newStockEl = document.getElementById(`new-stock-var-${id}`);
    } else {
      newStockEl = document.getElementById(`new-stock-prod-${id}`);
    }

    if (newStockEl) {
      newStockEl.textContent = newStockVal;
      if (adj !== 0) {
        newStockEl.classList.add('changed');
      } else {
        newStockEl.classList.remove('changed');
      }
    }

    checkHasPendingAdjustments();
  }

  function checkHasPendingAdjustments() {
    const allInputs = document.querySelectorAll('.inv-adj-input');
    let hasPending = false;
    allInputs.forEach(inp => {
      const val = parseInt(inp.value || '0', 10);
      if (val !== 0) {
        hasPending = true;
      }
    });

    if (btnSaveAll) {
      btnSaveAll.disabled = !hasPending;
    }
  }

  document.addEventListener('input', (e) => {
    if (e.target.classList.contains('inv-adj-input')) {
      updateRowAdjustment(e.target);
    }
  });

  // ==========================================================================
  // 3. Single Row "Apply" Button Handler (AJAX)
  // ==========================================================================
  document.addEventListener('click', async (e) => {
    const applyBtn = e.target.closest('.btn-inv-apply');
    if (!applyBtn) return;

    const row = applyBtn.closest('tr');
    if (!row) return;

    const input = row.querySelector('.inv-adj-input');
    if (!input) return;

    const type = input.getAttribute('data-type') || 'variant';
    const id = input.getAttribute('data-id');
    const adj = parseInt(input.value || '0', 10);

    if (adj === 0) {
      // Flash input briefly
      input.style.borderColor = '#f59e0b';
      setTimeout(() => input.style.borderColor = '', 600);
      return;
    }

    applyBtn.disabled = true;
    const originalText = applyBtn.textContent;
    applyBtn.textContent = '...';

    try {
      const response = await fetch('admin/inventory/update', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
          adjustments: [{ type, id, adjustment: adj }]
        })
      });

      const data = await response.json();

      if (data && data.success) {
        // Success: update current stock display & attributes
        const currentStock = parseInt(input.getAttribute('data-current') || '0', 10);
        const newStock = Math.max(0, currentStock + adj);

        input.setAttribute('data-current', newStock);
        input.value = 0;

        if (type === 'variant') {
          const curEl = document.getElementById(`current-stock-var-${id}`);
          if (curEl) curEl.textContent = newStock;
          const newEl = document.getElementById(`new-stock-var-${id}`);
          if (newEl) {
            newEl.textContent = newStock;
            newEl.classList.remove('changed');
          }

          // Recalculate parent product total
          const parentId = input.getAttribute('data-parent');
          if (parentId) {
            recalculateParentTotal(parentId);
          }
        } else {
          const curEl = document.getElementById(`parent-stock-${id}`);
          if (curEl) curEl.textContent = newStock;
          const newEl = document.getElementById(`new-stock-prod-${id}`);
          if (newEl) {
            newEl.textContent = newStock;
            newEl.classList.remove('changed');
          }
        }

        applyBtn.classList.add('applied');
        applyBtn.textContent = 'Saved ✓';
        setTimeout(() => {
          applyBtn.classList.remove('applied');
          applyBtn.textContent = originalText;
          applyBtn.disabled = false;
        }, 1500);

        checkHasPendingAdjustments();
      } else {
        alert(data.message || 'Failed to update stock.');
        applyBtn.textContent = originalText;
        applyBtn.disabled = false;
      }
    } catch (err) {
      console.error(err);
      alert('Error updating stock adjustment.');
      applyBtn.textContent = originalText;
      applyBtn.disabled = false;
    }
  });

  // Recalculate parent product current stock on the frontend
  function recalculateParentTotal(parentId) {
    const parentStockEl = document.getElementById(`parent-stock-${parentId}`);
    if (!parentStockEl) return;

    const childRows = document.querySelectorAll(`.inv-child-row.group-${parentId}`);
    let sum = 0;
    childRows.forEach(cr => {
      const inp = cr.querySelector('.inv-adj-input');
      if (inp) {
        sum += parseInt(inp.getAttribute('data-current') || '0', 10);
      }
    });

    parentStockEl.textContent = sum;
  }

  // ==========================================================================
  // 4. Batch "Save All Adjustments" Button Handler (AJAX)
  // ==========================================================================
  if (btnSaveAll) {
    btnSaveAll.addEventListener('click', async () => {
      const allInputs = document.querySelectorAll('.inv-adj-input');
      const adjustments = [];

      allInputs.forEach(inp => {
        const adj = parseInt(inp.value || '0', 10);
        if (adj !== 0) {
          adjustments.push({
            type: inp.getAttribute('data-type') || 'variant',
            id: inp.getAttribute('data-id'),
            adjustment: adj
          });
        }
      });

      if (adjustments.length === 0) return;

      btnSaveAll.disabled = true;
      const originalText = btnSaveAll.innerHTML;
      btnSaveAll.innerHTML = `
        <svg class="spin" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="10" stroke-opacity="0.25"></circle>
          <path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round"></path>
        </svg>
        <span>Saving changes...</span>
      `;

      try {
        const response = await fetch('admin/inventory/update', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: JSON.stringify({ adjustments })
        });

        const data = await response.json();

        if (data && data.success) {
          // Update all inputs
          allInputs.forEach(inp => {
            const adj = parseInt(inp.value || '0', 10);
            if (adj !== 0) {
              const current = parseInt(inp.getAttribute('data-current') || '0', 10);
              const newStock = Math.max(0, current + adj);
              const type = inp.getAttribute('data-type');
              const id = inp.getAttribute('data-id');

              inp.setAttribute('data-current', newStock);
              inp.value = 0;

              if (type === 'variant') {
                const curEl = document.getElementById(`current-stock-var-${id}`);
                if (curEl) curEl.textContent = newStock;
                const newEl = document.getElementById(`new-stock-var-${id}`);
                if (newEl) {
                  newEl.textContent = newStock;
                  newEl.classList.remove('changed');
                }
              } else {
                const curEl = document.getElementById(`parent-stock-${id}`);
                if (curEl) curEl.textContent = newStock;
                const newEl = document.getElementById(`new-stock-prod-${id}`);
                if (newEl) {
                  newEl.textContent = newStock;
                  newEl.classList.remove('changed');
                }
              }
            }
          });

          // Recalculate all parent stocks
          document.querySelectorAll('.inv-parent-row').forEach(pr => {
            const pid = pr.getAttribute('data-product-id');
            if (pid) recalculateParentTotal(pid);
          });

          // Show Toast Notification
          showInventoryToast('All inventory adjustments saved successfully!');

          btnSaveAll.innerHTML = `
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            <span>Saved!</span>
          `;

          setTimeout(() => {
            btnSaveAll.innerHTML = originalText;
            btnSaveAll.disabled = true;
          }, 1800);
        } else {
          alert(data.message || 'Error saving adjustments.');
          btnSaveAll.innerHTML = originalText;
          btnSaveAll.disabled = false;
        }
      } catch (err) {
        console.error(err);
        alert('Network error while saving adjustments.');
        btnSaveAll.innerHTML = originalText;
        btnSaveAll.disabled = false;
      }
    });
  }

  // Toast Notification
  function showInventoryToast(msg) {
    let toast = document.getElementById('invGlobalToast');
    if (!toast) {
      toast = document.createElement('div');
      toast.id = 'invGlobalToast';
      toast.style.cssText = `
        position: fixed;
        bottom: 24px;
        right: 24px;
        background: #0f172a;
        color: #ffffff;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 13.5px;
        font-weight: 600;
        box-shadow: 0 8px 24px rgba(0,0,0,0.25);
        z-index: 9999;
        display: flex;
        align-items: center;
        gap: 8px;
        opacity: 0;
        transform: translateY(12px);
        transition: all 0.25s ease;
      `;
      document.body.appendChild(toast);
    }
    toast.innerHTML = `
      <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#22c55e" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
      <span>${msg}</span>
    `;
    toast.style.opacity = '1';
    toast.style.transform = 'translateY(0)';

    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateY(12px)';
    }, 3000);
  }

  // ==========================================================================
  // 5. Client-Side Live Search & Filtering
  // ==========================================================================
  if (searchInput) {
    searchInput.addEventListener('input', () => {
      const q = searchInput.value.trim().toLowerCase();
      const parentRows = document.querySelectorAll('.inv-parent-row');

      parentRows.forEach(parent => {
        const pid = parent.getAttribute('data-product-id');
        const title = (parent.querySelector('.inv-product-title') ? parent.querySelector('.inv-product-title').textContent : '').toLowerCase();
        const sku = (parent.querySelector('.inv-variant-sku') ? parent.querySelector('.inv-variant-sku').textContent : '').toLowerCase();
        const childRows = document.querySelectorAll(`.inv-child-row.group-${pid}`);

        let childMatched = false;
        childRows.forEach(child => {
          const varName = (child.querySelector('.inv-variant-name') ? child.querySelector('.inv-variant-name').textContent : '').toLowerCase();
          const varSku = (child.querySelector('.inv-variant-sku') ? child.querySelector('.inv-variant-sku').textContent : '').toLowerCase();

          if (!q || varName.includes(q) || varSku.includes(q)) {
            childMatched = true;
            child.style.display = '';
          } else {
            child.style.display = 'none';
          }
        });

        if (!q || title.includes(q) || sku.includes(q) || childMatched) {
          parent.style.display = '';
          if (q && childMatched) {
            // Auto open parent when search matches child
            const chevron = parent.querySelector('.inv-chevron-btn');
            if (chevron && !chevron.classList.contains('open')) {
              chevron.click();
            }
          }
        } else {
          parent.style.display = 'none';
        }
      });
    });
  }

  // Status Filter Change: reload with URL query parameter
  if (statusFilter) {
    statusFilter.addEventListener('change', () => {
      const selected = statusFilter.value;
      const url = new URL(window.location.href);
      url.searchParams.set('status', selected);
      window.location.href = url.toString();
    });
  }

  // ==========================================================================
  // 6. Master Checkbox Handler
  // ==========================================================================
  if (selectAllCheckbox) {
    selectAllCheckbox.addEventListener('change', () => {
      const checked = selectAllCheckbox.checked;
      document.querySelectorAll('.inv-row-checkbox').forEach(cb => {
        if (cb.closest('tr').style.display !== 'none') {
          cb.checked = checked;
        }
      });
    });
  }

  // ==========================================================================
  // 7. Rows Per Page Pagination
  // ==========================================================================
  if (rowsPerPageSelect) {
    let currentPage = 1;

    function applyPagination() {
      const pageSize = parseInt(rowsPerPageSelect.value, 10);
      const parentRows = Array.from(document.querySelectorAll('.inv-parent-row')).filter(r => r.style.display !== 'none');
      const total = parentRows.length;
      const totalPages = Math.max(1, Math.ceil(total / pageSize));

      if (currentPage > totalPages) currentPage = totalPages;

      const startIndex = (currentPage - 1) * pageSize;
      const endIndex = startIndex + pageSize;

      parentRows.forEach((row, idx) => {
        const pid = row.getAttribute('data-product-id');
        const childRows = document.querySelectorAll(`.inv-child-row.group-${pid}`);

        if (idx >= startIndex && idx < endIndex) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
          childRows.forEach(cr => cr.style.display = 'none');
        }
      });

      // Update info text
      const infoEl = document.getElementById('invPaginationInfo');
      if (infoEl) {
        const start = total === 0 ? 0 : startIndex + 1;
        const end = Math.min(endIndex, total);
        infoEl.textContent = `Showing ${start} to ${end} of ${total} items`;
      }

      // Update page buttons
      const prevBtn = document.getElementById('invPrevBtn');
      const nextBtn = document.getElementById('invNextBtn');
      const pagesContainer = document.getElementById('invPagesContainer');

      if (prevBtn) prevBtn.disabled = (currentPage <= 1);
      if (nextBtn) nextBtn.disabled = (currentPage >= totalPages);

      if (pagesContainer) {
        pagesContainer.innerHTML = '';
        for (let i = 1; i <= totalPages; i++) {
          const pBtn = document.createElement('button');
          pBtn.type = 'button';
          pBtn.className = 'page-num' + (i === currentPage ? ' active' : '');
          pBtn.textContent = i;
          pBtn.addEventListener('click', () => {
            currentPage = i;
            applyPagination();
          });
          pagesContainer.appendChild(pBtn);
        }
      }
    }

    rowsPerPageSelect.addEventListener('change', () => {
      currentPage = 1;
      applyPagination();
    });

    const prevBtn = document.getElementById('invPrevBtn');
    const nextBtn = document.getElementById('invNextBtn');

    if (prevBtn) {
      prevBtn.addEventListener('click', () => {
        if (currentPage > 1) {
          currentPage--;
          applyPagination();
        }
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        currentPage++;
        applyPagination();
      });
    }

    applyPagination();
  }
});
