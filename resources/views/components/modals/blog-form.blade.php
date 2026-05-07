{{-- Blog Article Creation/Edit Form Modal --}}
<x-modal id="blogArticleModal" title="Rédiger un nouvel article" size="lg">
  <form id="blogArticleForm" class="blog-form">
    {{-- Title with Character Counter --}}
    <div class="form-group">
      <label class="form-label">
        Titre 
        <span class="form-hint" id="titleCounter">— 0/80 caractères</span>
      </label>
      <input 
        type="text" 
        class="form-input" 
        id="blogTitle" 
        name="title" 
        placeholder="Ex: 5 techniques essentielles pour améliorer votre jeu"
        maxlength="80"
        oninput="updateSeoPreview(); updateCharCounter(this, 80, 'titleCounter')"
        required
      >
    </div>

    {{-- Category and Author --}}
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Catégorie</label>
        <select class="form-input" id="blogCategory" name="category" onchange="updateSeoPreview()" required>
          <option value="">Sélectionner une catégorie</option>
          <option value="Recrutement">Recrutement</option>
          <option value="Conseils carrière">Conseils carrière</option>
          <option value="Formation">Formation</option>
          <option value="Transferts">Transferts</option>
          <option value="Actualités foot">Actualités foot</option>
          <option value="Technologie & Data">Technologie & Data</option>
        </select>
      </div>
      <div class="form-group">
        <label class="form-label">Auteur</label>
        <select class="form-input" id="blogAuthor" name="author" required>
          <option value="">Sélectionner un auteur</option>
          <option value="Admin">Admin</option>
          <option value="Coach">Coach</option>
          <option value="Recruteur">Recruteur</option>
        </select>
      </div>
    </div>

    {{-- Excerpt with Character Counter --}}
    <div class="form-group">
      <label class="form-label">
        Extrait 
        <span class="form-hint" id="excerptCounter">— 0/200 caractères</span>
      </label>
      <textarea 
        class="form-input" 
        id="blogExcerpt" 
        name="excerpt" 
        rows="2"
        placeholder="Un court résumé de votre article (affiché dans les résultats de recherche)"
        maxlength="200"
        oninput="updateSeoPreview(); updateCharCounter(this, 200, 'excerptCounter')"
      ></textarea>
    </div>

    {{-- Main Content with Rich Text Editor --}}
    <div class="form-group">
      <label class="form-label">
        Contenu
        <span class="form-hint" id="wordCounter">— 0 mots</span>
      </label>
      <textarea 
        class="form-input blog-content-textarea" 
        id="blogContent" 
        name="content"
        placeholder="Écrivez le contenu complet de votre article..."
        required
        oninput="updateWordCount()"
      ></textarea>
    </div>

    {{-- Featured Image Upload --}}
    <x-image-upload 
      name="image" 
      label="Image de couverture"
      id="blogFeaturedImage"
      maxSize="5"
    />

    {{-- Meta SEO Fields --}}
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">
          Meta Titre
          <span class="form-hint" id="metaTitleCounter">— 0/60 caractères</span>
        </label>
        <input 
          type="text" 
          class="form-input" 
          id="metaTitle" 
          name="meta_title" 
          placeholder="Titre pour les moteurs de recherche"
          maxlength="60"
          oninput="updateCharCounter(this, 60, 'metaTitleCounter')"
        >
      </div>
      <div class="form-group">
        <label class="form-label">
          Meta Description
          <span class="form-hint" id="metaDescCounter">— 0/160 caractères</span>
        </label>
        <textarea 
          class="form-input" 
          id="metaDescription" 
          name="meta_description" 
          rows="2"
          placeholder="Description pour les moteurs de recherche"
          maxlength="160"
          oninput="updateCharCounter(this, 160, 'metaDescCounter')"
        ></textarea>
      </div>
    </div>

    {{-- Reading Time and Tags --}}
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Temps de lecture (minutes)</label>
        <input 
          type="number" 
          class="form-input" 
          id="readingTime" 
          name="reading_time" 
          min="1" 
          max="60" 
          value="5"
        >
      </div>
      <div class="form-group">
        <label class="form-label">Tags <span class="form-hint">(séparés par des virgules)</span></label>
        <input 
          type="text" 
          class="form-input" 
          id="blogTags" 
          name="tags" 
          placeholder="ex: football, recrutement, conseils"
        >
      </div>
    </div>

    {{-- Featured Toggle --}}
    <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.85rem 1rem; background: #f9faf9; border-radius: 10px; border: 1px solid var(--border); margin-bottom: 1.5rem;">
      <div>
        <div style="font-size: 0.88rem; font-weight: 600; color: var(--text);">Mettre à la une</div>
        <div style="font-size: 0.78rem; color: var(--muted); margin-top: 0.1rem;">Cet article apparaîtra en premier</div>
      </div>
      <div class="toggle-wrap">
        <label class="toggle">
          <input type="checkbox" id="isFeatured" name="is_featured">
          <span class="toggle-slider"></span>
        </label>
      </div>
    </div>

    {{-- Form Actions --}}
    <div style="display: flex; gap: 0.75rem; margin-top: 1.5rem;">
      <button type="button" class="btn btn-outline" style="flex: 1;" onclick="saveDraft()">
        Brouillon
      </button>
      <button type="button" class="btn btn-outline" style="flex: 1;" onclick="resetForm()">
        Réinitialiser
      </button>
      <button type="submit" class="btn btn-primary" style="flex: 1; justify-content: center;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
        Publier
      </button>
    </div>
  </form>
