/**
 * Blog Management Page - JavaScript
 * Handles article list, editing, deletion, and category colors
 */

// Category to color mapping
const categoryColors = {
  'Recrutement': 'green',
  'Conseils carrière': 'green',
  'Formation': 'blue',
  'Transferts': 'amber',
  'Actualités foot': 'red',
  'Technologie & Data': 'purple'
};

// Sample articles data (would come from backend)
const articlesData = {
  1: {
    id: 1,
    title: 'Comment recruter les meilleurs talents du football',
    excerpt: 'Guide complet pour les clubs souhaitant développer une stratégie de recrutement efficace...',
    content: 'Contenu complet de l\'article sur le recrutement...',
    category: 'Recrutement',
    author: 'John doe',
    image: null,
    readingTime: 5,
    tags: 'football, recrutement, conseils',
    featured: true,
    status: 'published',
    views: 2350,
    date: '5 mai 2026'
  },
  2: {
    id: 2,
    title: 'Programme de formation d\'excellence',
    excerpt: 'Développer les compétences des jeunes joueurs avec un programme structuré...',
    content: 'Contenu du programme de formation...',
    category: 'Formation',
    author: 'Jane Smith',
    image: null,
    readingTime: 8,
    tags: 'formation, jeunes, développement',
    featured: false,
    status: 'draft',
    views: 0,
    date: '3 mai 2026'
  }
};

/**
 * Edit Article - Opens modal with pre-filled data
 */
window.editArticle = function(articleId) {
  const article = articlesData[articleId];
  if (!article) return;

  // Set modal title
  const modal = document.getElementById('blogArticleModal');
  modal.querySelector('.modal-title').textContent = 'Modifier l\'article';

  // Pre-fill form
  document.getElementById('blogTitle').value = article.title;
  document.getElementById('blogCategory').value = article.category;
  document.getElementById('blogAuthor').value = article.author;
  document.getElementById('blogExcerpt').value = article.excerpt;
  document.getElementById('blogContent').value = article.content;
  document.getElementById('readingTime').value = article.readingTime;
  document.getElementById('blogTags').value = article.tags;
  document.getElementById('isFeatured').checked = article.featured;

  // Update counters
  updateCharCounter(document.getElementById('blogTitle'), 80, 'titleCounter');
  updateCharCounter(document.getElementById('blogExcerpt'), 200, 'excerptCounter');
  updateWordCount();
  updateSeoPreview();

  // Store current article ID for update on save
  window.currentBlogId = articleId;

  // Open modal
  ModalManager.open('blogArticleModal');
};

/**
 * Delete Article - With confirmation
 */
window.deleteArticle = function(articleId) {
  const article = articlesData[articleId];
  if (!article) return;

  if (confirm(`Êtes-vous sûr de vouloir supprimer l'article "${article.title}"?`)) {
    // Find and animate out
    const articleElement = document.querySelector(`[data-id="${articleId}"]`);
    if (articleElement) {
      articleElement.style.animation = 'slideOut 0.3s ease';
      setTimeout(() => {
        articleElement.remove();
        delete articlesData[articleId];
        updateArticleCounters();
        showToast('success', 'Article supprimé avec succès');
      }, 300);
    }
  }
};

/**
 * Publish Draft Article
 */
window.publishDraft = function(articleId) {
  const article = articlesData[articleId];
  if (!article) return;

  article.status = 'published';
  const articleElement = document.querySelector(`[data-id="${articleId}"]`);

  if (articleElement) {
    articleElement.classList.remove('draft');
    articleElement.style.opacity = '1';
    showToast('success', 'Article publié avec succès');
    updateArticleCounters();
  }
};

/**
 * Update article counters
 */
window.updateArticleCounters = function() {
  const stats = {
    published: 0,
    drafts: 0,
    views: 0
  };

  Object.values(articlesData).forEach(article => {
    if (article.status === 'published') {
      stats.published++;
      stats.views += article.views;
    } else if (article.status === 'draft') {
      stats.drafts++;
    }
  });

  // Update stat cards (would be done via backend in production)
  console.log('Updated counters:', stats);
};

/**
 * Get category color
 */
window.getCategoryColor = function(category) {
  return categoryColors[category] || 'gray';
};

/**
 * Render article item HTML
 */
