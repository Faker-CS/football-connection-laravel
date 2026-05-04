@extends('layouts.dashboard')
@section('title', 'Tableau de bord - Talent')

@section('content')
{{-- Welcome Banner --}}
<div class="welcome-banner">
    <div>
    <h2>Bonjour, {{ $talent['name'] }} !</h2>
    <p>Bienvenue sur votre espace talent. Voici un résumé de votre activité.</p>
</div>
    <div style="display: flex; gap: .75rem; flex-shrink: 0; flex-wrap: wrap;">
        <button class="btn btn-primary btn-lg" onclick="window.location.href='{{ route('talent.profile') }}'">Compléter mon profil</button>
        <button class="btn btn-dark btn-lg" href="#">Explorer les opportunités</button>
    </div>
</div>

{{-- Stats --}}
<div class="stats-grid">
    @foreach($stats as $stat)
        <x-stat-card
            :icon="$stat['icon']"
            :color="$stat['color']"
            :value="$stat['value']"
            :label="$stat['label']"
            :trend="$stat['trend'] ?? null"
            :trendDir="$stat['trend_dir'] ?? null"
        />
    @endforeach
</div>

{{-- Profile Completion --}}
<div class="card mb-3">
    <div class="card-body">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.65rem">
            <span class="fw-600" style="font-size:.85rem">Complétion du profil</span>
            <span class="fw-700" style="color:var(--green-dark)">{{ $talent['profile_completion'] }}%</span>
        </div>
        <div class="progress-bar">
            <div class="progress-fill" style="width:{{ $talent['profile_completion'] }}%"></div>
        </div>
        <p class="text-muted text-sm mt-1">Complétez votre profil pour augmenter votre visibilité auprès des clubs.</p>
    </div>
</div>

<div class="grid-2">
    {{-- Recommended Offers --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Offres recommandées</h3>
            <a href="{{ route('talent.opportunities') }}" class="link-green">Voir tout →</a>
        </div>
        <div class="card-body" style="padding:0">
            @foreach($recommended_offers as $offer)
            <div style="padding:1rem 1.5rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:1rem">
                <div class="offer-icon {{ $offer['icon_color'] }}">{{ $offer['club_initials'] }}</div>
                <div style="flex:1;min-width:0">
                    <div class="fw-600" style="font-size:.85rem">{{ $offer['title'] }}</div>
                    <div class="text-muted text-sm">{{ $offer['club'] }} · {{ $offer['location'] }}</div>
                </div>
                <div style="text-align:right">
                    <x-badge :color="'green'">{{ $offer['type'] }}</x-badge>
                    <div class="text-muted text-xs mt-1">{{ $offer['salary'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Recent Applications --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Candidatures récentes</h3>
            <a href="{{ route('talent.applications') }}" class="link-green">Voir tout →</a>
        </div>
        <div class="card-body" style="padding:0">
            @foreach($recent_applications as $app)
            <div style="padding:1rem 1.5rem;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between">
                <div>
                    <div class="fw-600" style="font-size:.85rem">{{ $app['offer'] }}</div>
                    <div class="text-muted text-sm">{{ $app['club'] }} · {{ $app['date'] }}</div>
                </div>
                <x-badge :color="$app['status_color']">{{ $app['status'] }}</x-badge>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
