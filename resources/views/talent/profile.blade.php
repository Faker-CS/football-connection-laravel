@extends('layouts.dashboard')
@section('title', 'Mon Profil - Talent')

@section('content')
<div class="grid-2" style="grid-template-columns:1fr 2fr">
    {{-- Left Column: Photo & Quick Info --}}
    <div>
        <div class="card mb-2">
            <div class="card-body" style="text-align:center;padding:2rem">
                <div class="talent-avatar" style="width:80px;height:80px;font-size:1.5rem;margin:0 auto 1rem">{{ $talent['initials'] }}</div>
                <h3 style="font-size:1.1rem;font-weight:700">{{ $talent['name'] }}</h3>
                <p class="text-muted" style="font-size:.82rem">{{ $talent['role'] }}</p>
                <p class="text-muted text-sm mt-1">📍 {{ $talent['city'] }}, {{ $talent['country'] }}</p>
                <button class="btn btn-outline btn-sm mt-2 btn-block">Modifier la photo</button>
            </div>
        </div>

        {{-- Skills --}}
        <div class="card mb-2">
            <div class="card-header"><h3 class="card-title">Compétences</h3></div>
            <div class="card-body">
                <div style="display:flex;flex-wrap:wrap;gap:.4rem">
                    @foreach($skills as $skill)
                        <x-badge color="green">{{ $skill }}</x-badge>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Positions --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Postes recherchés</h3></div>
            <div class="card-body">
                @foreach($positions as $pos)
                    <div style="padding:.4rem 0;font-size:.82rem;display:flex;align-items:center;gap:.5rem">
                        <span style="width:6px;height:6px;border-radius:50%;background:var(--green-dark)"></span>
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
            <div class="card-header"><h3 class="card-title">Informations personnelles</h3></div>
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
            <div class="card-header">
                <h3 class="card-title">Expériences professionnelles</h3>
                <button class="btn btn-outline btn-sm">+ Ajouter</button>
            </div>
            <div class="card-body" style="padding:0">
                @foreach($experiences as $exp)
                <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border)">
                    <div style="display:flex;justify-content:space-between;align-items:flex-start">
                        <div>
                            <div class="fw-600" style="font-size:.9rem">{{ $exp['title'] }}</div>
                            <div class="text-muted text-sm">{{ $exp['club'] }} · {{ $exp['period'] }}</div>
                        </div>
                        <button class="btn btn-outline btn-sm btn-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </button>
                    </div>
                    <p class="text-muted text-sm mt-1">{{ $exp['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Documents --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Documents</h3>
                <button class="btn btn-outline btn-sm">+ Ajouter</button>
            </div>
            <div class="card-body">
                @foreach($documents as $doc)
                <div style="display:flex;align-items:center;justify-content:space-between;padding:.65rem 0;border-bottom:1px solid var(--border)">
                    <div style="display:flex;align-items:center;gap:.75rem">
                        <div style="width:36px;height:36px;border-radius:8px;background:rgba(239,68,68,.08);display:flex;align-items:center;justify-content:center">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" width="16" height="16"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        </div>
                        <div>
                            <div class="fw-600 text-sm">{{ $doc['name'] }}</div>
                            <div class="text-muted text-xs">{{ $doc['size'] }} · {{ $doc['date'] }}</div>
                        </div>
                    </div>
                    <button class="btn btn-outline btn-sm">Télécharger</button>
                </div>
                @endforeach
                <div class="upload-zone mt-2">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="24" height="24" style="margin:0 auto .5rem"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                    <p>Glissez-déposez vos fichiers ici ou <span style="color:var(--green-dark);font-weight:600">parcourir</span></p>
                    <p class="text-xs text-muted mt-1">PDF, DOC, DOCX · Max 10 MB</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
