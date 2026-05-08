{{-- Experience Creation/Edit Form Modal --}}
<x-modal id="experienceModal" title="Ajouter une expérience" size="md">
  <form id="experienceForm" class="experience-form">
    {{-- Job Title --}}
    <div class="form-group">
      <label class="form-label">Intitulé du poste <span class="required">*</span></label>
      <input 
        type="text" 
        class="form-input" 
        id="expTitle" 
        name="title" 
        placeholder="Ex: Entraîneur adjoint U19"
        required
      >
    </div>

    {{-- Club/Employer and Location --}}
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Club / Employeur <span class="required">*</span></label>
        <input 
          type="text" 
          class="form-input" 
          id="expClub" 
          name="club" 
          placeholder="Ex: FC Nantes"
          required
        >
      </div>
      <div class="form-group">
        <label class="form-label">Lieu</label>
        <input 
          type="text" 
          class="form-input" 
          id="expLocation" 
          name="location" 
          placeholder="Ex: Nantes, Pays de Loire"
        >
      </div>
    </div>

    {{-- Start and End Dates --}}
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Date de début <span class="required">*</span></label>
        <input 
          type="date" 
          class="form-input" 
          id="expStartDate" 
          name="start_date"
          required
        >
      </div>
      <div class="form-group">
        <label class="form-label">Date de fin</label>
        <input 
          type="date" 
          class="form-input" 
          id="expEndDate" 
          name="end_date"
        >
      </div>
    </div>

    {{-- Current Position Checkbox --}}
    <div class="form-group">
      <label class="form-checkbox">
        <input 
          type="checkbox" 
          id="expCurrent" 
          name="is_current"
          onchange="toggleEndDate()"
        >
        <span>Poste actuel</span>
      </label>
    </div>

    {{-- Description --}}
    <div class="form-group">
      <label class="form-label">Description</label>
      <textarea 
        class="form-textarea" 
        id="expDescription" 
        name="description" 
        rows="4"
        placeholder="Décrivez vos missions et réalisations..."
      ></textarea>
    </div>

    {{-- Form Actions --}}
    <div class="form-actions" style="display: flex; gap: 0.75rem; justify-content: flex-end; margin-top: 1.5rem;">
      <button type="button" class="btn btn-outline" onclick="ModalManager.close('experienceModal')">
        Annuler
      </button>
      <button type="submit" class="btn btn-primary">
        Ajouter l'expérience
      </button>
    </div>
  </form>
</x-modal>

<style>
.required {
  color: #ef4444;
}

.form-checkbox {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  cursor: pointer;
  font-size: 0.875rem;
}

.form-checkbox input[type="checkbox"] {
  width: 16px;
  height: 16px;
  cursor: pointer;
}

.form-textarea {
  font-family: inherit;
  resize: vertical;
  min-height: 80px;
}
</style>

<script>
/**
 * Toggle end date field based on current position checkbox
 */
function toggleEndDate() {
  const checkbox = document.getElementById('expCurrent');
  const endDateField = document.getElementById('expEndDate');
  
  if (checkbox.checked) {
    endDateField.disabled = true;
    endDateField.value = '';
  } else {
    endDateField.disabled = false;
  }
}

/**
 * Open experience modal for adding new experience
 */
function openAddExperienceModal() {
  // Reset form
  document.getElementById('experienceForm').reset();
  document.getElementById('expEndDate').disabled = false;
  
  // Update modal title
  const modal = document.querySelector('[data-modal="experienceModal"]');
  modal.querySelector('.modal-title').textContent = 'Ajouter une expérience';
  
  // Update button text
  const submitBtn = document.querySelector('#experienceForm button[type="submit"]');
  submitBtn.textContent = 'Ajouter l\'expérience';
  
  // Store that we're adding (not editing)
  window.experienceEditId = null;
  
  ModalManager.open('experienceModal');
}

/**
 * Open experience modal for editing existing experience
 */
function openEditExperienceModal(expIndex) {
  const experiences = window.talentExperiences || [];
  if (expIndex < 0 || expIndex >= experiences.length) return;
  
  const exp = experiences[expIndex];
  
  // Populate form with experience data
  document.getElementById('expTitle').value = exp.title || '';
  document.getElementById('expClub').value = exp.club || '';
  document.getElementById('expLocation').value = exp.location || '';
  document.getElementById('expStartDate').value = exp.start_date || '';
  document.getElementById('expEndDate').value = exp.end_date || '';
  document.getElementById('expDescription').value = exp.description || '';
  document.getElementById('expCurrent').checked = exp.is_current || false;
  
  toggleEndDate();
  
  // Update modal title
  const modal = document.querySelector('[data-modal="experienceModal"]');
  modal.querySelector('.modal-title').textContent = 'Modifier l\'expérience';
  
  // Update button text
  const submitBtn = document.querySelector('#experienceForm button[type="submit"]');
  submitBtn.textContent = 'Mettre à jour l\'expérience';
  
  // Store the index we're editing
  window.experienceEditId = expIndex;
  
  ModalManager.open('experienceModal');
}

/**
 * Handle experience form submission
 */
document.getElementById('experienceForm')?.addEventListener('submit', function(e) {
  e.preventDefault();
  
  const formData = {
    title: document.getElementById('expTitle').value,
    club: document.getElementById('expClub').value,
    location: document.getElementById('expLocation').value,
    start_date: document.getElementById('expStartDate').value,
    end_date: document.getElementById('expEndDate').value,
    description: document.getElementById('expDescription').value,
    is_current: document.getElementById('expCurrent').checked
  };
  
  // Format period display
  const startYear = new Date(formData.start_date).getFullYear();
  const endYear = formData.is_current ? 'Actuel' : (formData.end_date ? new Date(formData.end_date).getFullYear() : '');
  formData.period = `${startYear}${endYear ? ' - ' + endYear : ''}`;
  
  // Emit custom event for parent to handle
  window.dispatchEvent(new CustomEvent('experienceSaved', { 
    detail: {
      data: formData,
      isNew: window.experienceEditId === null,
      editId: window.experienceEditId
    }
  }));
  
  // Close modal
  ModalManager.close('experienceModal');
  
  // Show success feedback
  console.log('Experience saved:', formData);
});

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
  // Make experiences data available globally (from controller)
  if (window.talentExperiences === undefined) {
    window.talentExperiences = [];
  }
});
</script>
