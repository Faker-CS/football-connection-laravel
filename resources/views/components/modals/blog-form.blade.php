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

    {{-- Main Content with Word Counter --}}
    <div class="form-group">
      <label class="form-label">
        Contenu
        <span class="form-hint" id="wordCounter">— 0 mots</span>
      </label>
      <textarea 
        class="form-input blog-content-textarea" 
        id="blogContent" 
        name="content" 
        rows="6"
        placeholder="Écrivez le contenu complet de votre article..."
        oninput="updateWordCount()"
        required
      ></textarea>
    </div>

    {{-- Featured Image Upload --}}
    <div class="form-group">
      <label class="form-label">Image de couverture</label>
      <div class="upload-zone" id="uploadZone" ondrop="handleImageDrop(event)" ondragover="handleImageDragOver(event)" ondragleave="handleImageDragLeave(event)">
        <input type="file" id="imageInput" name="image" accept="image/*" style="display: none;" onchange="handleImageSelect(event)">
        <div id="uploadZoneContent">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin: 0 auto 0.5rem; color: var(--muted);">
            <rect x="3" y="3" width="18" height="18" rx="2"/>
            <circle cx="8.5" cy="8.5" r="1.5"/>
            <path d="M21 15l-5-5L5 21"/>
          </svg>
          <div style="font-weight: 600; font-size: 0.85rem; color: var(--text); margin-bottom: 0.25rem;">
            Glissez votre image ici ou cliquez pour sélectionner
          </div>
          <div style="font-size: 0.75rem; color: var(--muted);">
            Formats acceptés: JPG, PNG (max 5 MB)
          </div>
        </div>
        <div id="imagePreview" style="display: none;">
          <img id="previewImg" style="max-width: 100%; max-height: 200px; border-radius: 10px; margin-bottom: 0.75rem;">
          <button type="button" class="btn btn-sm btn-danger" onclick="removeImage()" style="width: 100%;">
            Supprimer l'image
          </button>
        </div>
      </div>
      <input type="hidden" id="imageBase64" name="image_base64">
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

  .upload-zone {
    position: relative;
    border: 2px dashed var(--border);
    border-radius: var(--radius);
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: all var(--transition);
    background: var(--white);
  }

  .upload-zone:hover {
    border-color: var(--green);
    background: rgba(172, 209, 163, 0.03);
  }

  .upload-zone.dragover {
    border-color: var(--green);
    background: rgba(172, 209, 163, 0.08);
  }

  #imagePreview img {
    display: block;
  }

  .form-hint {
    color: var(--muted);
    font-weight: 400;
    font-size: 0.7rem;
  }
</style>

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
    const content = document.getElementById('blogContent').value;
    const words = content.trim().split(/\s+/).filter(w => w.length > 0).length;
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

  // Image upload handlers
  window.handleImageDrop = function(e) {
    e.preventDefault();
    e.stopPropagation();
    document.getElementById('uploadZone').classList.remove('dragover');
    const files = e.dataTransfer.files;
    if (files.length > 0) {
      document.getElementById('imageInput').files = files;
      handleImageSelect({ target: { files: files } });
    }
  };

  window.handleImageDragOver = function(e) {
    e.preventDefault();
    e.stopPropagation();
    document.getElementById('uploadZone').classList.add('dragover');
  };

  window.handleImageDragLeave = function(e) {
    e.preventDefault();
    e.stopPropagation();
    document.getElementById('uploadZone').classList.remove('dragover');
  };

  window.handleImageSelect = function(e) {
    const file = e.target.files[0];
    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function(event) {
        document.getElementById('previewImg').src = event.target.result;
        document.getElementById('imageBase64').value = event.target.result;
        document.getElementById('uploadZoneContent').style.display = 'none';
        document.getElementById('imagePreview').style.display = 'block';
      };
      reader.readAsDataURL(file);
    }
  };

  window.removeImage = function() {
    document.getElementById('imageInput').value = '';
    document.getElementById('imageBase64').value = '';
    document.getElementById('uploadZoneContent').style.display = 'block';
    document.getElementById('imagePreview').style.display = 'none';
  };

  // Click upload zone to open file selector
  document.getElementById('uploadZone').addEventListener('click', function(e) {
    if (e.target.closest('#imagePreview') === null) {
      document.getElementById('imageInput').click();
    }
  });

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
      removeImage();
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
    removeImage();
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

  // Initialize SEO preview on load
  document.addEventListener('DOMContentLoaded', function() {
    updateSeoPreview();
  });
</script>
