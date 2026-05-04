{{-- Invite to Interview Modal --}}
<x-modal id="applicationInviteModal" title="Envoyer une invitation" size="sm">
  <form id="applicationInviteForm">
    <p style="font-size:.9rem;color:var(--muted);margin-bottom:1.25rem;">
      Envoyer une invitation d'entretien à <strong id="inviteName" style="color:var(--text);"></strong>.
    </p>

    <div class="form-group">
      <label class="form-label">Date proposée</label>
      <input type="date" id="inviteDate" class="form-input" required>
    </div>

    <div class="form-group">
      <label class="form-label">Format</label>
      <select id="inviteFormat" class="form-input" required>
        <option value="En présentiel">En présentiel</option>
        <option value="Visioconférence">Visioconférence</option>
        <option value="Téléphone">Téléphone</option>
      </select>
    </div>

    <div class="form-group">
      <label class="form-label">Message <span class="form-hint">(optionnel)</span></label>
      <textarea id="inviteMessage" class="form-input" rows="3" placeholder="Ajoutez un message personnalisé..."></textarea>
    </div>

    <div style="display:flex;gap:.75rem;margin-top:1.5rem;">
      <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center;">
        Confirmer l'invitation
      </button>
      <button type="button" class="btn btn-outline" onclick="ModalManager.close('applicationInviteModal')">
        Annuler
      </button>
    </div>
  </form>
</x-modal>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('applicationInviteForm');
  if (form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      const data = {
        candidateName: document.getElementById('inviteName').textContent,
        date: document.getElementById('inviteDate').value,
        format: document.getElementById('inviteFormat').value,
        message: document.getElementById('inviteMessage').value
      };
      console.log('Invitation sent:', data);
      // TODO: Send to backend
      ModalManager.close('applicationInviteModal');
      // Show success message
    });
  }
});

window.openApplicationInvite = function(name) {
  document.getElementById('inviteName').textContent = name;
  ModalManager.open('applicationInviteModal');
};
</script>
