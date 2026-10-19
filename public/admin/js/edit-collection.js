/**
 * New Vape - Edit Collection Page JavaScript
 * Handles automated condition rules editor, collection image update, and live real-time SEO preview
 */

document.addEventListener('DOMContentLoaded', () => {
  // 1. Elements & SEO Live Preview
  const toggleSeoBtn = document.getElementById('toggleSeoBtn');
  const seoFieldsContainer = document.getElementById('seoFieldsContainer');
  const mainTitleInput = document.getElementById('collectionTitle') || document.querySelector('input[name="title"]');
  const mainDescInput = document.getElementById('collectionDescription') || document.querySelector('textarea[name="description"]');
  const seoTitleInput = document.getElementById('seoTitleInput');
  const seoDescInput = document.getElementById('seoDescInput');
  const slugInput = document.getElementById('slugInput');
  const seoTitleCount = document.getElementById('seoTitleCount');
  const seoDescCount = document.getElementById('seoDescCount');
  const seoPreviewTitle = document.getElementById('seoPreviewTitle');
  const seoPreviewDesc = document.getElementById('seoPreviewDesc');
  const seoPreviewUrl = document.getElementById('seoPreviewUrl');

  const prefixSpan = document.querySelector('.input-prefix-container .prefix');
  const urlPrefix = prefixSpan ? prefixSpan.textContent.trim() : 'http://localhost/vapefinalwebsite/collections/';

  if (toggleSeoBtn && seoFieldsContainer) {
    toggleSeoBtn.addEventListener('click', (e) => {
      e.preventDefault();
      seoFieldsContainer.classList.toggle('active');
    });
  }

  function updateSeoPreview() {
    const mainTitle = mainTitleInput ? mainTitleInput.value.trim() : '';
    const mainDesc = mainDescInput ? mainDescInput.value.trim() : '';
    const customTitle = seoTitleInput ? seoTitleInput.value.trim() : '';
    const customDesc = seoDescInput ? seoDescInput.value.trim() : '';
    const currentSlug = slugInput ? slugInput.value.trim() : '';

    // Title preview: priority to custom SEO title, then collection main title, then default
    if (seoPreviewTitle) {
      if (customTitle) {
        seoPreviewTitle.textContent = customTitle;
      } else if (mainTitle) {
        seoPreviewTitle.textContent = mainTitle + ' | New Vape';
      } else {
        seoPreviewTitle.textContent = 'Collection Title Preview';
      }
    }

    // Description preview: priority to custom SEO desc, then collection description, then default
    if (seoPreviewDesc) {
      if (customDesc) {
        seoPreviewDesc.textContent = customDesc;
      } else if (mainDesc) {
        seoPreviewDesc.textContent = mainDesc;
      } else {
        seoPreviewDesc.textContent = 'Description will appear in search engine results...';
      }
    }

    // Character counters
    if (seoTitleCount && seoTitleInput) {
      seoTitleCount.textContent = seoTitleInput.value.length;
    }
    if (seoDescCount && seoDescInput) {
      seoDescCount.textContent = seoDescInput.value.length;
    }

    // URL preview
    if (seoPreviewUrl) {
      seoPreviewUrl.textContent = urlPrefix + (currentSlug || 'handle');
    }
  }

  // Attach real-time listeners for all inputs
  const watchInputs = [mainTitleInput, mainDescInput, seoTitleInput, seoDescInput, slugInput];
  watchInputs.forEach(input => {
    if (!input) return;
    ['input', 'keyup', 'change', 'paste'].forEach(evt => {
      input.addEventListener(evt, () => {
        if (input === slugInput) {
          slugInput.dataset.touched = 'true';
        }
        if (input === mainTitleInput && slugInput && !slugInput.dataset.touched && !slugInput.value.trim()) {
          const autoSlug = mainTitleInput.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
          slugInput.value = autoSlug;
        }
        updateSeoPreview();
      });
    });
  });

  // Run immediately on page load
  updateSeoPreview();

  // 2. Collection Type Radios (Manual vs Automated)
  const collectionTypeRadios = document.querySelectorAll('input[name="collection_type"]');
  const automatedConditionsBox = document.getElementById('automatedConditionsBox');
  const radioCardManual = document.getElementById('radioCardManual');
  const radioCardAutomated = document.getElementById('radioCardAutomated');

  if (collectionTypeRadios.length > 0) {
    collectionTypeRadios.forEach(radio => {
      radio.addEventListener('change', function() {
        if (this.value === 'automated') {
          if (automatedConditionsBox) automatedConditionsBox.classList.remove('d-none');
          if (radioCardAutomated) radioCardAutomated.classList.add('selected');
          if (radioCardManual) radioCardManual.classList.remove('selected');
        } else {
          if (automatedConditionsBox) automatedConditionsBox.classList.add('d-none');
          if (radioCardManual) radioCardManual.classList.add('selected');
          if (radioCardAutomated) radioCardAutomated.classList.remove('selected');
        }
      });
    });
  }

  // 3. Add / Remove Automated Condition Rows
  const btnAddCondition = document.getElementById('btnAddCondition');
  const conditionsListContainer = document.getElementById('conditionsListContainer');

  if (btnAddCondition && conditionsListContainer) {
    btnAddCondition.addEventListener('click', () => {
      const newRow = document.createElement('div');
      newRow.className = 'condition-row';
      newRow.innerHTML = `
        <select name="condition_field[]" class="admin-form-select">
          <option value="tag" selected>Product tag</option>
          <option value="title">Product title</option>
          <option value="brand">Product vendor / brand</option>
          <option value="price">Product price</option>
          <option value="stock">Inventory stock</option>
        </select>
        <select name="condition_operator[]" class="admin-form-select">
          <option value="equals" selected>is equal to</option>
          <option value="not_equals">is not equal to</option>
          <option value="contains">contains</option>
          <option value="starts_with">starts with</option>
          <option value="greater_than">is greater than</option>
          <option value="less_than">is less than</option>
        </select>
        <input type="text" name="condition_value[]" class="admin-form-input" placeholder="Enter condition value...">
        <button type="button" class="btn-icon-only danger btn-remove-condition" title="Remove condition">
          <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
      `;
      conditionsListContainer.appendChild(newRow);
    });
  }

  // Delegated remove for condition rows
  document.addEventListener('click', (e) => {
    const removeBtn = e.target.closest('.btn-remove-condition');
    if (removeBtn) {
      const row = removeBtn.closest('.condition-row');
      if (row) row.remove();
    }
  });

  // 4. Collection Image Box Upload & Preview & Remove Button
  const collectionImageBox = document.getElementById('collectionImageBox');
  const collectionImageInput = document.getElementById('collectionImageInput');
  const collectionPreviewImg = document.getElementById('collectionPreviewImg');
  const colUploadIcon = document.getElementById('colUploadIcon');
  const btnRemoveColImg = document.getElementById('btnRemoveColImg');
  const collectionImageUrl = document.getElementById('collectionImageUrl');

  // Trigger file selection when image box is clicked (excluding remove button)
  if (collectionImageBox && collectionImageInput) {
    collectionImageBox.addEventListener('click', (e) => {
      if (e.target.closest('#btnRemoveColImg')) return;
      collectionImageInput.click();
    });
  }

  // Handle selected file preview
  if (collectionImageInput) {
    collectionImageInput.addEventListener('change', function() {
      if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = (e) => {
          if (collectionPreviewImg) {
            collectionPreviewImg.src = e.target.result;
            collectionPreviewImg.classList.remove('d-none');
          }
          if (colUploadIcon) colUploadIcon.classList.add('d-none');
          if (btnRemoveColImg) btnRemoveColImg.classList.remove('d-none');
        };
        reader.readAsDataURL(this.files[0]);
      }
    });
  }

  // Cross / Remove Button click handler
  if (btnRemoveColImg) {
    btnRemoveColImg.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      e.stopImmediatePropagation();

      if (collectionImageInput) {
        collectionImageInput.value = '';
      }
      if (collectionImageUrl) {
        collectionImageUrl.value = '';
      }
      if (collectionPreviewImg) {
        collectionPreviewImg.src = '';
        collectionPreviewImg.classList.add('d-none');
      }
      btnRemoveColImg.classList.add('d-none');
      if (colUploadIcon) {
        colUploadIcon.classList.remove('d-none');
      }
    });
  }

  // Handle broken image error fallback
  if (collectionPreviewImg) {
    collectionPreviewImg.addEventListener('error', function() {
      this.classList.add('d-none');
      if (colUploadIcon) colUploadIcon.classList.remove('d-none');
      if (btnRemoveColImg) btnRemoveColImg.classList.add('d-none');
    });
  }
});
