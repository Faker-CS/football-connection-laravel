{{-- Create Publication Modal --}}
<x-modal id="publicationFormModal" title="Ajouter une publication" size="lg">
    <form id="publicationForm">
        <input type="hidden" id="selectedPubType" name="type" value="article">

        {{-- Type Selector --}}
        <div class="form-group">
            <label class="form-label">Type de publication</label>
            <div class="type-selector">
                <button type="button" class="type-btn" data-type="video" onclick="selectPubType(this)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="23 7 16 12 23 17 23 7" />
                        <rect x="1" y="5" width="15" height="14" rx="2" />
                    </svg>
                    Vidéo
                </button>
                <button type="button" class="type-btn selected" data-type="article" onclick="selectPubType(this)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                        <line x1="16" y1="13" x2="8" y2="13" />
                        <line x1="16" y1="17" x2="8" y2="17" />
                    </svg>
                    Article
                </button>
                <button type="button" class="type-btn" data-type="stats" onclick="selectPubType(this)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="20" x2="18" y2="10" />
                        <line x1="12" y1="20" x2="12" y2="4" />
                        <line x1="6" y1="20" x2="6" y2="14" />
                    </svg>
                    Stats
                </button>
                <button type="button" class="type-btn" data-type="gallery" onclick="selectPubType(this)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2" />
                        <circle cx="8.5" cy="8.5" r="1.5" />
                        <polyline points="21 15 16 10 5 21" />
                    </svg>
                    Galerie
                </button>
            </div>
        </div>

        {{-- Title --}}
        <div class="form-group">
            <label class="form-label">Titre</label>
            <input type="text" class="form-input" id="pubTitle" name="title"
                placeholder="Ex: Séance tactique U17 — Pressing haut" required>
        </div>

        {{-- Description --}}
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea class="form-input" id="pubDesc" name="description" rows="3"
                placeholder="Décrivez votre publication..." required></textarea>
        </div>

        {{-- Video Fields --}}
        <div class="pub-field-video" style="display:none;">
            <div class="form-group">
                <label class="form-label">URL de la vidéo <span class="form-hint">(YouTube, Vimeo…)</span></label>
                <input type="url" class="form-input" id="pubVideoUrl" name="video_url"
                    placeholder="https://youtube.com/watch?v=...">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Durée <span class="form-hint">(ex: 3:42)</span></label>
                    <input type="text" class="form-input" id="pubVideoDuration" name="video_duration"
                        placeholder="0:00">
                </div>
                <div class="form-group">
                    <label class="form-label">Vignette <span class="form-hint">(optionnel)</span></label>
                    <input type="url" class="form-input" id="pubVideoThumb" name="video_thumb"
                        placeholder="URL de la vignette">
                </div>
            </div>
        </div>

        {{-- Article Fields --}}
        <div class="pub-field-article">
            <div class="form-group">
                <label class="form-label">Contenu de l'article</label>
                <textarea class="form-input" id="pubArticleContent" name="article_content" rows="5"
                    placeholder="Rédigez votre article ici..."></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Image de couverture <span class="form-hint">(optionnel)</span></label>
                <div class="upload-zone" onclick="document.getElementById('pubArticleImg').click()"
                    style="border:2px dashed var(--border);border-radius:var(--radius-sm);padding:2rem;text-align:center;color:var(--muted);cursor:pointer;transition:all var(--transition);">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                        style="width:32px;height:32px;margin:0 auto 0.5rem;">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="17 8 12 3 7 8" />
                        <line x1="12" y1="3" x2="12" y2="15" />
                    </svg>
                    <p><strong>Cliquez pour importer</strong> une image</p>
                    <p style="font-size:.78rem;margin-top:0.25rem;">PNG, JPG · max 5 Mo</p>
                    <input type="file" id="pubArticleImg" accept="image/*" onchange="previewArticleImage(this)">
                </div>
                <div id="pubArticleImgPreview"
                    style="display:none;margin-top:.6rem;border-radius:10px;overflow:hidden;height:100px;"><img
                        style="width:100%;height:100%;object-fit:cover;"></div>
            </div>
        </div>

        {{-- Stats Fields --}}
        <div class="pub-field-stats" style="display:none;">
            <div class="form-group">
                <label class="form-label">Données statistiques</label>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                    <div>
                        <label class="form-label" style="font-weight:500;font-size:.8rem;">Stat 1 — Valeur</label>
                        <input type="text" class="form-input" name="stat1_value" placeholder="Ex: 87%">
                    </div>
                    <div>
                        <label class="form-label" style="font-weight:500;font-size:.8rem;">Stat 1 — Label</label>
                        <input type="text" class="form-input" name="stat1_label"
                            placeholder="Ex: Taux de possession">
                    </div>
                    <div>
                        <label class="form-label" style="font-weight:500;font-size:.8rem;">Stat 2 — Valeur</label>
                        <input type="text" class="form-input" name="stat2_value" placeholder="Ex: 14">
                    </div>
                    <div>
                        <label class="form-label" style="font-weight:500;font-size:.8rem;">Stat 2 — Label</label>
                        <input type="text" class="form-input" name="stat2_label" placeholder="Ex: Tirs cadrés">
                    </div>
                    <div>
                        <label class="form-label" style="font-weight:500;font-size:.8rem;">Stat 3 — Valeur</label>
                        <input type="text" class="form-input" name="stat3_value" placeholder="Ex: 4-3-3">
                    </div>
                    <div>
                        <label class="form-label" style="font-weight:500;font-size:.8rem;">Stat 3 — Label</label>
                        <input type="text" class="form-input" name="stat3_label"
                            placeholder="Ex: Système de jeu">
                    </div>
                </div>
            </div>
        </div>

        {{-- Gallery Fields --}}
        <div class="pub-field-gallery" style="display:none;">
            <div class="form-group">
                <label class="form-label">Photos <span class="form-hint">(6 max)</span></label>
                <div class="upload-zone" onclick="document.getElementById('pubGalleryFiles').click()"
                    style="border:2px dashed var(--border);border-radius:var(--radius-sm);padding:2rem;text-align:center;color:var(--muted);cursor:pointer;transition:all var(--transition);">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                        style="width:32px;height:32px;margin:0 auto 0.5rem;">
                        <rect x="3" y="3" width="18" height="18" rx="2" />
                        <circle cx="8.5" cy="8.5" r="1.5" />
                        <polyline points="21 15 16 10 5 21" />
                    </svg>
                    <p><strong>Cliquez pour importer</strong> vos photos</p>
                    <p style="font-size:.78rem;margin-top:0.25rem;">PNG, JPG · 6 photos max · 5 Mo par photo</p>
                    <input type="file" id="pubGalleryFiles" accept="image/*" multiple
                        onchange="previewGalleryImages(this)">
                </div>
                <div id="pubGalleryPreview" style="display:flex;gap:.4rem;flex-wrap:wrap;margin-top:.6rem;"></div>
            </div>
        </div>

        {{-- Publish Toggle --}}
        <div class="form-group"
            style="display:flex;align-items:center;justify-content:space-between;padding:.85rem 1rem;background:#f9faf9;border-radius:10px;border:1px solid var(--border);">
            <div>
                <div style="font-size:.88rem;font-weight:600;color:var(--text);">Publier immédiatement</div>
                <div style="font-size:.78rem;color:var(--muted);margin-top:.1rem;">Visible sur votre profil public</br>
                    et par les clubs connectés</div>
            </div>
            <label class="toggle">
                <input type="checkbox" name="publish_now" checked>
                <span class="toggle-slider"></span>
            </label>
        </div>

        {{-- Submit Buttons --}}
        <div style="display: flex; gap: 0.75rem; margin-top: 1.5rem;">
            <button type="button" class="btn btn-outline" style="flex: 1;"
                onclick="ModalManager.close('publicationFormModal')">
                Annuler
            </button>
            <button type="submit" class="btn btn-primary" style="flex: 1; justify-content: center;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="16" />
                    <line x1="8" y1="12" x2="16" y2="12" />
                </svg>
                Publier
            </button>
        </div>
    </form>
