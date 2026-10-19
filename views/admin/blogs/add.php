<?php
$page_title = 'Add Blog Post | Vape Store Admin';
$current_admin_page = 'blogs';
include dirname(__DIR__) . '/includes/header.php';
?>

<form action="<?= url('admin/blogs/store') ?>" method="POST" id="blogPostForm">
  <!-- Title & Action Bar -->
  <div class="page-title-bar">
    <div class="page-heading-group" style="display: flex; align-items: center; gap: 14px;">
      <a href="<?= url('admin/blogs') ?>" class="btn-action-icon" title="Back to blogs">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="19" y1="12" x2="5" y2="12"></line>
          <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
      </a>
      <div>
        <h1 style="margin: 0;">Add Blog Post</h1>
        <p class="page-subtitle" style="margin: 0;">Write and publish a new vape guide, device review, or news article.</p>
      </div>
    </div>
    <div class="page-actions-group">
      <a href="<?= url('admin/blogs') ?>" class="btn-admin btn-admin-outline">Discard</a>
      <button type="submit" class="btn-admin btn-admin-primary">Save Blog Post</button>
    </div>
  </div>

  <?php if (!empty($error)): ?>
  <div class="admin-alert admin-alert-danger mb-lg">
    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
      <circle cx="12" cy="12" r="10"></circle>
      <line x1="12" y1="8" x2="12" y2="12"></line>
      <line x1="12" y1="16" x2="12.01" y2="16"></line>
    </svg>
    <span><?= e($error) ?></span>
  </div>
  <?php endif; ?>

  <!-- Two-Column Form Layout -->
  <div class="admin-form-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start;">
    
    <!-- LEFT MAIN COLUMN -->
    <div class="form-main-col" style="display: flex; flex-direction: column; gap: 24px;">
      
      <!-- Card: Blog Title & Slug -->
      <div class="admin-card" style="padding: 24px;">
        <div class="admin-form-group">
          <label class="admin-form-label" style="font-weight: 700; font-size: 14px;">Blog Title <span style="color:#ef4444;">*</span></label>
          <input 
            type="text" 
            name="title" 
            id="blogTitleInput" 
            class="admin-form-input" 
            placeholder="e.g. Can You Refill a Foger Vape? Everything Explained" 
            required
            style="font-size: 16px; padding: 12px 14px;"
          >
        </div>

        <div class="admin-form-group" style="margin-bottom: 0;">
          <label class="admin-form-label" style="font-size: 13px;">URL Handle (Slug)</label>
          <div style="display: flex; align-items: center; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; background: #f8fafc;">
            <span style="padding: 0 12px; color: #64748b; font-size: 13px; font-weight: 500; border-right: 1px solid #e2e8f0;">/blog/</span>
            <input 
              type="text" 
              name="slug" 
              id="blogSlugInput" 
              class="admin-form-input" 
              placeholder="can-you-refill-foger-vape" 
              style="border: none; border-radius: 0; background: #ffffff;"
            >
          </div>
          <small style="color: #94a3b8; font-size: 12px; margin-top: 4px; display: block;">Auto-generated from title. Unique lowercase letters, numbers, and hyphens only.</small>
        </div>
      </div>

      <!-- Card: Content Body -->
      <div class="admin-card" style="padding: 24px;">
        <div class="admin-form-group" style="margin-bottom: 0;">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
            <label class="admin-form-label" style="font-weight: 700; font-size: 14px; margin: 0;">Article Content (HTML / Text)</label>
            <span style="font-size: 12px; color: #64748b;">Supports rich paragraphs, headings and lists</span>
          </div>
          <textarea 
            name="content" 
            id="blogContentInput" 
            class="admin-form-textarea" 
            rows="14" 
            placeholder="<p>Write your detailed article content here...</p>" 
            style="font-family: monospace; font-size: 13.5px; line-height: 1.6;"
          ></textarea>
        </div>
      </div>

      <!-- Card: SEO & Search Engine Listing Preview -->
      <div class="admin-card" style="padding: 24px;">
        <div style="margin-bottom: 18px;">
          <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;">Search Engine Listing</h3>
          <p style="font-size: 13px; color: #64748b; margin: 0;">Preview and customize how this article appears on Google and social media.</p>
        </div>

        <div class="admin-form-group">
          <div style="display: flex; justify-content: space-between;">
            <label class="admin-form-label">SEO Page Title</label>
            <span id="seoTitleCount" style="font-size: 12px; color: #94a3b8;">0 / 70</span>
          </div>
          <input type="text" name="seo_title" id="seoTitleInput" class="admin-form-input" placeholder="SEO Title" maxlength="70">
        </div>

        <div class="admin-form-group">
          <div style="display: flex; justify-content: space-between;">
            <label class="admin-form-label">Meta Description</label>
            <span id="seoDescCount" style="font-size: 12px; color: #94a3b8;">0 / 320</span>
          </div>
          <textarea name="seo_description" id="seoDescInput" class="admin-form-textarea" rows="3" placeholder="Summary snippet for search engine rankings..." maxlength="320"></textarea>
        </div>

        <!-- Google SERP Live Snippet -->
        <div class="seo-preview-card" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px; margin-top: 14px;">
          <div style="font-size: 12px; color: #64748b; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
            <span><?= url() ?> &rsaquo; blog &rsaquo; <span id="previewSlug">post-handle</span></span>
          </div>
          <div id="previewTitle" style="font-size: 16px; font-weight: 600; color: #1e40af; margin-bottom: 4px; line-height: 1.3;">Article Title</div>
          <div id="previewDesc" style="font-size: 13px; color: #475569; line-height: 1.45;">Write a concise meta description to see live snippet preview here.</div>
        </div>
      </div>

    </div>

    <!-- RIGHT SIDEBAR COLUMN -->
    <div class="form-sidebar-col" style="display: flex; flex-direction: column; gap: 20px;">
      
      <!-- Visibility Card -->
      <div class="admin-card" style="padding: 20px;">
        <h4 style="font-size: 14px; font-weight: 700; margin: 0 0 12px 0;">Publishing Visibility</h4>
        <select name="status" class="admin-form-select" style="width: 100%;">
          <option value="active" selected>Visible (Published)</option>
          <option value="hidden">Hidden (Draft)</option>
        </select>
        <small style="color: #94a3b8; font-size: 12px; margin-top: 6px; display: block;">Visible articles appear on the storefront and blog roll.</small>
      </div>

      <!-- Category Card -->
      <div class="admin-card" style="padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
          <h4 style="font-size: 14px; font-weight: 700; margin: 0;">Blog Category</h4>
          <a href="<?= url('admin/blog-categories') ?>" target="_blank" style="font-size: 12px; color: #5c56e8; text-decoration: none;">+ Manage</a>
        </div>
        <select name="category_id" class="admin-form-select" style="width: 100%;">
          <option value="">-- Select Category --</option>
          <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>"><?= e($cat['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Featured Image Card -->
      <div class="admin-card" style="padding: 20px;">
        <h4 style="font-size: 14px; font-weight: 700; margin: 0 0 12px 0;">Featured Image</h4>
        <div class="admin-form-group">
          <input 
            type="text" 
            name="featured_image_url" 
            id="featuredImageInput" 
            class="admin-form-input" 
            placeholder="assets/images/blog-1.jpg"
            value="assets/images/blog-1.jpg"
          >
        </div>
        <!-- Live Preview Thumbnail -->
        <div style="width: 100%; height: 160px; border-radius: 8px; overflow: hidden; background: #f8fafc; border: 1px solid #e2e8f0; position: relative; margin-top: 10px;">
          <img 
            id="featuredImagePreview" 
            src="<?= url('assets/images/blog-1.jpg') ?>" 
            alt="Preview" 
            style="width: 100%; height: 100%; object-fit: cover;"
            onerror="this.onerror=null;this.src='<?= url('assets/images/no-image.svg') ?>';"
          >
        </div>
        <small style="color: #94a3b8; font-size: 12px; margin-top: 6px; display: block;">Image path relative to public directory or absolute URL.</small>
      </div>

      <!-- Excerpt Card -->
      <div class="admin-card" style="padding: 20px;">
        <h4 style="font-size: 14px; font-weight: 700; margin: 0 0 12px 0;">Excerpt (Summary)</h4>
        <textarea 
          name="excerpt" 
          id="excerptInput" 
          class="admin-form-textarea" 
          rows="4" 
          placeholder="Brief 1-2 sentence overview for home page and category listings..."
        ></textarea>
        <small style="color: #94a3b8; font-size: 12px; margin-top: 6px; display: block;">This summary appears on the homepage blog cards.</small>
      </div>

      <!-- Author & Read Time -->
      <div class="admin-card" style="padding: 20px;">
        <h4 style="font-size: 14px; font-weight: 700; margin: 0 0 12px 0;">Author &amp; Meta</h4>
        <div class="admin-form-group">
          <label class="admin-form-label" style="font-size: 12px;">Author Name</label>
          <input type="text" name="author_name" class="admin-form-input" value="New Vape Editorial" placeholder="Author name">
        </div>
        <div class="admin-form-group">
          <label class="admin-form-label" style="font-size: 12px;">Estimated Read Time</label>
          <input type="text" name="read_time" class="admin-form-input" value="5 min read" placeholder="e.g. 6 min read">
        </div>
        <div class="admin-form-group" style="margin-bottom: 0;">
          <label class="admin-form-label" style="font-size: 12px;">Tags (comma separated)</label>
          <input type="text" name="tags" class="admin-form-input" placeholder="Disposables, Vaping Guides, News">
        </div>
      </div>

    </div>

  </div>

  <!-- Sticky Bottom Save Bar -->
  <div class="admin-sticky-actions-bar" style="position: sticky; bottom: 0; background: #ffffff; border-top: 1px solid #e2e8f0; padding: 14px 28px; margin: 32px -32px -32px -32px; display: flex; justify-content: space-between; align-items: center; z-index: 10; box-shadow: 0 -4px 16px rgba(15, 23, 42, 0.04);">
    <a href="<?= url('admin/blogs') ?>" class="btn-admin btn-admin-outline">Discard</a>
    <button type="submit" class="btn-admin btn-admin-primary" style="padding: 0 24px;">Save Blog Post</button>
  </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const titleInput = document.getElementById('blogTitleInput');
  const slugInput = document.getElementById('blogSlugInput');
  const seoTitleInput = document.getElementById('seoTitleInput');
  const seoDescInput = document.getElementById('seoDescInput');
  const excerptInput = document.getElementById('excerptInput');
  const previewTitle = document.getElementById('previewTitle');
  const previewDesc = document.getElementById('previewDesc');
  const previewSlug = document.getElementById('previewSlug');
  const seoTitleCount = document.getElementById('seoTitleCount');
  const seoDescCount = document.getElementById('seoDescCount');
  const imgInput = document.getElementById('featuredImageInput');
  const imgPreview = document.getElementById('featuredImagePreview');

  // Slug generator
  titleInput.addEventListener('input', () => {
    if (!slugInput.dataset.manual) {
      const generated = titleInput.value.toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');
      slugInput.value = generated;
      previewSlug.textContent = generated || 'post-handle';
    }
    if (!seoTitleInput.value) {
      previewTitle.textContent = titleInput.value || 'Article Title';
    }
  });

  slugInput.addEventListener('input', () => {
    slugInput.dataset.manual = 'true';
    previewSlug.textContent = slugInput.value || 'post-handle';
  });

  seoTitleInput.addEventListener('input', () => {
    seoTitleCount.textContent = `${seoTitleInput.value.length} / 70`;
    previewTitle.textContent = seoTitleInput.value || titleInput.value || 'Article Title';
  });

  seoDescInput.addEventListener('input', () => {
    seoDescCount.textContent = `${seoDescInput.value.length} / 320`;
    previewDesc.textContent = seoDescInput.value || excerptInput.value || 'Write a concise meta description...';
  });

  excerptInput.addEventListener('input', () => {
    if (!seoDescInput.value) {
      previewDesc.textContent = excerptInput.value || 'Write a concise meta description...';
    }
  });

  // Featured image preview
  imgInput.addEventListener('input', () => {
    let val = imgInput.value.trim();
    if (val && !val.startsWith('http') && !val.startsWith('/')) {
      val = '<?= url() ?>/' + val;
    }
    imgPreview.src = val || '<?= url("assets/images/no-image.svg") ?>';
  });
});
</script>

<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
