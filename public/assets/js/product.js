/**
 * PRODUCT DETAILS PAGE JAVASCRIPT
 * Handles image gallery switching, quantity counter, flavor selection, and add to cart feedback.
 */

document.addEventListener('DOMContentLoaded', () => {
  // 1. Interactive Image Gallery (Thumbnails -> Main Image)
  const mainImage = document.getElementById('productMainImage');
  const thumbButtons = document.querySelectorAll('.product-thumb-btn');

  if (mainImage && thumbButtons.length > 0) {
    thumbButtons.forEach((btn) => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const newSrc = btn.getAttribute('data-img');
        if (!newSrc || mainImage.getAttribute('src') === newSrc) return;

        // Active state highlight
        thumbButtons.forEach((b) => b.classList.remove('active'));
        btn.classList.add('active');

        // Smooth image switch transition
        mainImage.style.opacity = '0.3';
        mainImage.style.transform = 'scale(0.97)';

        setTimeout(() => {
          mainImage.src = newSrc;
          mainImage.style.opacity = '1';
          mainImage.style.transform = '';
        }, 150);
      });
    });
  }

  // 2. Quantity Counter Controls
  const qtyInput = document.getElementById('productQuantity');
  const qtyMinus = document.getElementById('qtyMinus');
  const qtyPlus  = document.getElementById('qtyPlus');

  if (qtyInput && qtyMinus && qtyPlus) {
    qtyMinus.addEventListener('click', (e) => {
      e.preventDefault();
      let currentVal = parseInt(qtyInput.value, 10) || 1;
      if (currentVal > 1) {
        qtyInput.value = currentVal - 1;
      }
    });

    qtyPlus.addEventListener('click', (e) => {
      e.preventDefault();
      let currentVal = parseInt(qtyInput.value, 10) || 1;
      if (currentVal < 99) {
        qtyInput.value = currentVal + 1;
      }
    });
  }

  // 3. Add to Cart Feedback, NewVapeCart Integration & Drawer Trigger
  const btnAddToCart = document.getElementById('btnProductAddToCart');

  if (btnAddToCart) {
    btnAddToCart.addEventListener('click', (e) => {
      e.preventDefault();

      const originalText = btnAddToCart.innerHTML;
      const addedQty = parseInt(qtyInput ? qtyInput.value : '1', 10) || 1;

      // Extract product data
      const titleEl = document.querySelector('.product-details-title');
      const priceEl = document.querySelector('.product-price-current');
      const flavorEl = document.querySelector('.product-flavor-select');
      const imgEl = document.getElementById('productMainImage');

      const title = titleEl ? titleEl.textContent.trim() : 'Vape Device';
      const priceStr = priceEl ? priceEl.textContent.replace(/[^0-9.]/g, '') : '17.99';
      const price = parseFloat(priceStr) || 17.99;
      const flavor = flavorEl && flavorEl.value ? flavorEl.value : '';
      const image = imgEl ? imgEl.getAttribute('src') : 'assets/images/vape-image.webp';
      const id = (title + (flavor ? '-' + flavor : '')).toLowerCase().replace(/[^a-z0-9]+/g, '-');

      if (window.NewVapeCart) {
        window.NewVapeCart.add({
          id: id,
          title: title,
          price: price,
          quantity: addedQty,
          flavor: flavor,
          image: image
        });
      }

      // Visual feedback
      btnAddToCart.innerHTML = `ADDED (${addedQty})! ✓`;
      btnAddToCart.style.backgroundColor = '#10b981';
      btnAddToCart.style.color = '#ffffff';
      btnAddToCart.style.boxShadow = '0 6px 18px rgba(16, 185, 129, 0.4)';

      // Revert button after 1.8s
      setTimeout(() => {
        btnAddToCart.innerHTML = originalText;
        btnAddToCart.style.backgroundColor = '';
        btnAddToCart.style.color = '';
        btnAddToCart.style.boxShadow = '';
      }, 1800);
    });
  }

  // 4. Buy It Now Action Feedback
  const btnBuyNow = document.getElementById('btnProductBuyNow');
  if (btnBuyNow) {
    btnBuyNow.addEventListener('click', (e) => {
      e.preventDefault();
      const originalText = btnBuyNow.textContent;
      btnBuyNow.textContent = 'PROCEEDING TO CHECKOUT...';
      btnBuyNow.style.opacity = '0.85';

      setTimeout(() => {
        btnBuyNow.textContent = originalText;
        btnBuyNow.style.opacity = '1';
        alert('Thank you! Redirecting to secure checkout...');
      }, 800);
    });
  }

  // 5. Product Tabs Switching (Description, More Info, Reviews, FAQs, Related Posts)
  const tabButtons = document.querySelectorAll('.product-tab-btn');
  const tabPanes   = document.querySelectorAll('.product-tab-pane');

  function switchTab(targetTabId) {
    if (!targetTabId) return;

    tabButtons.forEach((btn) => {
      const isTarget = btn.getAttribute('data-tab') === targetTabId;
      btn.classList.toggle('active', isTarget);
      btn.setAttribute('aria-selected', isTarget ? 'true' : 'false');
    });

    tabPanes.forEach((pane) => {
      pane.classList.toggle('active', pane.id === targetTabId);
    });
  }

  tabButtons.forEach((btn) => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const targetId = btn.getAttribute('data-tab');
      switchTab(targetId);
    });
  });

  // Handle #reviews anchor link from product header meta
  const reviewLink = document.querySelector('.rating-count');
  if (reviewLink) {
    reviewLink.addEventListener('click', (e) => {
      e.preventDefault();
      switchTab('tab-reviews');
      const tabsSection = document.getElementById('productTabsSection');
      if (tabsSection) {
        tabsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  }

  // 6. Interactive Star Rating in "Write a Review"
  const starRatingWrap = document.getElementById('reviewStarRating');
  const selectedRatingInput = document.getElementById('selectedRating');

  if (starRatingWrap && selectedRatingInput) {
    const starBtns = starRatingWrap.querySelectorAll('.star-rating-btn');

    function updateStars(rating) {
      starBtns.forEach((star) => {
        const starVal = parseInt(star.getAttribute('data-rating'), 10);
        star.classList.toggle('active', starVal <= rating);
      });
    }

    starBtns.forEach((star) => {
      star.addEventListener('click', () => {
        const rating = parseInt(star.getAttribute('data-rating'), 10);
        selectedRatingInput.value = rating;
        updateStars(rating);
      });

      star.addEventListener('mouseenter', () => {
        const rating = parseInt(star.getAttribute('data-rating'), 10);
        starBtns.forEach((s) => {
          const sVal = parseInt(s.getAttribute('data-rating'), 10);
          s.classList.toggle('hover', sVal <= rating);
        });
      });
    });

    starRatingWrap.addEventListener('mouseleave', () => {
      starBtns.forEach((s) => s.classList.remove('hover'));
      updateStars(parseInt(selectedRatingInput.value, 10) || 5);
    });
  }

  // 7. Write a Review Form Submission
  const writeReviewForm = document.getElementById('writeReviewForm');
  if (writeReviewForm) {
    writeReviewForm.addEventListener('submit', (e) => {
      e.preventDefault();

      const nickname = document.getElementById('reviewNickname').value.trim();
      const title    = document.getElementById('reviewTitle').value.trim();
      const body     = document.getElementById('reviewBody').value.trim();
      const rating   = parseInt(selectedRatingInput ? selectedRatingInput.value : '5', 10) || 5;

      if (!nickname || !title || !body) return;

      const reviewsList = document.querySelector('.reviews-list');
      if (reviewsList) {
        const starStr = '★'.repeat(rating) + '☆'.repeat(5 - rating);
        const today = new Date().toLocaleDateString('en-US', { month: 'numeric', day: 'numeric', year: '2-digit' });

        const newReviewEl = document.createElement('div');
        newReviewEl.className = 'review-item';
        newReviewEl.style.animation = 'fadeInTab 0.35s ease';
        newReviewEl.innerHTML = `
          <div class="review-stars-row" aria-label="${rating} stars">${starStr}</div>
          <h4 class="review-item-title">${escapeHTML(title)}</h4>
          <p class="review-item-body">${escapeHTML(body)}</p>
          <div class="review-meta">${escapeHTML(nickname)} &bull; ${today}</div>
        `;

        reviewsList.prepend(newReviewEl);

        // Update count text
        const countText = document.querySelector('.reviews-count-text');
        if (countText) {
          const totalReviews = reviewsList.querySelectorAll('.review-item').length;
          countText.textContent = `${totalReviews} Item(s)`;
        }
      }

      // Reset form
      writeReviewForm.reset();
      if (selectedRatingInput) selectedRatingInput.value = '5';
      if (starRatingWrap) {
        starRatingWrap.querySelectorAll('.star-rating-btn').forEach((s) => s.classList.add('active'));
      }

      alert('Thank you! Your review has been submitted.');
    });
  }

  function escapeHTML(str) {
    const p = document.createElement('p');
    p.appendChild(document.createTextNode(str));
    return p.innerHTML;
  }

  // 8. FAQ Accordion Toggle
  const faqHeaderBtns = document.querySelectorAll('.faq-header-btn');
  faqHeaderBtns.forEach((btn) => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const card = btn.closest('.faq-accordion-card');
      if (!card) return;

      const isOpen = card.classList.contains('open');

      // Close other FAQs for clean single-accordion feel (optional: or leave open)
      document.querySelectorAll('.faq-accordion-card').forEach((otherCard) => {
        if (otherCard !== card) {
          otherCard.classList.remove('open');
          const otherBtn = otherCard.querySelector('.faq-header-btn');
          if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
        }
      });

      card.classList.toggle('open', !isOpen);
      btn.setAttribute('aria-expanded', !isOpen ? 'true' : 'false');
    });
  });

  // 9. Card Interactions for "You May Also Like" Grid
  const gridCards = document.querySelectorAll('.you-may-also-like-grid .product-card');
  gridCards.forEach((card) => {
    // Add To Cart Button Interactive Feedback
    const addBtn = card.querySelector('.btn-add-to-cart');
    if (addBtn) {
      addBtn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();

        const titleEl = card.querySelector('.product-title a, .product-title');
        const priceEl = card.querySelector('.current-price');
        const imgEl = card.querySelector('.product-img');

        const title = titleEl ? titleEl.textContent.trim() : 'Vape Device';
        const priceStr = priceEl ? priceEl.textContent.replace(/[^0-9.]/g, '') : '19.99';
        const price = parseFloat(priceStr) || 19.99;
        const image = imgEl ? imgEl.getAttribute('src') : 'assets/images/vape-image.webp';
        const id = title.toLowerCase().replace(/[^a-z0-9]+/g, '-');

        if (window.NewVapeCart) {
          window.NewVapeCart.add({
            id: id,
            title: title,
            price: price,
            quantity: 1,
            flavor: '',
            image: image
          });
        }

        const originalText = addBtn.textContent;
        addBtn.textContent = 'ADDED! ✓';
        addBtn.style.backgroundColor = '#10b981';
        addBtn.style.boxShadow = '0 4px 14px rgba(16, 185, 129, 0.4)';

        setTimeout(() => {
          addBtn.textContent = originalText;
          addBtn.style.backgroundColor = '';
          addBtn.style.boxShadow = '';
        }, 1500);
      });
    }
  });
});


