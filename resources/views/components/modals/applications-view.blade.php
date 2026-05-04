{{-- View Candidate Profile Modal --}}
<x-modal id="applicationViewModal" title="Profil du candidat" size="md">
  <div style="background:linear-gradient(135deg,#0f2420,#1a3a30);padding:2rem 1.5rem 1.75rem;margin:-1.75rem -1.75rem 1.75rem -1.75rem;">
    <div style="display:flex;align-items:center;gap:1.25rem;">
      <div id="viewAvatar" class="talent-avatar" style="width:56px;height:56px;">
        <span id="viewInitials"></span>
      </div>
      <div>
        <div id="viewName" style="font-size:1.2rem;font-weight:700;color:#fff;"></div>
        <div id="viewRole" style="font-size:.85rem;color:rgba(255,255,255,.6);margin-top:.2rem;"></div>
        <span style="display:inline-block;margin-top:.6rem;background:rgba(172,209,163,.2);color:#acd1a3;font-size:.75rem;font-weight:700;padding:.25rem .7rem;border-radius:50px;">Disponible</span>
      </div>
    </div>
  </div>

  {{-- Application Info --}}
  <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);">
    <div style="font-size:.78rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:.75rem;">Candidature</div>
    <div id="viewOffer" style="font-size:.88rem;color:var(--text);"></div>
  </div>

  {{-- Skills --}}
  <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);">
    <div style="font-size:.78rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:.75rem;">Compétences</div>
    <div id="viewSkills" style="display:flex;gap:.5rem;flex-wrap:wrap;"></div>
  </div>

  {{-- Motivation Letter --}}
  <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);">
    <div style="font-size:.78rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:.6rem;">Lettre de motivation</div>
    <p id="viewMotivation" style="font-size:.88rem;color:var(--muted);line-height:1.7;font-style:italic;"></p>
  </div>

  {{-- Action Buttons --}}
  <div style="padding:1.25rem 1.5rem;display:flex;gap:.75rem;">
    <button type="button" class="btn btn-primary" style="flex:1;justify-content:center;" onclick="ModalManager.close('applicationViewModal'); ModalManager.open('applicationInviteModal');">
      Inviter à un entretien
    </button>
    <button type="button" class="btn btn-danger" onclick="ModalManager.close('applicationViewModal'); ModalManager.open('applicationRefuseModal');">
      Refuser
    </button>
  </div>
</x-modal>

<script>
window.openApplicationView = function(name, role, offer, skills, motivation, initials) {
  document.getElementById('viewName').textContent = name;
  document.getElementById('viewRole').textContent = role;
  document.getElementById('viewOffer').textContent = offer;
  document.getElementById('viewInitials').textContent = initials;
  document.getElementById('viewMotivation').textContent = motivation;
  
  const skillsContainer = document.getElementById('viewSkills');
  skillsContainer.innerHTML = '';
  skills.forEach(skill => {
    const badge = document.createElement('span');
    badge.style.cssText = 'background:rgba(172,209,163,.12);color:#2d7a4f;font-size:.78rem;font-weight:600;padding:.25rem .7rem;border-radius:50px;';
    badge.textContent = skill;
    skillsContainer.appendChild(badge);
  });
  
  ModalManager.open('applicationViewModal');
};
</script>
