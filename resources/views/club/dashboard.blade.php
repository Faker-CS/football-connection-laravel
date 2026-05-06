@extends('layouts.dashboard')
@section('title', 'Tableau de bord - Club')

@section('content')
    <div class="welcome-banner">
        <div>
            <h2>Bienvenue, {{ $club['name'] }} !</h2>
            <p>Gérez vos offres, suivez vos candidatures et trouvez les meilleurs talents.</p>
        </div>
        <div class="welcome-cta">
            <a href="{{ route('club.offers.create') }}" class="btn btn-primary btn-lg">+ Publier une offre</a>
            <a href="{{ route('club.applications') }}" class="btn btn-outline btn-lg">Voir les candidatures</a>
        </div>
    </div>

    <div class="stats-grid">
        @foreach ($stats as $stat)
            <x-stat-card :icon="$stat['icon']" :color="$stat['color']" :value="$stat['value']" :label="$stat['label']" :trend="$stat['trend'] ?? null"
                :trendDir="$stat['trend_dir'] ?? null" :badge="$stat['badge'] ?? null" :badgeColor="$stat['badge_color'] ?? null" />
        @endforeach
    </div>

    <div class="grid-2">
        {{-- Active Offers --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Offres actives</h3>
                <a href="{{ route('club.offers') }}" class="link-green">Voir tout →</a>
            </div>
            <div class="card-body" style="padding:0">
                @foreach ($active_offers as $offer)
                    <div
                        style="padding:1rem 1.5rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:1rem">
                        <div class="offer-icon {{ $offer['icon_color'] }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18"
                                height="18">
                                <rect x="2" y="7" width="20" height="14" rx="2" />
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                            </svg>
                        </div>
                        <div style="flex:1;min-width:0">
                            <div class="fw-600" style="font-size:.85rem">{{ $offer['title'] }}</div>
                            <div class="text-muted text-sm">{{ $offer['type'] }} · {{ $offer['location'] }} ·
                                {{ $offer['salary'] }}</div>
                        </div>
                        <div style="text-align:right">
                            <x-badge :color="$offer['status_color']">{{ $offer['status'] }}</x-badge>
                            <div class="text-muted text-xs mt-1">{{ $offer['applicants'] }} candidat(s)</div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card-footer">
                <a href="{{ route('club.offers.create') }}" class="link-green">+ Publier une nouvelle offre</a>
            </div>
        </div>

        {{-- Recent Applications --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Candidatures récentes</h3>
                <a href="{{ route('club.applications') }}" class="link-green">Voir tout →</a>
            </div>
            <div class="card-body" style="padding:0">
                @foreach ($recent_applications as $app)
                    <div
                        style="padding:1rem 1.5rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:.85rem">
                        <div class="table-avatar" style="background:linear-gradient(135deg,var(--green-dark),#4ade80) ">
                            {{ $app['initials'] }}</div>
                        <div style="flex:1;min-width:0">
                            <div class="fw-600" style="font-size:.85rem">{{ $app['name'] }}</div>
                            <div class="text-muted text-sm">{{ $app['role'] }} · {{ $app['city'] }}</div>
                        </div>
                        <x-badge :color="$app['status_color']">{{ $app['status'] }}</x-badge>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Recommended Talents --}}
    <div class="card mt-2">
        <div class="card-header">
            <h3 class="card-title">Talents recommandés</h3>
            <a href="#" class="btn btn-outline btn-sm">Explorer</a>
        </div>
        <div class="card-body">
            <div class="grid-3">
                @foreach ($recommended_talents as $talent)
                    <div class="talent-card">
                        <div style="display:flex;align-items:center;gap:.85rem;margin-bottom:.85rem">
                            <div class="talent-avatar">{{ $talent['initials'] }}</div>
                            <div>
                                <div class="fw-600" style="font-size:.9rem">{{ $talent['name'] }}</div>
                                <div class="text-muted text-sm">{{ $talent['role'] }}</div>
                            </div>
                        </div>
                        <div style="font-size:.8rem;color:var(--muted);margin-bottom:.75rem">
                            📍 {{ $talent['location'] }} · 📄 {{ $talent['contract'] }}
                        </div>
                        @if ($talent['available'])
                            <x-badge color="green">Disponible</x-badge>
                        @else
                            <x-badge color="gray">En poste</x-badge>
                        @endif
                        <div style="margin-top:.85rem;display:flex;gap:.5rem">
                            <button class="btn btn-outline btn-sm" style="flex:1">Voir profil</button>
                            <button class="btn btn-primary btn-sm" style="flex:1">Contacter</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
