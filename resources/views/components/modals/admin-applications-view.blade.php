{{-- Admin View Application Detail Modal --}}
<x-modal id="adminApplicationViewModal" title="Détail candidature" size="md">
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
    <div style="background:var(--bg);border-radius:10px;padding:1rem;">
      <div style="font-size:.72rem;font-weight:700;text-transform:uppercase;color:var(--muted);margin-bottom:.4rem;">Talent</div>
      <div id="adminViewTalentName" style="font-weight:600;"></div>
      <div id="adminViewTalentEmail" style="font-size:.8rem;color:var(--muted);"></div>
    </div>
    <div style="background:var(--bg);border-radius:10px;padding:1rem;">
      <div style="font-size:.72rem;font-weight:700;text-transform:uppercase;color:var(--muted);margin-bottom:.4rem;">Offre</div>
      <div id="adminViewOfferTitle" style="font-weight:600;"></div>
      <div id="adminViewOfferClub" style="font-size:.8rem;color:var(--muted);"></div>
    </div>
  </div>

  <div style="background:var(--bg);border-radius:10px;padding:1rem;margin-bottom:1rem;">
    <div style="font-size:.72rem;font-weight:700;text-transform:uppercase;color:var(--muted);margin-bottom:.5rem;">Statut</div>
    <div id="adminViewStatusBadge"></div>
    <div id="adminViewStatusTime" style="font-size:.82rem;color:var(--muted);margin-top:.5rem;"></div>
  </div>

  <div style="background:var(--bg);border-radius:10px;padding:1rem;margin-bottom:1.5rem;">
    <div style="font-size:.72rem;font-weight:700;text-transform:uppercase;color:var(--muted);margin-bottom:.5rem;">Lettre de motivation</div>
    <p id="adminViewMotivation" style="font-size:.85rem;color:var(--text);line-height:1.7;font-style:italic;"></p>
  </div>

  <div style="display:flex;gap:.75rem;">
    <button type="button" class="btn btn-danger" onclick="deleteAdminApplication(); ModalManager.close('adminApplicationViewModal');">
      Supprimer
    </button>
    <button type="button" class="btn btn-outline" onclick="ModalManager.close('adminApplicationViewModal');">
      Fermer
    </button>
  </div>
</x-modal>

<script>
window.openAdminApplicationView = function(applicant, email, offer, club, status, statusTime, motivation) {
  document.getElementById('adminViewTalentName').textContent = applicant;
  document.getElementById('adminViewTalentEmail').textContent = email;
  document.getElementById('adminViewOfferTitle').textContent = offer;
  document.getElementById('adminViewOfferClub').textContent = club;
  document.getElementById('adminViewMotivation').textContent = motivation;
  document.getElementById('adminViewStatusTime').textContent = statusTime;
  
  // Create status badge
  const statusMap = {
    'Nouveau': 'blue',
    'En cours': 'amber',
    'Entretien': 'amber',
    'Accepté': 'green',
    'Refusé': 'red',
    'Invitée': 'amber'
  };
  
  const badgeColor = statusMap[status] || 'blue';
  const badgeClass = `badge-${badgeColor}`;
  const badgeHtml = `<span class="badge ${badgeClass}">${status}</span>`;
  document.getElementById('adminViewStatusBadge').innerHTML = badgeHtml;
  
  ModalManager.open('adminApplicationViewModal');
};

window.deleteAdminApplication = function() {
  // TODO: Send delete request to backend
  console.log('Application deleted');
};
</script>
