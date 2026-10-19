/**
 * CATEGORY / SHOP LISTING PAGE JAVASCRIPT (category.js)
 * Dedicated JS for category page interactivity:
 * - Filter accordion expand/collapse
 * - Dual price range slider synchronization
 * - Quick filter pills filtering & active toggle
 * - Grid / List view mode switcher
 * - Sorting by position, price, name, newest
 * - Mobile filter off-canvas drawer open/close
 * - Add to Cart interactive feedback & cart badge increment
 * - Pagination (16 items per page, 20 total cards)
 */

document.addEventListener('DOMContentLoaded', function () {
  'use strict';

  /* ==========================================================================
     1. ACCORDION GROUPS (Shop By Filters)
     ========================================================================== */
  const accordionHeaders = document.querySelectorAll('.filter-group-header');

  accordionHeaders.forEach(function (headerBtn) {
    headerBtn.addEventListener('click', function () {
      const parentGroup = this.closest('.filter-accordion-group');
      if (!parentGroup) return;

      const isCurrentlyOpen = parentGroup.classList.contains('open');

      if (isCurrentlyOpen) {
        parentGroup.classList.remove('open');
        this.setAttribute('aria-expanded', 'false');
      } else {
        parentGroup.classList.add('open');
        this.setAttribute('aria-expanded', 'true');
      }
    });
  });

  /* ==========================================================================
     2. DUAL PRICE RANGE SLIDER
     ========================================================================== */
  const rangeMin = document.getElementById('priceRangeMin');
  const rangeMax = document.getElementById('priceRangeMax');
  const inputMin = document.getElementById('priceInputMin');
  const inputMax = document.getElementById('priceInputMax');
  const sliderFill = document.getElementById('priceSliderFill');
  const btnApplyPrice = document.getElementById('btnApplyPriceFilter');

  function updateSliderFill() {
    if (!rangeMin || !rangeMax || !sliderFill) return;

    let minVal = parseFloat(rangeMin.value);
    let maxVal = parseFloat(rangeMax.value);
    const minLimit = parseFloat(rangeMin.min) || 0;
    const maxLimit = parseFloat(rangeMin.max) || 100;
    const totalSpan = maxLimit - minLimit;

    // Keep minimum separation of 2 units
    if (minVal > maxVal - 2) {
      if (document.activeElement === rangeMin) {
        minVal = maxVal - 2;
        rangeMin.value = minVal;
      } else {
        maxVal = minVal + 2;
        rangeMax.value = maxVal;
      }
    }

    const leftPercent = ((minVal - minLimit) / totalSpan) * 100;
    const rightPercent = ((maxLimit - maxVal) / totalSpan) * 100;

    sliderFill.style.left = leftPercent + '%';
    sliderFill.style.width = (100 - leftPercent - rightPercent) + '%';

    if (inputMin) inputMin.value = Math.round(minVal);
    if (inputMax) inputMax.value = Math.round(maxVal);
  }

  if (rangeMin && rangeMax) {
    rangeMin.addEventListener('input', updateSliderFill);
    rangeMax.addEventListener('input', updateSliderFill);

    if (inputMin) {
      inputMin.addEventListener('change', function () {
        let val = parseFloat(this.value) || 0;
        if (val < 0) val = 0;
        if (val > parseFloat(rangeMax.value) - 2) val = parseFloat(rangeMax.value) - 2;
        rangeMin.value = val;
        this.value = Math.round(val);
        updateSliderFill();
      });
    }

    if (inputMax) {
      inputMax.addEventListener('change', function () {
        let val = parseFloat(this.value) || 100;
        if (val > 100) val = 100;
        if (val < parseFloat(rangeMin.value) + 2) val = parseFloat(rangeMin.value) + 2;
        rangeMax.value = val;
        this.value = Math.round(val);
        updateSliderFill();
      });
    }

    updateSliderFill();
  }

  // Apply Price Filter Button
  if (btnApplyPrice) {
    btnApplyPrice.addEventListener('click', function () {
      const min = parseFloat(inputMin ? inputMin.value : 0) || 0;
      const max = parseFloat(inputMax ? inputMax.value : 100) || 100;

      const productCards = document.querySelectorAll('.category-product-card');
      productCards.forEach(function (card) {
        const price = parseFloat(card.dataset.price) || 0;
        if (price >= min && price <= max) {
          card.dataset.priceFiltered = 'true';
        } else {
          card.dataset.priceFiltered = 'false';
        }
      });

      currentPage = 1;
      renderPagination();

      const originalText = btnApplyPrice.textContent;
      btnApplyPrice.textContent = 'Filtered!';
      setTimeout(function () {
        btnApplyPrice.textContent = originalText;
      }, 1000);
    });
  }

  /* ==========================================================================
     3. QUICK FILTER PILLS
     ========================================================================== */
  const quickPillBtns = document.querySelectorAll('.quick-pill-btn');

  quickPillBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      quickPillBtns.forEach(function (b) { b.classList.remove('active'); });
      this.classList.add('active');

      const filterType = this.dataset.filter;
      const productCards = document.querySelectorAll('.category-product-card');

      productCards.forEach(function (card) {
        if (!filterType || filterType === 'all') {
          delete card.dataset.pillFiltered;
        } else {
          const cardCat = card.dataset.category;
          if (cardCat && cardCat === filterType) {
            delete card.dataset.pillFiltered;
          } else {
            card.dataset.pillFiltered = 'hide';
          }
        }
      });

      currentPage = 1;
      renderPagination();
    });
  });

  /* ==========================================================================
     4. GRID / LIST VIEW SWITCHER
     ========================================================================== */
  const btnGridView = document.getElementById('btnGridView');
  const btnListView = document.getElementById('btnListView');
  const productGrid = document.getElementById('categoryProductGrid');

  if (btnGridView && btnListView && productGrid) {
    btnGridView.addEventListener('click', function () {
      btnGridView.classList.add('active');
      btnListView.classList.remove('active');
      productGrid.classList.remove('list-view');
      localStorage.setItem('vape_category_view', 'grid');
    });

    btnListView.addEventListener('click', function () {
      btnListView.classList.add('active');
      btnGridView.classList.remove('active');
      productGrid.classList.add('list-view');
      localStorage.setItem('vape_category_view', 'list');
    });

    const savedView = localStorage.getItem('vape_category_view');
    if (savedView === 'list') {
      btnListView.click();
    }
  }

  /* ==========================================================================
     5. SORT DROPDOWN & DIRECTION
     ========================================================================== */
  const sortSelect = document.getElementById('categorySortSelect');
  const sortDirectionBtn = document.getElementById('sortDirectionBtn');
  let isAscending = true;

  function sortProducts() {
    if (!productGrid) return;
    const cards = Array.from(productGrid.querySelectorAll('.category-product-card'));
    const sortVal = sortSelect ? sortSelect.value : 'position';

    cards.sort(function (a, b) {
      if (sortVal === 'price-asc') {
        const priceA = parseFloat(a.dataset.price) || 0;
        const priceB = parseFloat(b.dataset.price) || 0;
        return isAscending ? priceA - priceB : priceB - priceA;
      } else if (sortVal === 'price-desc') {
        const priceA = parseFloat(a.dataset.price) || 0;
        const priceB = parseFloat(b.dataset.price) || 0;
        return isAscending ? priceB - priceA : priceA - priceB;
      } else if (sortVal === 'name') {
        const titleA = (a.querySelector('.card-product-title')?.textContent || '').trim().toLowerCase();
        const titleB = (b.querySelector('.card-product-title')?.textContent || '').trim().toLowerCase();
        return isAscending ? titleA.localeCompare(titleB) : titleB.localeCompare(titleA);
      }
      return 0;
    });

    cards.forEach(function (card) {
      productGrid.appendChild(card);
    });

    renderPagination();
  }

  if (sortSelect) {
    sortSelect.addEventListener('change', sortProducts);
  }

  if (sortDirectionBtn) {
    sortDirectionBtn.addEventListener('click', function () {
      isAscending = !isAscending;
      this.style.transform = isAscending ? 'rotate(0deg)' : 'rotate(180deg)';
      sortProducts();
    });
  }

  /* ==========================================================================
     6. MOBILE FILTER DRAWER & BACKDROP
     ========================================================================== */
  const mobileTriggerBtn = document.getElementById('mobileFilterTriggerBtn');
  const mobileCloseBtn = document.getElementById('mobileFilterCloseBtn');
  const sidebarCol = document.getElementById('categorySidebarCol');
  const filterBackdrop = document.getElementById('mobileFilterBackdrop');

  function openMobileFilters() {
    if (sidebarCol) sidebarCol.classList.add('mobile-open');
    if (filterBackdrop) filterBackdrop.classList.add('show');
    document.body.style.overflow = 'hidden';
  }

  function closeMobileFilters() {
    if (sidebarCol) sidebarCol.classList.remove('mobile-open');
    if (filterBackdrop) filterBackdrop.classList.remove('show');
    document.body.style.overflow = '';
  }

  if (mobileTriggerBtn) {
    mobileTriggerBtn.addEventListener('click', openMobileFilters);
  }

  if (mobileCloseBtn) {
    mobileCloseBtn.addEventListener('click', closeMobileFilters);
  }

  if (filterBackdrop) {
    filterBackdrop.addEventListener('click', closeMobileFilters);
  }

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && sidebarCol && sidebarCol.classList.contains('mobile-open')) {
      closeMobileFilters();
    }
  });

  /* ==========================================================================
     7. ADD TO CART BUTTON (Delegated on product grid)
     ========================================================================== */
  if (productGrid) {
    productGrid.addEventListener('click', function (e) {
      const btn = e.target.closest('.btn-card-add-cart');
      if (!btn) return;

      e.preventDefault();
      e.stopPropagation();

      const card = btn.closest('.category-product-card');
      if (card && window.NewVapeCart) {
        const titleEl = card.querySelector('.card-product-title a, .card-product-title');
        const priceEl = card.querySelector('.card-current-price');
        const imgEl = card.querySelector('.card-product-img');

        const title = titleEl ? titleEl.textContent.trim() : 'Vape Device';
        const priceStr = priceEl ? priceEl.textContent.replace(/[^0-9.]/g, '') : '14.99';
        const price = parseFloat(priceStr) || 14.99;
        const image = imgEl ? imgEl.getAttribute('src') : 'assets/images/vape-image.webp';
        const id = title.toLowerCase().replace(/[^a-z0-9]+/g, '-');

        window.NewVapeCart.add({
          id: id,
          title: title,
          price: price,
          quantity: 1,
          flavor: '',
          image: image
        });
      }

      if (btn.classList.contains('added')) return;

      const origText = btn.textContent;
      btn.classList.add('added');
      btn.textContent = 'ADDED ✓';

      setTimeout(() => {
        btn.classList.remove('added');
        btn.textContent = origText;
      }, 1600);
    });
  }

  /* ==========================================================================
     8. CATEGORY RADIO / CHECKBOX FILTER INTERACTION
     ========================================================================== */
  const categoryRadios = document.querySelectorAll('input[name="filterCategory"]');
  categoryRadios.forEach(function (radio) {
    radio.addEventListener('change', function () {
      if (this.checked) {
        const label = this.closest('.filter-option-label');
        const catName = label ? label.querySelector('.option-name')?.textContent.trim() : '';

        quickPillBtns.forEach(function (pill) {
          if (pill.textContent.trim() === catName) {
            pill.click();
          }
        });
      }
    });
  });

  /* ==========================================================================
     9. PAGINATION (16 items per page, 20 total cards)
     ========================================================================== */
  let currentPage = 1;
  let itemsPerPage = 16;
  const paginationControls = document.getElementById('paginationControls');
  const paginationRangeText = document.getElementById('paginationRangeText');
  const paginationTotalText = document.getElementById('paginationTotalText');
  const btnPagePrev = document.getElementById('btnPagePrev');
  const btnPageNext = document.getElementById('btnPageNext');
  const itemsPerPageSelect = document.getElementById('itemsPerPageSelect');

  function renderPagination() {
    const allCards = Array.from(document.querySelectorAll('.category-product-card'));
    
    // Filter cards eligible to display
    const eligibleCards = allCards.filter(function (card) {
      if (card.dataset.pillFiltered === 'hide') return false;
      if (card.dataset.priceFiltered === 'false') return false;
      return true;
    });

    const totalItems = eligibleCards.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage) || 1;

    if (currentPage > totalPages) currentPage = totalPages;
    if (currentPage < 1) currentPage = 1;

    const startIdx = (currentPage - 1) * itemsPerPage;
    const endIdx = Math.min(startIdx + itemsPerPage, totalItems);

    // Hide all cards first
    allCards.forEach(function (card) {
      card.style.display = 'none';
    });

    // Show only the slice of eligible cards for current page
    eligibleCards.forEach(function (card, idx) {
      if (idx >= startIdx && idx < endIdx) {
        card.style.display = '';
      }
    });

    // Update range text: "1 to 16 of 20"
    if (paginationRangeText) {
      paginationRangeText.textContent = totalItems > 0 ? `${startIdx + 1} to ${endIdx}` : '0';
    }
    if (paginationTotalText) {
      paginationTotalText.textContent = totalItems;
    }

    // Update page buttons
    const numButtons = paginationControls ? paginationControls.querySelectorAll('.pagination-num-btn') : [];
    numButtons.forEach(function (btn) {
      const pageNum = parseInt(btn.dataset.page, 10);
      if (pageNum === currentPage) {
        btn.classList.add('active');
      } else {
        btn.classList.remove('active');
      }
    });

    // Update Prev / Next buttons
    if (btnPagePrev) {
      if (currentPage <= 1) {
        btnPagePrev.classList.add('disabled');
      } else {
        btnPagePrev.classList.remove('disabled');
      }
    }

    if (btnPageNext) {
      if (currentPage >= totalPages) {
        btnPageNext.classList.add('disabled');
      } else {
        btnPageNext.classList.remove('disabled');
      }
    }
  }

  // Page numbers click
  if (paginationControls) {
    paginationControls.addEventListener('click', function (e) {
      const numBtn = e.target.closest('.pagination-num-btn');
      if (numBtn) {
        const targetPage = parseInt(numBtn.dataset.page, 10);
        if (targetPage && targetPage !== currentPage) {
          currentPage = targetPage;
          renderPagination();
          scrollToProductGrid();
        }
      }
    });
  }

  // Prev button click
  if (btnPagePrev) {
    btnPagePrev.addEventListener('click', function () {
      if (currentPage > 1) {
        currentPage--;
        renderPagination();
        scrollToProductGrid();
      }
    });
  }

  // Next button click
  if (btnPageNext) {
    btnPageNext.addEventListener('click', function () {
      const allCards = document.querySelectorAll('.category-product-card');
      const totalPages = Math.ceil(allCards.length / itemsPerPage);
      if (currentPage < totalPages) {
        currentPage++;
        renderPagination();
        scrollToProductGrid();
      }
    });
  }

  // Items per page select dropdown (Show 16 / 20 / 24)
  if (itemsPerPageSelect) {
    itemsPerPageSelect.addEventListener('change', function () {
      itemsPerPage = parseInt(this.value, 10) || 16;
      currentPage = 1;
      renderPagination();
      scrollToProductGrid();
    });
  }

  function scrollToProductGrid() {
    const grid = document.getElementById('categoryProductGrid');
    if (grid) {
      grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }

  // Initialize pagination on load
  renderPagination();

  /* ==========================================================================
     10. CATEGORY BOTTOM DESCRIPTION READ MORE / READ LESS TOGGLE
     ========================================================================== */
  const btnReadMoreToggle = document.getElementById('btnReadMoreToggle');
  const bottomTextWrap = document.getElementById('categoryBottomTextWrap');

  if (btnReadMoreToggle && bottomTextWrap) {
    btnReadMoreToggle.addEventListener('click', function () {
      const isExpanded = bottomTextWrap.classList.contains('expanded');
      const label = this.querySelector('.btn-read-more-label');

      if (isExpanded) {
        bottomTextWrap.classList.remove('expanded');
        this.classList.remove('expanded');
        this.setAttribute('aria-expanded', 'false');
        if (label) label.textContent = 'Read More';
      } else {
        bottomTextWrap.classList.add('expanded');
        this.classList.add('expanded');
        this.setAttribute('aria-expanded', 'true');
        if (label) label.textContent = 'Read Less';
      }
    });
  }

  /* ==========================================================================
     11. CATEGORY FAQS ACCORDION TOGGLE
     ========================================================================== */
  const faqQuestionBtns = document.querySelectorAll('.category-faq-question-btn');

  faqQuestionBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      const parentItem = this.closest('.category-faq-item');
      if (!parentItem) return;

      const isCurrentlyOpen = parentItem.classList.contains('open');

      if (isCurrentlyOpen) {
        parentItem.classList.remove('open');
        this.setAttribute('aria-expanded', 'false');
      } else {
        parentItem.classList.add('open');
        this.setAttribute('aria-expanded', 'true');
      }
    });
  });

});

