@extends('layouts.dashboard')
@section('title', $club['name'] . ' - Admin Profil Club')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;gap:1rem;flex-wrap:wrap">
    <div style="flex:1;min-width:0">
        <h2 style="font-size:1.25rem;font-weight:700;margin-bottom:.25rem">{{ $club['name'] }}</h2>
        <p class="text-muted text-sm">{{ $club['league'] }} • Rejoint le {{ $club['joined'] }}</p>
    </div>
    <div style="display:flex;gap:.5rem;flex-shrink:0">
        <x-badge :color="$club['status_color']">{{ $club['status'] }}</x-badge>
        @if($club['status'] === 'En attente')
            <button class="btn btn-success btn-sm">Approuver</button>
        @elseif($club['status'] === 'Actif')
            <button class="btn btn-danger btn-sm">Suspendre</button>
        @elseif($club['status'] === 'Suspendu')
            <button class="btn btn-success btn-sm">Réactiver</button>
        @endif
    </div>
</div>

{{-- Stats Bar --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:1rem;margin-bottom:1.5rem">
    <div class="stat-card" style="padding:1rem">
        <div class="stat-num">{{ $club['offers'] }}</div>
        <div class="stat-lbl">Offres publiées</div>
    </div>
    <div class="stat-card" style="padding:1rem">
        <div class="stat-num">{{ $club['members'] }}</div>
        <div class="stat-lbl">Membres d'équipe</div>
    </div>
    <div class="stat-card" style="padding:1rem">
        <div class="stat-num">{{ $club['staff_count'] }}</div>
        <div class="stat-lbl">Personnel</div>
    </div>
    <div class="stat-card" style="padding:1rem">
        <div class="stat-num">{{ $club['academy_players'] }}</div>
        <div class="stat-lbl">Joueurs académie</div>
    </div>
</div>

<div class="grid-2">
    {{-- Left Column --}}
    <div>
        {{-- Club Card --}}
        <div class="card mb-2">
            <div class="card-header">
                <h3 class="card-title">Profil du club</h3>
            </div>
            <div class="card-body" style="text-align:center">
                <div class="talent-avatar" style="margin:0 auto 1rem;width:64px;height:64px;font-size:1.5rem;background:linear-gradient(135deg,#0a1a18,#1a3a35)">{{ $club['initials'] }}</div>
                <h3 style="font-size:1rem;font-weight:700;margin-bottom:.25rem">{{ $club['name'] }}</h3>
                <p class="text-muted text-sm" style="margin-bottom:1rem">{{ $club['league'] }}</p>
                <p class="text-muted text-sm">📍 {{ $club['city'] }}, {{ $club['country'] }}</p>
                <p class="text-muted text-xs mt-2">🏟 {{ $club['stadium'] }}</p>
                <p class="text-muted text-xs">Fondé en {{ $club['founded'] }}</p>
            </div>
        </div>

        {{-- Contact Information --}}
        <div class="card mb-2">
            <div class="card-header">
                <h3 class="card-title">Informations de contact</h3>
            </div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:1rem">
                <div style="padding:.75rem;background:var(--bg);border-radius:var(--radius-sm);border:1px solid var(--border)">
                    <div class="text-xs text-muted" style="margin-bottom:.3rem">Site web</div>
                    <a href="{{ $club['website'] }}" target="_blank" class="link-green" style="font-weight:700;font-size:.9rem;word-break:break-all">{{ str_replace(['https://', 'http://', 'www.'], '', $club['website']) }}</a>
                </div>
            </div>
        </div>

        {{-- Training Facilities --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Installations</h3>
            </div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:1rem">
                <div style="padding:.75rem;background:var(--bg);border-radius:var(--radius-sm);border:1px solid var(--border)">
                    <div class="text-xs text-muted" style="margin-bottom:.3rem">Stade</div>
                    <div style="font-weight:700;font-size:.9rem">{{ $club['stadium'] }}</div>
                </div>
                <div style="padding:.75rem;background:var(--bg);border-radius:var(--radius-sm);border:1px solid var(--border)">
                    <div class="text-xs text-muted" style="margin-bottom:.3rem">Centre d'entraînement</div>
                    <div style="font-weight:700;font-size:.9rem">{{ $club['training_grounds'] }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Column --}}
    <div>
        {{-- Description --}}
        <div class="card mb-2">
            <div class="card-header">
                <h3 class="card-title">À propos</h3>
            </div>
            <div class="card-body">
                <p class="text-sm" style="line-height:1.6;color:var(--text)">{{ $club['description'] }}</p>
            </div>
        </div>

        {{-- Social Media --}}
        <div class="card mb-2">
            <div class="card-header">
                <h3 class="card-title">Réseaux sociaux</h3>
            </div>
            <div class="card-body">
                <div style="display:flex;flex-direction:column;gap:.75rem">
                    @foreach($club['social'] as $platform => $handle)
                        <div style="padding:.75rem;background:var(--bg);border-radius:var(--radius-sm);border:1px solid var(--border);display:flex;align-items:center;gap:.75rem;justify-content:space-between">
                            <div>
                                <div class="text-xs text-muted" style="margin-bottom:.2rem;text-transform:capitalize">{{ $platform }}</div>
                                <div style="font-weight:600;font-size:.85rem">{{ $handle }}</div>
                            </div>
                            <a href="@if($platform === 'twitter')https://twitter.com/{{ str_replace('@', '', $handle) }}@elseif($platform === 'instagram')https://instagram.com/{{ str_replace('@', '', $handle) }}@elseif($platform === 'linkedin')https://linkedin.com/company/{{ $handle }}@endif" target="_blank" class="btn btn-outline btn-sm" style="flex-shrink:0">
                                Visiter
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Key Metrics --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ressources</h3>
            </div>
            <div class="card-body">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem">
                    <div style="padding:1rem;background:var(--bg);border-radius:var(--radius-sm);border:1px solid var(--border);text-align:center">
                        <div style="font-size:1.25rem;font-weight:800;color:var(--text)">{{ $club['staff_count'] }}</div>
                        <div class="text-xs text-muted">Personnel</div>
                    </div>
                    <div style="padding:1rem;background:var(--bg);border-radius:var(--radius-sm);border:1px solid var(--border);text-align:center">
                        <div style="font-size:1.25rem;font-weight:800;color:var(--text)">{{ $club['academy_players'] }}</div>
                        <div class="text-xs text-muted">Joueurs académie</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Recent Recruitments Section --}}
@if(count($club['recent_recruitments']) > 0)
<div class="card" style="margin-top:1.5rem;margin-bottom:2rem">
    <div class="card-header">
        <h3 class="card-title">Recrutements récents</h3>
    </div>
    <div class="card-body" style="padding:0">
        @forelse($club['recent_recruitments'] as $recruitment)
            <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;gap:1rem;flex-wrap:wrap;align-items:center">
                <div>
                    <div style="font-size:.9rem;font-weight:700;color:var(--text)">{{ $recruitment['name'] }}</div>
                    <div class="text-sm text-muted">{{ $recruitment['position'] }}</div>
                </div>
                <div class="text-xs text-muted" style="font-weight:600;flex-shrink:0">{{ $recruitment['date'] }}</div>
            </div>
        @empty
            <div style="padding:1.5rem;text-align:center;color:var(--muted)">
                <p class="text-sm">Aucun recrutement récent</p>
            </div>
        @endforelse
    </div>
</div>
@endif

@endsection
