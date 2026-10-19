/**
 * New Vape - Edit Product Page JavaScript
 * Handles Shopify-style Rich Editor, Existing Variants Modifier, Media Gallery, Tags, and Live SEO Preview
 */

document.addEventListener('DOMContentLoaded', () => {
  // 1. Search Engine Listing (SEO) Live Preview & Toggle
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

  // 2. Rich Text Editor (RTE) Toolbar Execution
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

  // 3. Multi-Media Gallery Uploader & Previews
  const productMediaInput = document.getElementById('productMediaInput');
  const mediaDropzone = document.getElementById('mediaDropzone');
  const mediaPreviewGrid = document.getElementById('mediaPreviewGrid');

  const featuredImageIndexInput = document.getElementById('featuredImageIndex');
  let editFilesDT = new DataTransfer();
  let editFeaturedIndex = 0;

  function renderNewMediaPreviews() {
    if (!mediaPreviewGrid) return;
    
    // Remove previously rendered new previews, but keep existing server-side ones
    mediaPreviewGrid.querySelectorAll('.media-preview-item[data-new="1"]').forEach(el => el.remove());

    if (editFilesDT.files.length > 0) {
      mediaPreviewGrid.classList.remove('d-none');
      mediaPreviewGrid.style.display = 'grid';
    }

    if (editFeaturedIndex >= editFilesDT.files.length) {
      editFeaturedIndex = 0;
    }
    if (featuredImageIndexInput) {
      featuredImageIndexInput.value = editFeaturedIndex;
    }

    Array.from(editFilesDT.files).forEach((file, idx) => {
      const isFeatured = (idx === editFeaturedIndex);
      const reader = new FileReader();
      reader.onload = (e) => {
        const item = document.createElement('div');
        item.className = 'media-preview-item' + (isFeatured ? ' is-featured' : '');
        item.setAttribute('data-new', '1');
        item.innerHTML = `
          <img src="${e.target.result}" alt="${file.name}">
          ${isFeatured ? '<span class="media-preview-badge">★ Featured</span>' : ''}
          ${!isFeatured ? '<button type="button" class="media-set-featured-btn" title="Set as featured image">Set as Featured</button>' : ''}
          <button type="button" class="media-preview-remove" title="Remove">&times;</button>
        `;
        mediaPreviewGrid.appendChild(item);

        item.querySelector('.media-preview-remove').addEventListener('click', (ev) => {
          ev.stopPropagation();
          removeEditFileAtIndex(idx);
        });

        const setFeaturedBtn = item.querySelector('.media-set-featured-btn');
        if (setFeaturedBtn) {
          setFeaturedBtn.addEventListener('click', (ev) => {
            ev.stopPropagation();
            editFeaturedIndex = idx;
            if (featuredImageIndexInput) featuredImageIndexInput.value = editFeaturedIndex;
            renderNewMediaPreviews();
          });
        }

        item.addEventListener('click', (ev) => {
          if (ev.target.closest('.media-preview-remove')) return;
          editFeaturedIndex = idx;
          if (featuredImageIndexInput) featuredImageIndexInput.value = editFeaturedIndex;
          renderNewMediaPreviews();
        });
      };
      reader.readAsDataURL(file);
    });
  }

  function removeEditFileAtIndex(idxToRemove) {
    const newDT = new DataTransfer();
    Array.from(editFilesDT.files).forEach((f, idx) => {
      if (idx !== idxToRemove) {
        newDT.items.add(f);
      }
    });
    editFilesDT = newDT;
    if (productMediaInput) {
      productMediaInput.files = editFilesDT.files;
    }

    if (editFeaturedIndex === idxToRemove) {
      editFeaturedIndex = 0;
    } else if (editFeaturedIndex > idxToRemove) {
      editFeaturedIndex--;
    }

    renderNewMediaPreviews();
  }

  function addEditFiles(filesList) {
    Array.from(filesList).forEach(file => {
      if (file.type && file.type.startsWith('image/')) {
        editFilesDT.items.add(file);
      }
    });
    if (productMediaInput) {
      productMediaInput.files = editFilesDT.files;
    }
    renderNewMediaPreviews();
  }

  if (mediaDropzone && productMediaInput) {
    mediaDropzone.addEventListener('click', () => productMediaInput.click());

    productMediaInput.addEventListener('change', function () {
      if (this.files && this.files.length > 0) {
        addEditFiles(this.files);
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
        addEditFiles(e.dataTransfer.files);
      }
    });
  }

  // Remove existing media items
  document.querySelectorAll('.media-preview-remove').forEach(btn => {
    btn.addEventListener('click', function() {
      const item = this.closest('.media-preview-item');
      if (item) item.remove();
    });
  });

  // 4. Existing Variants Accordion & Interactions
  document.addEventListener('click', (e) => {
    // Master Toggle (#toggleAllSubrows in <thead>)
    const masterToggleBtn = e.target.closest('#toggleAllSubrows');
    if (masterToggleBtn) {
      e.stopPropagation();
      const allSubrows = document.querySelectorAll('.variant-subrow');
      const allToggleBtns = document.querySelectorAll('.variant-toggle-btn');
      const anyClosed = Array.from(allSubrows).some(r => !r.classList.contains('show'));

      if (anyClosed) {
        allSubrows.forEach(r => r.classList.add('show'));
        allToggleBtns.forEach(b => b.classList.add('open'));
      } else {
        allSubrows.forEach(r => r.classList.remove('show'));
        allToggleBtns.forEach(b => b.classList.remove('open'));
      }
      return;
    }

    // Individual Row Toggle Button
    const toggleBtn = e.target.closest('.variant-toggle-btn');
    if (toggleBtn) {
      e.stopPropagation();
      const group = toggleBtn.getAttribute('data-toggle-group');
      if (group) {
        const subrows = document.querySelectorAll(`.variant-subrow.${group}`);
        const willShow = !toggleBtn.classList.contains('open');
        toggleBtn.classList.toggle('open', willShow);
        subrows.forEach(r => r.classList.toggle('show', willShow));
      }
      return;
    }

    // Parent row click
    const parentRow = e.target.closest('.variant-parent-row');
    if (parentRow && !e.target.closest('input') && !e.target.closest('button') && !e.target.closest('a') && !e.target.closest('select')) {
      const rowBtn = parentRow.querySelector('.variant-toggle-btn');
      if (rowBtn) rowBtn.click();
    }
  });

  // Bulk Edit Variants Modal Handler
  const applyBulkEditBtn = document.getElementById('applyBulkEdit');
  if (applyBulkEditBtn) {
    applyBulkEditBtn.addEventListener('click', () => {
      const bulkPrice = document.getElementById('bulkPriceInput') ? document.getElementById('bulkPriceInput').value : '';
      const bulkStock = document.getElementById('bulkStockInput') ? document.getElementById('bulkStockInput').value : '';

      if (bulkPrice) {
        document.querySelectorAll('.variant-price-input, .variant-subprice-input').forEach(input => input.value = bulkPrice);
      }
      if (bulkStock) {
        document.querySelectorAll('.variant-stock-input').forEach(input => input.value = bulkStock);
      }
      const bulkModal = document.getElementById('bulkEditModal');
      if (bulkModal && window.adminCloseModal) window.adminCloseModal(bulkModal);
    });
  }

  // Dynamic Tags Input Chip Handler
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

  // Form Submit Handler: Sync RTE and Tags
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
