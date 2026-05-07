@extends('layouts.dashboard')
@section('title', $talent['name'] . ' - Admin Profil Talent')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;gap:1rem;flex-wrap:wrap">
    <div style="flex:1;min-width:0">
        <h2 style="font-size:1.25rem;font-weight:700;margin-bottom:.25rem">{{ $talent['name'] }}</h2>
        <p class="text-muted text-sm">{{ $talent['role'] }} • Rejoint le {{ $talent['joined'] }}</p>
    </div>
    <div style="display:flex;gap:.5rem;flex-shrink:0">
        <x-badge :color="$talent['status_color']">{{ $talent['status'] }}</x-badge>
        @if($talent['status'] === 'Actif')
            <button class="btn btn-danger btn-sm">Suspendre</button>
        @elseif($talent['status'] === 'Suspendu')
            <button class="btn btn-success btn-sm">Réactiver</button>
        @endif
    </div>
</div>

{{-- Stats Bar --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:1rem;margin-bottom:1.5rem">
    <div class="stat-card" style="padding:1rem">
        <div class="stat-num">{{ count($talent['experiences']) }}</div>
        <div class="stat-lbl">Expériences</div>
    </div>
    <div class="stat-card" style="padding:1rem">
        <div class="stat-num">{{ count($talent['skills']) }}</div>
        <div class="stat-lbl">Compétences</div>
    </div>
    <div class="stat-card" style="padding:1rem">
        <div class="stat-num">{{ count($talent['documents']) }}</div>
        <div class="stat-lbl">Documents</div>
    </div>
    <div class="stat-card" style="padding:1rem">
        <div class="stat-num">{{ $talent['applications'] }}</div>
        <div class="stat-lbl">Candidatures</div>
    </div>
</div>

<div class="grid-2">
    {{-- Left Column --}}
    <div>
        {{-- Profile Card --}}
        <div class="card mb-2">
            <div class="card-header">
                <h3 class="card-title">Profil</h3>
            </div>
            <div class="card-body" style="text-align:center">
                <div class="talent-avatar" style="margin:0 auto 1rem;width:64px;height:64px;font-size:1.5rem">{{ $talent['initials'] }}</div>
                <h3 style="font-size:1rem;font-weight:700;margin-bottom:.25rem">{{ $talent['name'] }}</h3>
                <p class="text-muted text-sm" style="margin-bottom:1rem">{{ $talent['role'] }}</p>
                <p class="text-muted text-sm">📍 {{ $talent['city'] }}, {{ $talent['country'] }}</p>
                <p class="text-muted text-xs mt-2">Né(e) le {{ $talent['birthdate'] }}</p>
            </div>
        </div>

        {{-- Contact Information --}}
        <div class="card mb-2">
            <div class="card-header">
                <h3 class="card-title">Informations de contact</h3>
            </div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:1rem">
                <div style="padding:.75rem;background:var(--bg);border-radius:var(--radius-sm);border:1px solid var(--border)">
                    <div class="text-xs text-muted" style="margin-bottom:.3rem">Email</div>
                    <a href="mailto:{{ $talent['email'] }}" class="link-green" style="font-weight:700;font-size:.9rem">{{ $talent['email'] }}</a>
                </div>
                <div style="padding:.75rem;background:var(--bg);border-radius:var(--radius-sm);border:1px solid var(--border)">
                    <div class="text-xs text-muted" style="margin-bottom:.3rem">Téléphone</div>
                    <a href="tel:{{ $talent['phone'] }}" class="link-green" style="font-weight:700;font-size:.9rem">{{ $talent['phone'] }}</a>
                </div>
            </div>
        </div>

        {{-- Bio --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Biographie</h3>
            </div>
            <div class="card-body">
                <p class="text-sm" style="line-height:1.6;color:var(--text)">{{ $talent['bio'] }}</p>
            </div>
        </div>
    </div>

    {{-- Right Column --}}
    <div>
        {{-- Skills --}}
        <div class="card mb-2">
            <div class="card-header">
                <h3 class="card-title">Compétences</h3>
            </div>
            <div class="card-body">
                <div style="display:flex;flex-wrap:wrap;gap:.5rem">
                    @foreach($talent['skills'] as $skill)
                        <span style="background:rgba(172,209,163,.15);color:var(--green-dark);padding:.4rem .75rem;border-radius:20px;font-size:.78rem;font-weight:600">{{ $skill }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Positions Sought --}}
        <div class="card mb-2">
            <div class="card-header">
                <h3 class="card-title">Postes recherchés</h3>
            </div>
            <div class="card-body">
                @forelse($talent['positions'] as $position)
                    <div class="d-flex align-center" style="padding:.5rem 0;font-size:.85rem;gap:.5rem;border-bottom:1px solid var(--border);padding-bottom:.75rem">
                        <span style="width:6px;height:6px;border-radius:50%;background:var(--green-dark);flex-shrink:0;margin-top:2px"></span>
                        {{ $position }}
                    </div>
                @empty
                    <p class="text-muted text-sm">Aucun poste spécifié</p>
                @endforelse
            </div>
        </div>

        {{-- Applications Stats --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Activité</h3>
            </div>
            <div class="card-body">
                <div style="padding:1rem;background:var(--bg);border-radius:var(--radius-sm);border:1px solid var(--border);text-align:center">
                    <div class="stat-num" style="font-size:1.5rem;margin-bottom:.3rem">{{ $talent['applications'] }}</div>
                    <div class="text-sm text-muted">Candidatures soumises</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Experiences Section --}}
<div class="card mb-2" style="margin-top:1.5rem">
    <div class="card-header">
        <h3 class="card-title">Expériences professionnelles</h3>
    </div>
    <div class="card-body" style="padding:0">
        @forelse($talent['experiences'] as $experience)
            <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border)">
                <div style="display:flex;justify-content:space-between;gap:1rem;flex-wrap:wrap;align-items:flex-start;margin-bottom:.5rem">
                    <div>
                        <div style="font-size:.9rem;font-weight:700;color:var(--text)">{{ $experience['title'] }}</div>
                        <div class="text-sm text-muted">{{ $experience['club'] }}</div>
                    </div>
                    <div style="text-align:right;flex-shrink:0">
                        <div class="text-xs text-muted" style="font-weight:600">{{ $experience['period'] }}</div>
                    </div>
                </div>
                <p class="text-sm" style="color:var(--muted);line-height:1.5;margin-top:.5rem">{{ $experience['description'] }}</p>
            </div>
        @empty
            <div style="padding:1.5rem;text-align:center;color:var(--muted)">
                <p class="text-sm">Aucune expérience enregistrée</p>
            </div>
        @endforelse
    </div>
</div>

{{-- Documents Section --}}
<div class="card" style="margin-bottom:2rem">
    <div class="card-header">
        <h3 class="card-title">Documents</h3>
    </div>
    <div class="card-body">
        @forelse($talent['documents'] as $document)
            <div class="d-flex align-center justify-between" style="padding:.75rem 0;border-bottom:1px solid var(--border);gap:.75rem;flex-wrap:wrap">
                <div class="d-flex align-center" style="gap:.75rem;min-width:0;flex:1">
                    <div style="width:40px;height:40px;border-radius:8px;background:rgba(239,68,68,.08);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" width="18" height="18">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                        </svg>
                    </div>
                    <div style="min-width:0">
                        <div class="fw-600 text-sm">{{ $document['name'] }}</div>
                        <div class="text-muted text-xs">{{ $document['size'] }} · {{ $document['date'] }}</div>
                    </div>
                </div>
                <button class="btn btn-outline btn-sm" style="flex-shrink:0">Télécharger</button>
            </div>
        @empty
            <div style="text-align:center;padding:2rem;color:var(--muted)">
                <p class="text-sm">Aucun document disponible</p>
            </div>
        @endforelse
    </div>
</div>

@endsection
