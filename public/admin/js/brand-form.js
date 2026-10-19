/**
 * New Vape - Brand Form (Add & Edit) JavaScript
 * Handles brand logo uploader, cross remove button, and real-time SEO preview
 */

document.addEventListener('DOMContentLoaded', () => {
  // 1. Elements & Live SEO Preview
  const toggleSeoBtn = document.getElementById('toggleSeoBtn');
  const seoFieldsContainer = document.getElementById('seoFieldsContainer');
  const brandNameInput = document.getElementById('brandName') || document.querySelector('input[name="name"]');
  const brandDescInput = document.getElementById('brandDescription') || document.querySelector('textarea[name="description"]');
  const seoTitleInput = document.getElementById('seoTitleInput');
  const seoDescInput = document.getElementById('seoDescInput');
  const slugInput = document.getElementById('slugInput');
  const seoTitleCount = document.getElementById('seoTitleCount');
  const seoDescCount = document.getElementById('seoDescCount');
  const seoPreviewTitle = document.getElementById('seoPreviewTitle');
  const seoPreviewDesc = document.getElementById('seoPreviewDesc');
  const seoPreviewUrl = document.getElementById('seoPreviewUrl');

  const prefixSpan = document.querySelector('.input-prefix-container .prefix');
  const urlPrefix = prefixSpan ? prefixSpan.textContent.trim() : 'http://localhost/vapefinalwebsite/brand/';

  if (toggleSeoBtn && seoFieldsContainer) {
    toggleSeoBtn.addEventListener('click', (e) => {
      e.preventDefault();
      seoFieldsContainer.classList.toggle('active');
    });
  }

  function updateSeoPreview() {
    const brandName = brandNameInput ? brandNameInput.value.trim() : '';
    const brandDesc = brandDescInput ? brandDescInput.value.trim() : '';
    const customTitle = seoTitleInput ? seoTitleInput.value.trim() : '';
    const customDesc = seoDescInput ? seoDescInput.value.trim() : '';
    const currentSlug = slugInput ? slugInput.value.trim() : '';

    // Title preview: priority to custom SEO title, then brand name, then default
    if (seoPreviewTitle) {
      if (customTitle) {
        seoPreviewTitle.textContent = customTitle;
      } else if (brandName) {
        seoPreviewTitle.textContent = brandName + ' Official Store | New Vape';
      } else {
        seoPreviewTitle.textContent = 'Brand Name';
      }
    }

    // Description preview: priority to custom SEO desc, then brand description, then default
    if (seoPreviewDesc) {
      if (customDesc) {
        seoPreviewDesc.textContent = customDesc;
      } else if (brandDesc) {
        seoPreviewDesc.textContent = brandDesc;
      } else {
        seoPreviewDesc.textContent = 'Brand description will appear in search results...';
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
  const watchInputs = [brandNameInput, brandDescInput, seoTitleInput, seoDescInput, slugInput];
  watchInputs.forEach(input => {
    if (!input) return;
    ['input', 'keyup', 'change', 'paste'].forEach(evt => {
      input.addEventListener(evt, () => {
        if (input === slugInput) {
          slugInput.dataset.touched = 'true';
        }
        if (input === brandNameInput && slugInput && !slugInput.dataset.touched) {
          const autoSlug = brandNameInput.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
          slugInput.value = autoSlug;
        }
        updateSeoPreview();
      });
    });
  });

  // Run immediately on page load
  updateSeoPreview();

  // 2. Brand Logo Box Upload & Preview & Remove Cross Button
  const brandImageBox = document.getElementById('brandImageBox');
  const brandLogoInput = document.getElementById('brandLogoInput');
  const brandPreviewImg = document.getElementById('brandPreviewImg');
  const brandUploadIcon = document.getElementById('brandUploadIcon');
  const btnRemoveBrandLogo = document.getElementById('btnRemoveBrandLogo');
  const brandLogoUrl = document.getElementById('brandLogoUrl');

  // Trigger file selection when logo box is clicked (excluding remove button)
  if (brandImageBox && brandLogoInput) {
    brandImageBox.addEventListener('click', (e) => {
      if (e.target.closest('#btnRemoveBrandLogo')) return;
      brandLogoInput.click();
    });
  }

  // Handle selected logo file preview
  if (brandLogoInput) {
    brandLogoInput.addEventListener('change', function() {
      if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = (e) => {
          if (brandPreviewImg) {
            brandPreviewImg.src = e.target.result;
            brandPreviewImg.classList.remove('d-none');
          }
          if (brandUploadIcon) brandUploadIcon.classList.add('d-none');
          if (btnRemoveBrandLogo) btnRemoveBrandLogo.classList.remove('d-none');
        };
        reader.readAsDataURL(this.files[0]);
      }
    });
  }

  // Cross / Remove Button click handler
  if (btnRemoveBrandLogo) {
    btnRemoveBrandLogo.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      e.stopImmediatePropagation();

      if (brandLogoInput) {
        brandLogoInput.value = '';
      }
      if (brandLogoUrl) {
        brandLogoUrl.value = '';
      }
      if (brandPreviewImg) {
        brandPreviewImg.src = '';
        brandPreviewImg.classList.add('d-none');
      }
      btnRemoveBrandLogo.classList.add('d-none');
      if (brandUploadIcon) {
        brandUploadIcon.classList.remove('d-none');
      }
    });
  }

  // Handle broken image error fallback
  if (brandPreviewImg) {
    brandPreviewImg.addEventListener('error', function() {
      this.classList.add('d-none');
      if (brandUploadIcon) brandUploadIcon.classList.remove('d-none');
      if (btnRemoveBrandLogo) btnRemoveBrandLogo.classList.add('d-none');
    });
  }
});
