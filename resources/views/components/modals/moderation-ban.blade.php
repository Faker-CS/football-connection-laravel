{{-- Ban User Modal --}}
<x-modal id="moderationBanModal" title="Bannir l'utilisateur" size="sm">
  <form id="moderationBanForm">
    {{-- Warning Icon --}}
    <div style="width:52px;height:52px;border-radius:50%;background:rgba(239,68,68,.1);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
      <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" style="flex-shrink:0;">
        <circle cx="12" cy="12" r="10"/>
        <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
      </svg>
    </div>

    <p style="text-align:center;font-weight:600;margin-bottom:.4rem;">Bannir <span id="banUsername"></span> ?</p>
    <p style="text-align:center;font-size:.84rem;color:var(--muted);margin-bottom:1.25rem;">Cette action est irréversible. L'utilisateur ne pourra plus se connecter.</p>

    <div class="form-group">
      <label class="form-label">Motif du bannissement <span style="color:#dc2626;">*</span></label>
      <select id="banReason" class="form-input" required>
        <option value="">Sélectionner un motif...</option>
        <option value="fraud">Fraude / Fausses informations</option>
        <option value="spam">Spam</option>
        <option value="inappropriate">Comportement inapproprié</option>
        <option value="violation">Violation des CGU</option>
        <option value="other">Autre</option>
      </select>
    </div>

    <div class="form-group">
      <label class="form-label">Durée</label>
      <select id="banDuration" class="form-input">
        <option value="permanent">Permanent</option>
        <option value="30days">30 jours</option>
        <option value="7days">7 jours</option>
      </select>
    </div>

    <div class="form-group">
      <label class="form-label">Note interne</label>
      <textarea id="banNote" class="form-input" rows="2" placeholder="Détails..."></textarea>
    </div>

    <div style="display:flex;gap:.75rem;margin-top:1.5rem;">
      <button type="button" class="btn btn-outline" style="flex:1;" onclick="ModalManager.close('moderationBanModal')">
        Annuler
      </button>
      <button type="submit" class="btn btn-danger" style="flex:1;justify-content:center;">
        Confirmer le bannissement
      </button>
    </div>
  </form>
</x-modal>

<script>
window.openModerationBan = function(username) {
  document.getElementById('banUsername').textContent = username;
  ModalManager.open('moderationBanModal');
};

document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('moderationBanForm');
  if (form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      const data = {
        username: document.getElementById('banUsername').textContent,
        reason: document.getElementById('banReason').value,
        duration: document.getElementById('banDuration').value,
        note: document.getElementById('banNote').value
      };
      console.log('User ban submitted:', data);
      // TODO: Send to backend
      ModalManager.close('moderationBanModal');
      // Show success message
    });
  }
});
</script>