</x-modal>

<style>
  .blog-form {
    display: flex;
    flex-direction: column;
    gap: 1.15rem;
  }

  .blog-content-textarea {
    min-height: 150px;
    resize: vertical;
  }

  .form-hint {
    color: var(--muted);
    font-weight: 400;
    font-size: 0.7rem;
  }

  /* CKEditor 5 Custom Styling */
  .ck-editor__editable {
    min-height: 300px !important;
    border: 1px solid var(--border) !important;
    border-radius: var(--radius) !important;
    font-family: inherit !important;
  }

  .ck-toolbar {
    background: var(--white) !important;
    border: 1px solid var(--border) !important;
    border-bottom: none !important;
    border-radius: var(--radius) var(--radius) 0 0 !important;
  }

  .ck-content {
    font-size: 0.95rem;
  }
</style>

<!-- CKEditor 5 CDN -->
<script src="{{ asset('js/ckeditor.js') }}"></script>

<script>
  // Global blog editor state
  let currentBlogId = null;

  // Update character counter
  window.updateCharCounter = function(element, max, counterId) {
    const count = element.value.length;
    document.getElementById(counterId).textContent = `— ${count}/${max} caractères`;
  };

  // Update word count
  window.updateWordCount = function() {
    // Word count will be updated after CKEditor loads
    const content = document.querySelector('.ck-editor__editable').innerHTML;
    const plainText = new DOMParser().parseFromString(content, 'text/html').body.textContent;
    const words = plainText.trim().split(/\s+/).filter(w => w.length > 0).length;
    document.getElementById('wordCounter').textContent = `— ${words} mots`;
  };

  // Update SEO Preview live
  window.updateSeoPreview = function() {
    const title = document.getElementById('blogTitle').value || 'Votre titre d\'article';
    const excerpt = document.getElementById('blogExcerpt').value || 'Votre description ou extrait';
    const category = document.getElementById('blogCategory').value || '';

    // Generate slug from title
    const slug = title
      .toLowerCase()
      .replace(/[^\w\s-]/g, '')
      .replace(/\s+/g, '-')
      .replace(/-+/g, '-')
      .substring(0, 60);

    document.getElementById('seoTitle').textContent = title.substring(0, 60);
    document.getElementById('seoSlug').textContent = slug || 'votre-titre';
    document.getElementById('seoUrlPreview').textContent = slug || 'votre-titre';
    document.getElementById('seoDescription').textContent = excerpt.substring(0, 160);
    
    document.getElementById('seoTitleLength').textContent = title.length;
    document.getElementById('seoDescLength').textContent = excerpt.length;
  };

  // Image upload is now handled by the reusable image-upload component

  // Form submission - Publish
  document.getElementById('blogArticleForm').addEventListener('submit', function(e) {
    e.preventDefault();
    window.publishArticle();
  });

  // Save as Draft
  window.saveDraft = function() {
    const title = document.getElementById('blogTitle').value.trim();
    if (!title) {
      showToast('error', 'Le titre est obligatoire');
      return;
    }
    window.submitBlogForm('draft');
  };

  // Reset Form
  window.resetForm = function() {
    if (confirm('Êtes-vous sûr de vouloir réinitialiser le formulaire ?')) {
      document.getElementById('blogArticleForm').reset();
      document.getElementById('currentBlogId').value = '';
      currentBlogId = null;
      removeImage_blogFeaturedImage();
      updateSeoPreview();
      updateWordCount();
      document.getElementById('blogArticleModal').querySelector('.modal-title').textContent = 'Rédiger un nouvel article';
    }
  };

  // Publish Article
  window.publishArticle = function() {
    const title = document.getElementById('blogTitle').value.trim();
    const content = document.getElementById('blogContent').value.trim();
    const category = document.getElementById('blogCategory').value;

    if (!title) {
      showToast('error', 'Le titre est obligatoire');
      return;
    }
    if (!content) {
      showToast('error', 'Le contenu est obligatoire');
      return;
    }
    if (!category) {
      showToast('error', 'La catégorie est obligatoire');
      return;
    }

    window.submitBlogForm('published');
  };

  // Submit blog form to backend
  window.submitBlogForm = function(status) {
    const formData = new FormData(document.getElementById('blogArticleForm'));
    formData.append('status', status);

    // TODO: Send to backend
    console.log('Submitting blog form:', {
      status: status,
      title: document.getElementById('blogTitle').value,
      category: document.getElementById('blogCategory').value,
      author: document.getElementById('blogAuthor').value,
      excerpt: document.getElementById('blogExcerpt').value,
      content: document.getElementById('blogContent').value,
    });

    if (status === 'published') {
      showToast('success', 'Article publié avec succès!');
    } else {
      showToast('success', 'Article sauvegardé en brouillon');
    }

    // Close modal and reset
    ModalManager.close('blogArticleModal');
    document.getElementById('blogArticleForm').reset();
    removeImage_blogFeaturedImage();
    currentBlogId = null;
  };

  // Toast notification
  window.showToast = function(type, message) {
    const container = document.getElementById('toastContainer');
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.style.cssText = `
      background: ${type === 'success' ? 'var(--green)' : '#dc2626'};
      color: white;
      padding: 1rem 1.25rem;
      border-radius: var(--radius-sm);
      margin-bottom: 0.5rem;
      animation: slideIn 0.3s ease;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    `;
    toast.textContent = message;
    container.appendChild(toast);

    setTimeout(() => {
      toast.style.animation = 'slideOut 0.3s ease';
      setTimeout(() => toast.remove(), 300);
    }, 3500);
  };

  // Add toast animations if not already in CSS
  if (!document.getElementById('toastStyles')) {
    const style = document.createElement('style');
    style.id = 'toastStyles';
    style.textContent = `
      @keyframes slideIn {
        from { transform: translateX(400px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
      }
      @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(400px); opacity: 0; }
      }
    `;
    document.head.appendChild(style);
  }

  // Initialize SEO preview and CKEditor on load
  document.addEventListener('DOMContentLoaded', function() {
    updateSeoPreview();
    
    // Initialize CKEditor 5
    CKEDITOR.ClassicEditor.create(document.getElementById("blogContent"), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                toolbar: {
                    items: [
                        'exportPDF','exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                // Changing the language of the interface requires loading the language file using the <script> tag.
                // language: 'es',
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                placeholder: 'Welcome to CKEditor 5!',
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                fontSize: {
                    options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                    supportAllValues: true
                },
                // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                htmlSupport: {
                    allow: [
                        {
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }
                    ]
                },
                // Be careful with enabling previews
                // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                htmlEmbed: {
                    showPreviews: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                mention: {
                    feeds: [
                        {
                            marker: '@',
                            feed: [
                                '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                                '@sugar', '@sweet', '@topping', '@wafer'
                            ],
                            minimumCharacters: 1
                        }
                    ]
                },
                // The "super-build" contains more premium features that require additional configuration, disable them below.
                // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType
                    'MathType'
                ]
            }).then(editor => {
      // Update word count on content change
      editor.model.document.on('change:data', function() {
        window.updateWordCount();
      });

      // Sync textarea with editor content on form submit
      document.getElementById('blogArticleForm').addEventListener('submit', function() {
        document.getElementById('blogContent').value = editor.getData();
      });
    }).catch(err => {
      console.error('CKEditor initialization failed:', err);
    });
  });
</script>
