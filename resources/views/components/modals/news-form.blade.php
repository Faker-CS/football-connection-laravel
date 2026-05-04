{{-- News/Article Creation Form Modal --}}
<x-modal id="newsFormModal" title="Ajouter une actualité" size="lg">
  <form id="newsForm" class="news-form">
    {{-- Type Selection --}}
    <div class="form-group">
      <label class="form-label">Type</label>
      <div class="type-selector" id="typeSelector">
        <button type="button" class="type-btn selected" data-type="Recrutement" onclick="selectType(this)">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
          Recrutement
        </button>
        <button type="button" class="type-btn" data-type="Résultat" onclick="selectType(this)">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          Résultat
        </button>
        <button type="button" class="type-btn" data-type="Événement" onclick="selectType(this)">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          Événement
        </button>
        <button type="button" class="type-btn" data-type="Annonce" onclick="selectType(this)">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"/></svg>
          Annonce
        </button>
      </div>
      <input type="hidden" id="selectedType" name="type" value="Recrutement">
    </div>

    {{-- Title --}}
    <div class="form-group">
      <label class="form-label">Titre <span class="form-hint">— soyez précis et accrocheur</span></label>
      <input type="text" class="form-input" id="newsTitle" name="title" placeholder="Ex: Journée portes ouvertes — Centre de formation" required>
    </div>

    {{-- Description --}}
    <div class="form-group">
      <label class="form-label">Description</label>
      <textarea class="form-input" id="newsDesc" name="description" rows="3" placeholder="Décrivez l'actualité ou l'événement en quelques lignes..." required></textarea>
    </div>

    {{-- External Link + Date --}}
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Lien externe <span class="form-hint">(optionnel)</span></label>
        <input type="url" class="form-input" id="newsLink" name="link" placeholder="https://...">
      </div>
      <div class="form-group">
        <label class="form-label">Date</label>
        <input type="date" class="form-input" id="newsDate" name="date" value="{{ date('Y-m-d') }}" required>
      </div>
    </div>

    {{-- Visibility Toggle --}}
    <div class="form-group" style="display:flex;align-items:center;justify-content:space-between;padding:.85rem 1rem;background:#f9faf9;border-radius:10px;border:1px solid var(--border);">
      <div>
        <div style="font-size:.88rem;font-weight:600;color:var(--text);">Publier immédiatement</div>
        <div style="font-size:.78rem;color:var(--muted);margin-top:.1rem;">Visible sur votre profil public dès la publication</div>
      </div>
      <div class="toggle-wrap">
        <label class="toggle">
          <input type="checkbox" id="publishNow" name="publish_now" checked>
          <span class="toggle-slider"></span>
        </label>
      </div>
    </div>

    {{-- Submit Button --}}
    <div style="display: flex; gap: 0.75rem; margin-top: 1.5rem;">
      <button type="button" class="btn btn-outline" style="flex: 1;" onclick="ModalManager.close('newsFormModal')">
        Annuler
      </button>
      <button type="submit" class="btn btn-primary" style="flex: 1; justify-content: center;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
        Publier l'actualité
      </button>
    </div>
  </form>
</x-modal>

<script>
// Type selector helper function
window.selectType = function(button) {
  const selector = button.closest('.type-selector');
  selector.querySelectorAll('.type-btn').forEach(btn => btn.classList.remove('selected'));
  button.classList.add('selected');
  document.getElementById('selectedType').value = button.dataset.type;
};

// Form submission handler
document.addEventListener('DOMContentLoaded', function() {
  const newsForm = document.getElementById('newsForm');
  if (newsForm) {
    newsForm.addEventListener('submit', function(e) {
      e.preventDefault();
      // TODO: Send form data to backend via AJAX
      console.log('Form submitted:', new FormData(this));
      ModalManager.close('newsFormModal');
      // Show success message
    });
  }
});
</script>
