/**
 * New Vape - Add Product Page JavaScript
 * Handles Dynamic Multi-Media Gallery Uploader, Shopify-Style Dynamic Variants Matrix,
 * Rich Text Editor, Tags, and Live SEO Preview.
 */

document.addEventListener('DOMContentLoaded', () => {
  // ==========================================================================
  // 1. Search Engine Listing (SEO) Live Preview & Toggle
  // ==========================================================================
  const toggleSeoBtn = document.getElementById('toggleSeoBtn');
  const seoFieldsContainer = document.getElementById('seoFieldsContainer');
  const seoTitleInput = document.getElementById('seoTitleInput');
  const seoDescInput = document.getElementById('seoDescInput');
  const slugInput = document.getElementById('slugInput');
  const seoTitleCount = document.getElementById('seoTitleCount');
  const seoDescCount = document.getElementById('seoDescCount');
  const seoPreviewTitle = document.getElementById('seoPreviewTitle');
  const seoPreviewDesc = document.getElementById('seoPreviewDesc');
  const seoPreviewUrl = document.getElementById('seoPreviewUrl');

  const mainTitleInput = document.querySelector('input[name="title"]') || document.getElementById('productTitle');
  const mainDescInput = document.querySelector('textarea[name="description"]') || document.getElementById('productDescription');

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

    if (seoPreviewTitle) {
      seoPreviewTitle.textContent = customTitle || mainTitle || 'Title Preview';
    }

    if (seoPreviewDesc) {
      seoPreviewDesc.textContent = customDesc || mainDesc || 'Description will appear in search engine results...';
    }

    if (seoTitleCount && seoTitleInput) {
      seoTitleCount.textContent = seoTitleInput.value.length;
    }

    if (seoDescCount && seoDescInput) {
      seoDescCount.textContent = seoDescInput.value.length;
    }

    if (slugInput && !slugInput.dataset.touched && mainTitle) {
      const autoSlug = mainTitle.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
      slugInput.value = autoSlug;
    }

    if (seoPreviewUrl) {
      const currentSlug = slugInput ? slugInput.value.trim() : '';
      seoPreviewUrl.textContent = 'www.newvape.com/products/' + (currentSlug || 'handle');
    }
  }

  if (mainTitleInput) mainTitleInput.addEventListener('input', updateSeoPreview);
  if (mainDescInput) mainDescInput.addEventListener('input', updateSeoPreview);
  if (seoTitleInput) seoTitleInput.addEventListener('input', updateSeoPreview);
  if (seoDescInput) seoDescInput.addEventListener('input', updateSeoPreview);

  if (slugInput) {
    slugInput.addEventListener('input', () => {
      slugInput.dataset.touched = 'true';
      updateSeoPreview();
    });
  }

  // ==========================================================================
  // 2. Rich Text Editor (RTE) Toolbar Execution
  // ==========================================================================
  document.querySelectorAll('.rich-text-editor').forEach(rte => {
    const toolbar = rte.querySelector('.rte-toolbar');
    const content = rte.querySelector('.rte-editor-content');
    const textarea = rte.querySelector('textarea');

    if (toolbar && content) {
      toolbar.querySelectorAll('button').forEach(btn => {
        btn.addEventListener('click', (e) => {
          e.preventDefault();
          const cmd = btn.getAttribute('data-command');
          const val = btn.getAttribute('data-value') || null;
          document.execCommand(cmd, false, val);
          content.focus();
        });
      });

      content.addEventListener('input', () => {
        if (textarea) textarea.value = content.innerHTML;
      });
    }
  });

  // ==========================================================================
  // 3. Multi-Media Gallery Uploader (DataTransfer for Multiple Files)
  // ==========================================================================
  const productMediaInput = document.getElementById('productMediaInput');
  const mediaDropzone = document.getElementById('mediaDropzone');
  const mediaPreviewGrid = document.getElementById('mediaPreviewGrid');
  const featuredImageIndexInput = document.getElementById('featuredImageIndex');

  let selectedFilesDT = new DataTransfer();
  let featuredIndex = 0;

  function renderMediaPreviews() {
    if (!mediaPreviewGrid) return;
    mediaPreviewGrid.innerHTML = '';

    if (selectedFilesDT.files.length === 0) {
      mediaPreviewGrid.style.display = 'none';
      featuredIndex = 0;
      if (featuredImageIndexInput) featuredImageIndexInput.value = '0';
      return;
    }

    if (featuredIndex >= selectedFilesDT.files.length) {
      featuredIndex = 0;
    }
    if (featuredImageIndexInput) {
      featuredImageIndexInput.value = featuredIndex;
    }

    mediaPreviewGrid.classList.remove('d-none');
    mediaPreviewGrid.style.display = 'grid';

    Array.from(selectedFilesDT.files).forEach((file, idx) => {
      const isFeatured = (idx === featuredIndex);
      const reader = new FileReader();
      reader.onload = (e) => {
        const item = document.createElement('div');
        item.className = 'media-preview-item' + (isFeatured ? ' is-featured' : '');
        item.innerHTML = `
          <img src="${e.target.result}" alt="${file.name}">
          ${isFeatured ? '<span class="media-preview-badge">★ Featured</span>' : ''}
          ${!isFeatured ? '<button type="button" class="media-set-featured-btn" title="Set as featured image">Set as Featured</button>' : ''}
          <button type="button" class="media-preview-remove" data-index="${idx}" title="Remove image">&times;</button>
        `;
        mediaPreviewGrid.appendChild(item);

        // Remove button
        item.querySelector('.media-preview-remove').addEventListener('click', (ev) => {
          ev.stopPropagation();
          removeFileAtIndex(idx);
        });

        // Set as featured button or clicking card
        const setFeaturedBtn = item.querySelector('.media-set-featured-btn');
        if (setFeaturedBtn) {
          setFeaturedBtn.addEventListener('click', (ev) => {
            ev.stopPropagation();
            featuredIndex = idx;
            if (featuredImageIndexInput) featuredImageIndexInput.value = featuredIndex;
            renderMediaPreviews();
          });
        }

        item.addEventListener('click', (ev) => {
          if (ev.target.closest('.media-preview-remove')) return;
          featuredIndex = idx;
          if (featuredImageIndexInput) featuredImageIndexInput.value = featuredIndex;
          renderMediaPreviews();
        });
      };
      reader.readAsDataURL(file);
    });
  }

  function removeFileAtIndex(idxToRemove) {
    const newDT = new DataTransfer();
    Array.from(selectedFilesDT.files).forEach((f, idx) => {
      if (idx !== idxToRemove) {
        newDT.items.add(f);
      }
    });
    selectedFilesDT = newDT;
    if (productMediaInput) {
      productMediaInput.files = selectedFilesDT.files;
    }

    if (featuredIndex === idxToRemove) {
      featuredIndex = 0;
    } else if (featuredIndex > idxToRemove) {
      featuredIndex--;
    }

    renderMediaPreviews();
  }

  function addFiles(filesList) {
    Array.from(filesList).forEach(file => {
      if (file.type && file.type.startsWith('image/')) {
        selectedFilesDT.items.add(file);
      }
    });
    if (productMediaInput) {
      productMediaInput.files = selectedFilesDT.files;
    }
    renderMediaPreviews();
  }

  if (mediaDropzone && productMediaInput) {
    mediaDropzone.addEventListener('click', () => productMediaInput.click());

    productMediaInput.addEventListener('change', function () {
      if (this.files && this.files.length > 0) {
        addFiles(this.files);
      }
    });

    mediaDropzone.addEventListener('dragover', (e) => {
      e.preventDefault();
      mediaDropzone.classList.add('drag-over');
    });

    mediaDropzone.addEventListener('dragleave', (e) => {
      e.preventDefault();
      mediaDropzone.classList.remove('drag-over');
    });

    mediaDropzone.addEventListener('drop', (e) => {
      e.preventDefault();
      mediaDropzone.classList.remove('drag-over');
      if (e.dataTransfer && e.dataTransfer.files) {
        addFiles(e.dataTransfer.files);
      }
    });
  }

  // ==========================================================================
  // 4. SHOPIFY-STYLE DYNAMIC VARIANTS MANAGER (NO HARDCODED DEFAULTS)
  // ==========================================================================
  const hasVariantsToggle = document.getElementById('hasVariantsToggle');
  const variantsOptionsWrapper = document.getElementById('variantsOptionsWrapper');
  const optionsListContainer = document.getElementById('optionsListContainer');
  const addAnotherOptionLink = document.getElementById('addAnotherOptionLink');
  const variantsTableBody = document.getElementById('variantsTableBody');
  const bulkEditModalBtn = document.getElementById('bulkEditModalBtn');

  let optionCount = 0;

  // Toggle Variants Section Display
  if (hasVariantsToggle) {
    hasVariantsToggle.addEventListener('change', function () {
      if (this.checked) {
        if (variantsOptionsWrapper) variantsOptionsWrapper.style.display = 'block';
        if (bulkEditModalBtn) bulkEditModalBtn.style.display = 'inline-flex';
        // If no options exist, initialize with Option 1
        if (optionsListContainer && optionsListContainer.children.length === 0) {
          addOptionRow('Option 1');
        }
        rebuildVariantsMatrix();
      } else {
        if (variantsOptionsWrapper) variantsOptionsWrapper.style.display = 'none';
        if (bulkEditModalBtn) bulkEditModalBtn.style.display = 'none';
      }
    });
  }

  // Helper function to create a Pill Tag
  function createPill(valText) {
    const span = document.createElement('span');
    span.className = 'variant-pill-tag';
    span.setAttribute('data-val', valText);
    span.innerHTML = `<span class="pill-text">${valText}</span> <button type="button" class="pill-remove" title="Remove">&times;</button>`;
    return span;
  }

  // Add Option Row Dynamically
  function addOptionRow(suggestedName = '') {
    if (!optionsListContainer) return;
    optionCount++;
    const optId = 'opt-' + Date.now() + '-' + optionCount;

    const row = document.createElement('div');
    row.className = 'variant-option-row';
    row.setAttribute('data-option-id', optId);
    row.innerHTML = `
      <div class="variant-drag-handle" title="Drag to reorder">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
          <circle cx="9" cy="6" r="1.5"></circle>
          <circle cx="15" cy="6" r="1.5"></circle>
          <circle cx="9" cy="12" r="1.5"></circle>
          <circle cx="15" cy="12" r="1.5"></circle>
          <circle cx="9" cy="18" r="1.5"></circle>
          <circle cx="15" cy="18" r="1.5"></circle>
        </svg>
      </div>
      <div class="variant-option-content" style="flex:1;">
        <div class="variant-option-header-wrap" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
          <input type="text" class="custom-option-name-input" value="${suggestedName}" placeholder="Option name (e.g. Size, Color, Flavor)">
          <button type="button" class="btn-remove-custom-option" title="Delete Option">
            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
          </button>
        </div>
        <div class="variant-pills-list">
          <div class="pills-holder" style="display:inline-flex; flex-wrap:wrap; gap:8px;"></div>
          <div class="inline-tag-input-wrap">
            <input type="text" class="inline-tag-input inline-option-value-input" placeholder="+ Add value (press Enter)">
          </div>
        </div>
      </div>
    `;

    optionsListContainer.appendChild(row);

    const nameInput = row.querySelector('.custom-option-name-input');
    const valInput = row.querySelector('.inline-option-value-input');
    const pillsHolder = row.querySelector('.pills-holder');
    const removeBtn = row.querySelector('.btn-remove-custom-option');

    // Remove option
    removeBtn.addEventListener('click', () => {
      row.remove();
      rebuildVariantsMatrix();
    });

    // Update table on option name change
    nameInput.addEventListener('input', () => {
      rebuildVariantsMatrix();
    });

    // Add pill on Enter or comma
    valInput.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ',') {
        e.preventDefault();
        const trimmed = valInput.value.trim().replace(/^,|,$/g, '');
        if (!trimmed) return;

        // Check if duplicate
        const existing = Array.from(pillsHolder.querySelectorAll('.variant-pill-tag')).some(
          p => (p.getAttribute('data-val') || '').toLowerCase() === trimmed.toLowerCase()
        );
        if (!existing) {
          const pill = createPill(trimmed);
          pillsHolder.appendChild(pill);
          valInput.value = '';
          rebuildVariantsMatrix();
        } else {
          valInput.value = '';
        }
      }
    });

    // Focus input
    if (!suggestedName) {
      nameInput.focus();
    } else {
      valInput.focus();
    }
  }

  if (addAnotherOptionLink) {
    addAnotherOptionLink.addEventListener('click', (e) => {
      e.preventDefault();
      const currentCount = optionsListContainer ? optionsListContainer.children.length : 0;
      addOptionRow(`Option ${currentCount + 1}`);
    });
  }

  // Handle Pill Tag Removal
  document.addEventListener('click', (e) => {
    const pillRemoveBtn = e.target.closest('.pill-remove');
    if (pillRemoveBtn) {
      const pill = pillRemoveBtn.closest('.variant-pill-tag');
      if (pill) {
        pill.remove();
        rebuildVariantsMatrix();
      }
    }
  });

  // Rebuild the Variant Matrix Table from Options
  function rebuildVariantsMatrix() {
    if (!variantsTableBody || !optionsListContainer) return;

    // Collect options and their values
    const optionRows = optionsListContainer.querySelectorAll('.variant-option-row');
    const optionsData = [];

    optionRows.forEach((row, idx) => {
      const nameInput = row.querySelector('.custom-option-name-input');
      const optName = nameInput ? nameInput.value.trim() : `Option ${idx + 1}`;
      const pills = row.querySelectorAll('.pills-holder .variant-pill-tag');
      const values = Array.from(pills).map(p => p.getAttribute('data-val') || p.textContent.replace('×', '').trim()).filter(Boolean);

      if (values.length > 0) {
        optionsData.push({ name: optName, values: values });
      }
    });

    // If no values in any options, show empty state
    if (optionsData.length === 0) {
      variantsTableBody.innerHTML = `
        <tr id="emptyVariantsRow">
          <td colspan="5" class="variant-empty-cell" style="padding: 24px; text-align: center; color: #64748b;">
            <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" style="margin: 0 auto 8px; display: block; stroke: #94a3b8;">
              <circle cx="12" cy="12" r="10"></circle>
              <line x1="12" y1="8" x2="12" y2="12"></line>
              <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
            No variant values added yet. Add an option name and values above to generate combinations.
          </td>
        </tr>
      `;
      return;
    }

    // Cartesian product of option values
    function cartesian(arr) {
      return arr.reduce((acc, curr) => {
        return acc.flatMap(c => curr.values.map(v => [...c, v]));
      }, [[]]);
    }

    const combinations = cartesian(optionsData);

    const basePriceEl = document.getElementById('productBasePrice');
    const basePrice = basePriceEl && basePriceEl.value ? parseFloat(basePriceEl.value).toFixed(2) : '14.50';

    const baseStockEl = document.getElementById('productStock');
    const baseStock = baseStockEl && baseStockEl.value ? parseInt(baseStockEl.value) : 25;

    const baseSkuEl = document.getElementById('productSku');
    const baseSku = baseSkuEl && baseSkuEl.value ? baseSkuEl.value.trim() : 'VH-PROD';

    variantsTableBody.innerHTML = '';

    combinations.forEach((combo, idx) => {
      const comboName = combo.join(' / ');
      const skuSuffix = combo.map(v => v.replace(/[^a-zA-Z0-9]/g, '').slice(0, 3).toUpperCase()).join('-');
      const rowSku = `${baseSku}-${skuSuffix || (idx + 1)}`;

      const tr = document.createElement('tr');
      tr.className = 'variant-matrix-row';
      tr.innerHTML = `
        <td>
          <div style="font-weight: 600; color: #0f172a; font-size: 13.5px;">${comboName}</div>
          <input type="hidden" name="variants[${idx}][name]" value="${comboName}">
        </td>
        <td>
          <input type="text" name="variants[${idx}][sku]" class="admin-form-input" style="height: 32px; font-size: 12px; padding: 4px 8px; max-width: 160px;" value="${rowSku}">
        </td>
        <td>
          <div class="variant-price-box" style="height: 32px; width: 110px; display: inline-flex; align-items: center; border: 1px solid #cbd5e1; border-radius: 4px; padding: 0 8px; background: #fff;">
            <span style="color: #64748b; font-size: 13px; margin-right: 4px;">$</span>
            <input type="number" step="0.01" name="variants[${idx}][price]" class="variant-price-input" value="${basePrice}" style="border: none; outline: none; width: 100%; font-size: 13px; font-weight: 500;">
          </div>
        </td>
        <td>
          <input type="number" name="variants[${idx}][stock]" class="admin-form-input" style="height: 32px; width: 85px; font-size: 13px; padding: 4px 8px;" value="${baseStock}" min="0">
        </td>
        <td class="text-right">
          <button type="button" class="btn-remove-variant-row" title="Delete variant combination">&times;</button>
        </td>
      `;

      tr.querySelector('.btn-remove-variant-row').addEventListener('click', () => {
        tr.remove();
        if (variantsTableBody.children.length === 0) {
          variantsTableBody.innerHTML = `
            <tr id="emptyVariantsRow">
              <td colspan="5" class="variant-empty-cell" style="padding: 24px; text-align: center; color: #64748b;">
                All variant combinations removed.
              </td>
            </tr>
          `;
        }
      });

      variantsTableBody.appendChild(tr);
    });
  }

  // Bulk Edit Variants Modal Handler
  const applyBulkEditBtn = document.getElementById('applyBulkEdit');
  if (applyBulkEditBtn) {
    applyBulkEditBtn.addEventListener('click', () => {
      const bulkPrice = document.getElementById('bulkPriceInput') ? document.getElementById('bulkPriceInput').value : '';
      const bulkStock = document.getElementById('bulkStockInput') ? document.getElementById('bulkStockInput').value : '';

      if (bulkPrice) {
        document.querySelectorAll('.variant-price-input').forEach(input => input.value = bulkPrice);
      }
      if (bulkStock) {
        document.querySelectorAll('input[name*="[stock]"]').forEach(input => input.value = bulkStock);
      }
      const bulkModal = document.getElementById('bulkEditModal');
      if (bulkModal && window.adminCloseModal) window.adminCloseModal(bulkModal);
    });
  }

  // ==========================================================================
  // 5. Dynamic Tags Input Chip Handler
  // ==========================================================================
  const tagInputField = document.getElementById('tagInputField');
  const tagsContainer = document.getElementById('tagsContainer');

  if (tagInputField && tagsContainer) {
    function addTag(val) {
      const trimmed = val.trim().replace(/^,|,$/g, '');
      if (!trimmed) return;
      const chip = document.createElement('span');
      chip.className = 'tag-chip';
      chip.innerHTML = `
        <span>${trimmed}</span>
        <button type="button" class="tag-chip-remove" title="Remove tag">&times;</button>
      `;
      tagsContainer.appendChild(chip);
    }

    tagInputField.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ',') {
        e.preventDefault();
        addTag(tagInputField.value);
        tagInputField.value = '';
      }
    });
  }

  // Universal click delegation for tag chip cross buttons
  document.addEventListener('click', (e) => {
    const tagRemoveBtn = e.target.closest('.tag-chip-remove');
    if (tagRemoveBtn) {
      const chip = tagRemoveBtn.closest('.tag-chip');
      if (chip) {
        chip.style.transition = 'opacity 0.15s ease, transform 0.15s ease';
        chip.style.opacity = '0';
        chip.style.transform = 'scale(0.8)';
        setTimeout(() => chip.remove(), 150);
      }
    }
  });

  // ==========================================================================
  // 6. Form Submit Handler: Sync RTE and Tags
  // ==========================================================================
  const productForm = document.getElementById('productMainForm');
  if (productForm) {
    productForm.addEventListener('submit', () => {
      const rteContent = document.querySelector('.rte-editor-content');
      const descTextarea = document.querySelector('textarea[name="description"]');
      if (rteContent && descTextarea) {
        descTextarea.value = rteContent.innerHTML;
      }

      const tagChips = document.querySelectorAll('#tagsContainer .tag-chip span');
      if (tagChips.length > 0) {
        const tagsArray = Array.from(tagChips).map(c => c.textContent.trim());
        let tagsInput = document.getElementById('tagsHiddenInput');
        if (!tagsInput) {
          tagsInput = document.createElement('input');
          tagsInput.type = 'hidden';
          tagsInput.name = 'tags';
          tagsInput.id = 'tagsHiddenInput';
          productForm.appendChild(tagsInput);
        }
        tagsInput.value = tagsArray.join(', ');
      }
    });
  }
});
