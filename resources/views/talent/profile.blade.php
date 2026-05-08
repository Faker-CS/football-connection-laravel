@extends('layouts.dashboard')
@section('title', 'Mon Profil - Talent')

@section('content')
    <div class="grid-2">
        {{-- Left Column: Photo & Quick Info --}}
        <div>
            <div class="card mb-2">
                <div class="card-body" style="text-align:center">
                    <div class="talent-avatar" style="margin:0 auto 1rem">{{ $talent['initials'] }}</div>
                    <h3 style="font-size:1.1rem;font-weight:700">{{ $talent['name'] }}</h3>
                    <p class="text-muted" style="font-size:.82rem">{{ $talent['role'] }}</p>
                    <p class="text-muted text-sm mt-1">📍 {{ $talent['city'] }}, {{ $talent['country'] }}</p>
                    <button class="btn btn-outline btn-sm mt-2 btn-block">Modifier la photo</button>
                </div>
            </div>

            {{-- Skills --}}
            <div class="card mb-2">
                <div class="card-header">
                    <h3 class="card-title">Compétences</h3>
                </div>
                <div class="card-body">
                    <x-tag-input name="skills" label="Ajouter vos compétences" placeholder="Ajouter une compétence..."
                        :tags="$skills" maxTags="20" separator="comma" />
                </div>
            </div>

            {{-- Positions --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Postes recherchés</h3>
                </div>
                <div class="card-body">
                    @foreach ($positions as $pos)
                        <div class="d-flex align-center" style="padding:.4rem 0;font-size:.82rem;gap:.5rem">
                            <span
                                style="width:6px;height:6px;border-radius:50%;background:var(--green-dark);flex-shrink:0"></span>
                            {{ $pos }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Right Column --}}
        <div>
            {{-- Personal Info Form --}}
            <div class="card mb-2">
                <div class="card-header">
                    <h3 class="card-title">Informations personnelles</h3>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nom complet</label>
                            <input type="text" class="form-input" value="{{ $talent['name'] }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-input" value="{{ $talent['email'] }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Téléphone</label>
                            <input type="tel" class="form-input" value="{{ $talent['phone'] }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date de naissance</label>
                            <input type="text" class="form-input" value="{{ $talent['birthdate'] }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Biographie</label>
                        <textarea class="form-textarea">{{ $talent['bio'] }}</textarea>
                    </div>
                    <button class="btn btn-primary">Sauvegarder</button>
                </div>
            </div>

            {{-- Experience --}}
            <div class="card mb-2">
                <div class="card-header" style="flex-wrap:wrap">
                    <h3 class="card-title">Expériences professionnelles</h3>
                    <button class="btn btn-outline btn-sm" onclick="openAddExperienceModal()">+ Ajouter</button>
                </div>
                <div class="card-body" style="padding:0" id="experiencesList">
                    @foreach ($experiences as $index => $exp)
                        <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border)" class="experience-item"
                            data-exp-index="{{ $index }}">
                            <div class="d-flex justify-between" style="gap:1rem;flex-wrap:wrap;align-items:flex-start">
                                <div style="flex:1;min-width:0">
                                    <div class="fw-600" style="font-size:.9rem">{{ $exp['title'] }}</div>
                                    <div class="text-muted text-sm">{{ $exp['club'] }} · {{ $exp['period'] }}</div>
                                </div>
                                <div style="display:flex;gap:0.5rem;flex-shrink:0">
                                    <button class="btn btn-outline btn-sm btn-icon"
                                        onclick="openEditExperienceModal({{ $index }})" title="Modifier">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            width="14" height="14">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                        </svg>
                                    </button>
                                    <button class="btn btn-outline btn-sm btn-icon"
                                        onclick="deleteExperience({{ $index }})" title="Supprimer"
                                        style="color:#ef4444">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            width="14" height="14">
                                            <polyline points="3 6 5 6 21 6" />
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                            <line x1="10" y1="11" x2="10" y2="17" />
                                            <line x1="14" y1="11" x2="14" y2="17" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <p class="text-muted text-sm mt-1">{{ $exp['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Documents --}}
            <div class="card">
                <div class="card-header" style="flex-wrap:wrap">
                    <h3 class="card-title">Documents</h3>
                    <button class="btn btn-outline btn-sm">+ Ajouter</button>
                </div>
                <div class="card-body">
                    @foreach ($documents as $doc)
                        <div class="d-flex align-center justify-between"
                            style="padding:.65rem 0;border-bottom:1px solid var(--border);gap:.75rem;flex-wrap:wrap">
                            <div class="d-flex align-center" style="gap:.75rem;min-width:0;flex:1">
                                <div
                                    style="width:36px;height:36px;border-radius:8px;background:rgba(239,68,68,.08);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2"
                                        width="16" height="16">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                        <polyline points="14 2 14 8 20 8" />
                                    </svg>
                                </div>
                                <div style="min-width:0">
                                    <div class="fw-600 text-sm">{{ $doc['name'] }}</div>
                                    <div class="text-muted text-xs">{{ $doc['size'] }} · {{ $doc['date'] }}</div>
                                </div>
                            </div>
                            <button class="btn btn-outline btn-sm" style="flex-shrink:0">Télécharger</button>
                        </div>
                    @endforeach
                    <x-image-upload name="featured_image" label="Ajouter nouveau document" type="any" id="talentFeaturedImage"
                        maxSize="5" />
                </div>
            </div>
        </div>
    </div>

    {{-- Experience Modal --}}
    @include('components.modals.experience-form')

    <script>
        /**
         * Initialize experiences data from controller
         */
        window.talentExperiences = @json($experiences ?? []);

        /**
         * Delete experience
         */
        function deleteExperience(expIndex) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette expérience ?')) {
                window.talentExperiences.splice(expIndex, 1);
                updateExperiencesList();

                // Dispatch event for parent to handle deletion
                window.dispatchEvent(new CustomEvent('experienceDeleted', {
                    detail: {
                        index: expIndex
                    }
                }));
            }
        }

        /**
         * Update experiences list UI
         */
        function updateExperiencesList() {
            const container = document.getElementById('experiencesList');

            if (!window.talentExperiences || window.talentExperiences.length === 0) {
                container.innerHTML =
                    '<div style="padding:1.5rem;text-align:center;color:var(--text-muted);font-size:0.875rem">Aucune expérience ajoutée</div>';
                return;
            }

            container.innerHTML = window.talentExperiences.map((exp, index) => `
                <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border)" class="experience-item" data-exp-index="${index}">
                <div class="d-flex justify-between" style="gap:1rem;flex-wrap:wrap;align-items:flex-start">
                    <div style="flex:1;min-width:0">
                    <div class="fw-600" style="font-size:.9rem">${exp.title || 'N/A'}</div>
                    <div class="text-muted text-sm">${exp.club || 'N/A'} · ${exp.period || 'N/A'}</div>
                    </div>
                    <div style="display:flex;gap:0.5rem;flex-shrink:0">
                    <button class="btn btn-outline btn-sm btn-icon" onclick="openEditExperienceModal(${index})" title="Modifier">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </button>
                    <button class="btn btn-outline btn-sm btn-icon" onclick="deleteExperience(${index})" title="Supprimer" style="color:#ef4444">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                    </button>
                    </div>
                </div>
                <p class="text-muted text-sm mt-1">${exp.description || ''}</p>
                </div>
            `).join('');
        }

        /**
         * Handle experience saved event
         */
        window.addEventListener('experienceSaved', function(e) {
            const {
                data,
                isNew,
                editId
            } = e.detail;

            if (isNew) {
                // Add new experience
                window.talentExperiences.push(data);
            } else {
                // Update existing experience
                if (editId !== null && editId < window.talentExperiences.length) {
                    window.talentExperiences[editId] = data;
                }
            }

            updateExperiencesList();

            // Here you would typically send data to backend via AJAX
            console.log('Experience saved:', data);
            console.log('All experiences:', window.talentExperiences);
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Experiences are already in DOM from Laravel
            // Just ensure the modal manager is available
            if (typeof ModalManager === 'undefined') {
                console.warn('ModalManager not found - ensure modal.js is loaded');
            }
        });
    </script>
@endsection