</x-modal>

<script>
    window.selectPubType = function(button) {
        const selector = button.closest('.type-selector');
        selector.querySelectorAll('.type-btn').forEach(btn => btn.classList.remove('selected'));
        button.classList.add('selected');

        const type = button.dataset.type;
        document.getElementById('selectedPubType').value = type;

        // Hide all fields
        document.querySelectorAll('[class^="pub-field-"]').forEach(field => {
            field.style.display = 'none';
        });

        // Show selected type fields
        document.querySelector('.pub-field-' + type).style.display = 'block';
    };

    window.previewArticleImage = function(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('pubArticleImgPreview');
                preview.querySelector('img').src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    };

    window.previewGalleryImages = function(input) {
        const preview = document.getElementById('pubGalleryPreview');
        preview.innerHTML = '';

        if (input.files) {
            const maxFiles = 6;
            const files = Math.min(input.files.length, maxFiles);

            for (let i = 0; i < files; i++) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const thumb = document.createElement('div');
                    thumb.style.cssText =
                        'width:80px;height:80px;border-radius:8px;overflow:hidden;flex-shrink:0;';
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.cssText = 'width:100%;height:100%;object-fit:cover;';
                    thumb.appendChild(img);
                    preview.appendChild(thumb);
                };
                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('publicationForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                console.log('Publication submitted:', {
                    type: formData.get('type'),
                    title: formData.get('title'),
                    description: formData.get('description')
                });
                ModalManager.close('publicationFormModal');
                // Show success message
            });
        }
    });
</script>
