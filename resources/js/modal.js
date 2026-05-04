/**
 * Modal Manager
 * Central control for all modal operations
 * Usage: ModalManager.open('modalId') or ModalManager.close('modalId')
 */
window.ModalManager = {
  // Open a modal
  open(modalId) {
    const modal = document.querySelector(`[data-modal="${modalId}"]`);
    if (!modal) {
      console.warn(`Modal with ID "${modalId}" not found`);
      return;
    }

    // Show modal with animation
    modal.style.display = 'flex';
    modal.classList.add('show');
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';

    // Focus management: move focus to modal
    const closeBtn = modal.querySelector('.modal-close');
    if (closeBtn) closeBtn.focus();

    // Trigger animation
    setTimeout(() => {
      modal.classList.add('active');
    }, 10);
  },

  // Close a modal
  close(modalId) {
    const modal = document.querySelector(`[data-modal="${modalId}"]`);
    if (!modal) {
      console.warn(`Modal with ID "${modalId}" not found`);
      return;
    }

    modal.classList.remove('active');
    
    setTimeout(() => {
      modal.style.display = 'none';
      modal.classList.remove('show');
      // Restore body scroll
      document.body.style.overflow = '';
    }, 300);
  },

  // Close all modals
  closeAll() {
    document.querySelectorAll('[data-modal]').forEach(modal => {
      this.close(modal.dataset.modal);
    });
  },

  // Toggle modal
  toggle(modalId) {
    const modal = document.querySelector(`[data-modal="${modalId}"]`);
    if (modal && modal.style.display === 'none') {
      this.open(modalId);
    } else {
      this.close(modalId);
    }
  },

  // Close modal on backdrop click
  setupBackdropClose() {
    document.addEventListener('click', (e) => {
      if (e.target.classList.contains('modal-backdrop')) {
        const modalId = e.target.dataset.modal;
        this.close(modalId);
      }
    });
  },

  // Close modal on ESC key
  setupEscapeClose() {
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        const modals = document.querySelectorAll('[data-modal]');
        for (let modal of modals) {
          if (modal.style.display !== 'none') {
            this.close(modal.dataset.modal);
            break;
          }
        }
      }
    });
  },

  // Initialize all modal functionality
  init() {
    this.setupBackdropClose();
    this.setupEscapeClose();
  }
};

// Auto-initialize when DOM is ready
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', () => {
    ModalManager.init();
  });
} else {
  ModalManager.init();
}
