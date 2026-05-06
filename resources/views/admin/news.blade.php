@extends('layouts.dashboard')
@section('title', 'Actualités - Admin')

@section('content')
    {{-- Stats Bar --}}
    <div class="stats-grid">
        <x-stat-card icon="document" color="green" value="6" label="Articles publiés" />
        <x-stat-card icon="document" color="amber" value="2" label="Brouillons" />
        <x-stat-card icon="eye" color="blue" value="24 800" label="Vues ce mois" />
        <x-stat-card icon="trending" color="teal" value="+18%" label="Croissance lecteurs" />
    </div>

    {{-- Main 2-Column Layout --}}
    <div class="grid-2" style="gap: 1.5rem;">
        {{-- Left Column: Create & SEO Preview --}}
        <div>
            {{-- Create Article Button --}}
            <button class="btn btn-primary"
                style="width: 100%; justify-content: center; margin-bottom: 1.5rem; padding: 0.7rem 1.5rem; font-size: 0.9rem;"
                onclick="ModalManager.open('blogArticleModal')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                    <line x1="18" y1="5" x2="18" y2="11" />
                    <line x1="21" y1="8" x2="15" y2="8" />
                </svg>
                Rédiger un nouvel article
            </button>

            {{-- SEO Preview Card --}}
            <div class="card" style="border: 1px solid var(--border);">
                <div class="card-header" style="padding: 1rem 1.25rem;">
                    <h3 class="card-title">Aperçu SEO</h3>
                </div>
                <div class="card-body" style="padding: 1rem 1.25rem;">
                    <div class="seo-preview">
                        {{-- Browser Bar Mockup --}}
                        <div class="seo-browser-bar">
                            <div style="font-size: 0.7rem; color: var(--muted); margin-bottom: 0.5rem;">
                                <strong>URL:</strong>
                            </div>
                            <div style="font-size: 0.75rem; color: #0d9488; word-break: break-all;">
                                football-connection.fr/blog/<span id="seoSlug">votre-titre</span>
                            </div>
                        </div>

                        {{-- Google Result Mockup --}}
                        <div class="seo-google-result"
                            style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--border);">
                            <div style="font-size: 0.75rem; color: var(--muted); margin-bottom: 0.4rem;">
                                <strong>Titre (58 chars):</strong>
                            </div>
                            <div
                                style="font-size: 0.85rem; font-weight: 600; color: #1a0dbd; margin-bottom: 0.35rem; word-break: break-word;">
                                <span id="seoTitle" class="seo-text-preview">Votre titre d'article</span>
                            </div>
                            <div style="font-size: 0.7rem; color: #0d9488; margin-bottom: 0.35rem;">
                                football-connection.fr/blog/<span id="seoUrlPreview">votre-titre</span>
                            </div>
                            <div style="font-size: 0.75rem; color: var(--muted); line-height: 1.4; word-break: break-word;">
                                <span id="seoDescription" class="seo-text-preview">Votre description ou extrait</span>
                            </div>
                        </div>

                        {{-- Character Indicators --}}
                        <div
                            style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--border); font-size: 0.7rem; color: var(--muted);">
                            <div style="margin-bottom: 0.5rem;"><strong>Titre:</strong> <span
                                    id="seoTitleLength">0</span>/60</div>
                            <div><strong>Description:</strong> <span id="seoDescLength">0</span>/160</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column: Article List --}}
        <div>
            <div class="card">
                <div class="card-header" style="display: flex; align-items: center; justify-content: space-between;">
                    <h3 class="card-title">Articles publiés</h3>
                    <a href="#" class="btn btn-outline btn-sm">Voir le blog →</a>
                </div>

                <div id="articlesList" class="articles-list" style="max-height: 600px; overflow-y: auto;">
                    {{-- Sample Article Item --}}
                    <div class="article-item" data-id="1">
                        <div class="article-thumbnail">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                        </div>
                        <div class="article-content">
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.35rem;">
                                <x-badge color="green">Recrutement</x-badge>
                            </div>
                            <h4 class="article-title">Comment recruter les meilleurs talents du football</h4>
                            <p class="article-excerpt">Guide complet pour les clubs souhaitant développer une stratégie de
                                recrutement efficace...</p>
                            <div class="article-footer">
                                <div
                                    style="display: flex; align-items: center; gap: 1rem; font-size: 0.75rem; color: var(--muted);">
                                    <span><x-badge color="green">À la une</x-badge></span>
                                    <span>👁 2,350 vues</span>
                                    <span>📅 5 mai 2026</span>
                                </div>
                            </div>
                            <div class="article-actions" style="display: flex; gap: 0.5rem; margin-top: 0.75rem;">
                                <button class="btn btn-outline btn-sm" onclick="editArticle(1)">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                    Modifier
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="deleteArticle(1)">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6" />
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                    </svg>
                                    Supprimer
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Draft Article Item --}}
                    <div class="article-item draft" data-id="2">
                        <div class="article-thumbnail">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                        </div>
                        <div class="article-content">
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.35rem;">
                                <x-badge color="amber">Formation</x-badge>
                            </div>
                            <h4 class="article-title">Programme de formation d'excellence</h4>
                            <p class="article-excerpt">Développer les compétences des jeunes joueurs avec un programme
                                structuré...</p>
                            <div class="article-footer">
                                <div
                                    style="display: flex; align-items: center; gap: 1rem; font-size: 0.75rem; color: var(--muted);">
                                    <span><x-badge color="amber">Brouillon</x-badge></span>
                                    <span>👁 0 vues</span>
                                    <span>📅 3 mai 2026</span>
                                </div>
                            </div>
                            <div class="article-actions" style="display: flex; gap: 0.5rem; margin-top: 0.75rem;">
                                <button class="btn btn-success btn-sm">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <polyline points="20 6 9 17 4 12" />
                                    </svg>
                                    Publier
                                </button>
                                <button class="btn btn-outline btn-sm" onclick="editArticle(2)">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                    Modifier
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="deleteArticle(2)">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6" />
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                    </svg>
                                    Supprimer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Article Form Modal --}}
    @include('components.modals.blog-form')

    {{-- Toast Notification Container --}}
    <div id="toastContainer" style="position: fixed; bottom: 2rem; right: 2rem; z-index: 2000;"></div>

@endsection

@push('scripts')
    <script src="{{ asset('js/blog.js') }}"></script>
@endpush