window.renderArticleItem = function(article) {
  const categoryColor = getCategoryColor(article.category);
  const statusBadge = article.status === 'published' 
    ? (article.featured ? 'À la une' : 'Publié')
    : 'Brouillon';
  const statusColor = article.featured ? 'green' : (article.status === 'published' ? 'green' : 'amber');

  const html = `
    <div class="article-item ${article.status === 'draft' ? 'draft' : ''}" data-id="${article.id}">
      <div class="article-thumbnail">
        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #${Math.random().toString(16).slice(2, 8)}, #${Math.random().toString(16).slice(2, 8)}); display: flex; align-items: center; justify-content: center; font-size: 2rem;">
          📰
        </div>
      </div>
      <div class="article-content">
        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.35rem;">
          <span class="badge badge-${categoryColor}">${article.category}</span>
        </div>
        <h4 class="article-title">${escapeHtml(article.title)}</h4>
        <p class="article-excerpt">${escapeHtml(article.excerpt)}</p>
        <div class="article-footer">
          <div style="display: flex; align-items: center; gap: 1rem; font-size: 0.75rem; color: var(--muted);">
            <span><span class="badge badge-${statusColor}">${statusBadge}</span></span>
            <span>👁 ${article.views.toLocaleString()} vues</span>
            <span>📅 ${article.date}</span>
          </div>
        </div>
        <div class="article-actions" style="display: flex; gap: 0.5rem; margin-top: 0.75rem;">
          ${article.status === 'draft' ? `
            <button class="btn btn-success btn-sm" onclick="publishDraft(${article.id})">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
              Publier
            </button>
          ` : ''}
          <button class="btn btn-outline btn-sm" onclick="editArticle(${article.id})">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            Modifier
          </button>
          <button class="btn btn-danger btn-sm" onclick="deleteArticle(${article.id})">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
            Supprimer
          </button>
        </div>
      </div>
    </div>
  `;

  return html;
};

/**
 * Escape HTML to prevent XSS
 */
window.escapeHtml = function(text) {
  const map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };
  return text.replace(/[&<>"']/g, m => map[m]);
};

/**
 * Initialize articles list on page load
 */
window.initializeBlogPage = function() {
  const list = document.getElementById('articlesList');
  if (!list) return;

  // Clear and re-render (in production this would fetch from backend)
  list.innerHTML = '';
  Object.values(articlesData).forEach(article => {
    list.innerHTML += renderArticleItem(article);
  });

  updateArticleCounters();

  // Initialize ModalManager
  if (window.ModalManager && window.ModalManager.init) {
    ModalManager.init();
  }
};

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', initializeBlogPage);

// Global variables for blog form (passed from modal)
if (!window.updateCharCounter) {
  window.updateCharCounter = function(element, max, counterId) {
    if (document.getElementById(counterId)) {
      const count = element.value.length;
      document.getElementById(counterId).textContent = `— ${count}/${max} caractères`;
    }
  };
}

if (!window.updateWordCount) {
  window.updateWordCount = function() {
    if (document.getElementById('wordCounter')) {
      const content = document.getElementById('blogContent').value;
      const words = content.trim().split(/\s+/).filter(w => w.length > 0).length;
      document.getElementById('wordCounter').textContent = `— ${words} mots`;
    }
  };
}

if (!window.updateSeoPreview) {
  window.updateSeoPreview = function() {
    const title = document.getElementById('blogTitle')?.value || 'Votre titre d\'article';
    const excerpt = document.getElementById('blogExcerpt')?.value || 'Votre description ou extrait';

    const slug = title
      .toLowerCase()
      .replace(/[^\w\s-]/g, '')
      .replace(/\s+/g, '-')
      .replace(/-+/g, '-')
      .substring(0, 60);

    if (document.getElementById('seoTitle')) {
      document.getElementById('seoTitle').textContent = title.substring(0, 60);
      document.getElementById('seoSlug').textContent = slug || 'votre-titre';
      document.getElementById('seoUrlPreview').textContent = slug || 'votre-titre';
      document.getElementById('seoDescription').textContent = excerpt.substring(0, 160);
      document.getElementById('seoTitleLength').textContent = title.length;
      document.getElementById('seoDescLength').textContent = excerpt.length;
    }
  };
}

if (!window.showToast) {
  window.showToast = function(type, message) {
    const container = document.getElementById('toastContainer');
    if (!container) return;

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
}
