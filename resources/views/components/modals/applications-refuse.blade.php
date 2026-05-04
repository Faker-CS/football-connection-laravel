{{-- Refuse Application Modal --}}
<x-modal id="applicationRefuseModal" title="Refuser la candidature" size="sm">
  <form id="applicationRefuseForm">
    {{-- Warning Icon --}}
    <div style="width:56px;height:56px;border-radius:50%;background:rgba(239,68,68,.1);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
      <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
    </div>

    <p style="font-size:.92rem;color:var(--text);text-align:center;margin-bottom:.4rem;font-weight:600;">
      Refuser la candidature de <span id="refuseName"></span> ?
    </p>
    <p style="font-size:.84rem;color:var(--muted);text-align:center;margin-bottom:1.25rem;">
      Le talent sera informé par email. Cette action peut être annulée depuis le support.
    </p>

    <div class="form-group">
      <label class="form-label">Motif <span class="form-hint">(optionnel, envoyé au talent)</span></label>
      <select id="refuseReason" class="form-input">
        <option value="">Aucun motif communiqué</option>
        <option value="Profil ne correspond pas au poste">Profil ne correspond pas au poste</option>
        <option value="Poste pourvu par un autre candidat">Poste pourvu par un autre candidat</option>
        <option value="Expérience insuffisante">Expérience insuffisante</option>
        <option value="Localisation non compatible">Localisation non compatible</option>
      </select>
    </div>

    <div style="display:flex;gap:.75rem;margin-top:1.5rem;">
      <button type="submit" class="btn btn-danger" style="flex:1;justify-content:center;">
        Confirmer le refus
      </button>
      <button type="button" class="btn btn-outline" onclick="ModalManager.close('applicationRefuseModal')">
        Annuler
      </button>
    </div>
  </form>
</x-modal>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('applicationRefuseForm');
  if (form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      const data = {
        candidateName: document.getElementById('refuseName').textContent,
        reason: document.getElementById('refuseReason').value
      };
      console.log('Application refused:', data);
      // TODO: Send to backend
      ModalManager.close('applicationRefuseModal');
      // Show success message
    });
  }
});

window.openApplicationRefuse = function(name) {
  document.getElementById('refuseName').textContent = name;
  ModalManager.open('applicationRefuseModal');
};
</script>
