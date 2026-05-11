{{-- Diploma/Certification Creation/Edit Form Modal --}}
<x-modal id="diplomaModal" title="Ajouter un diplôme" size="md">
  <form id="diplomaForm" class="diploma-form">
    {{-- Diploma Name --}}
    <div class="form-group">
      <label class="form-label">Nom du diplôme / certification <span class="required">*</span></label>
      <input 
        type="text" 
        class="form-input" 
        id="dipName" 
        name="name" 
        placeholder="Ex: UEFA B Licence"
        required
      >
    </div>

    {{-- Institution and Year (2 columns) --}}
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Institution <span class="required">*</span></label>
        <input 
          type="text" 
          class="form-input" 
          id="dipInstitution" 
          name="institution" 
          placeholder="Ex: FFF, UEFA"
          required
        >
      </div>
      <div class="form-group">
        <label class="form-label">Année d'obtention <span class="required">*</span></label>
        <input 
          type="number" 
          class="form-input" 
          id="dipYear" 
          name="year" 
          placeholder="2024"
          min="1950"
          :max="new Date().getFullYear()"
          required
        >
      </div>
    </div>

    {{-- Document Upload --}}
    <x-image-upload 
      name="diploma_document" 
      label="Fichier supportant le diplôme" 
      type="any" 
      id="diplomaDocument" 
      maxSize="5"
    />

    {{-- Form Actions --}}
    <div class="form-actions" style="display: flex; gap: 0.75rem; justify-content: flex-end; margin-top: 1.5rem;">
      <button type="button" class="btn btn-outline" onclick="ModalManager.close('diplomaModal')">
        Annuler
      </button>
      <button type="submit" class="btn btn-primary" id="diplomaSubmitBtn">
        Ajouter le diplôme
      </button>
    </div>
  </form>
</x-modal>

<style>
.required {
  color: #ef4444;
}

.diploma-form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}
</style>

<script>
/**
 * Open diploma modal for adding new diploma
 */
function openAddDiplomaModal() {
  // Reset form
  document.getElementById('diplomaForm').reset();
  document.getElementById('diplomaSubmitBtn').textContent = 'Ajouter le diplôme';
  document.getElementById('diplomaSubmitBtn').dataset.editIndex = '';
  
  // Update modal title
  document.querySelector('#diplomaModal .modal-header h3').textContent = 'Ajouter un diplôme';
  
  ModalManager.open('diplomaModal');
}

/**
 * Open diploma modal for editing
 */
function openEditDiplomaModal(index) {
  const diploma = window.talentDiplomas[index];
  
  if (!diploma) return;

  // Populate form with existing data
  document.getElementById('dipName').value = diploma.name || '';
  document.getElementById('dipInstitution').value = diploma.institution || '';
  document.getElementById('dipYear').value = diploma.year || '';
  
  // Update modal title and button
  document.querySelector('#diplomaModal .modal-header h3').textContent = 'Modifier un diplôme';
  document.getElementById('diplomaSubmitBtn').textContent = 'Mettre à jour';
  document.getElementById('diplomaSubmitBtn').dataset.editIndex = index;
  
  ModalManager.open('diplomaModal');
}

/**
 * Handle diploma form submission
 */
document.getElementById('diplomaForm')?.addEventListener('submit', function(e) {
  e.preventDefault();
  
  const editIndex = document.getElementById('diplomaSubmitBtn').dataset.editIndex;
  
  const diplomaData = {
    name: document.getElementById('dipName').value.trim(),
    institution: document.getElementById('dipInstitution').value.trim(),
    year: parseInt(document.getElementById('dipYear').value),
    status: 'pending', // New diplomas start as pending
    document: document.getElementById('diplomaDocument').files?.[0]?.name || null
  };

  // Validation
  if (!diplomaData.name || !diplomaData.institution || !diplomaData.year) {
    alert('Tous les champs marqués * sont obligatoires.');
    return;
  }

  if (editIndex !== '') {
    // Edit mode - update existing diploma
    window.talentDiplomas[editIndex] = {
      ...window.talentDiplomas[editIndex],
      ...diplomaData,
      status: 'verified' // Keep status when editing
    };
  } else {
    // Add mode - create new diploma
    window.talentDiplomas.push(diplomaData);
  }

  updateDiplomasList();
  ModalManager.close('diplomaModal');
  
  showToast(editIndex !== '' ? 'Diplôme mis à jour.' : 'Diplôme ajouté · En attente de vérification.');
  
  console.log('Diploma saved:', diplomaData);
  console.log('All diplomas:', window.talentDiplomas);
});
</script>
