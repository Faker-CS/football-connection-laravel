@extends('layouts.dashboard')
@section('title', 'Vue d\'ensemble - Admin')

@section('content')
<div class="welcome-banner" style="background:linear-gradient(135deg,#0a1a18 0%,#1a3a35 50%,#0f2420 100%)">
    <h2>Tableau de bord administrateur<p>Vue d'ensemble de la plateforme Football Connect</p></h2>
    
</div>

<div class="stats-grid">
    @foreach($stats as $stat)
        <x-stat-card :icon="$stat['icon']" :color="$stat['color']" :value="$stat['value']" :label="$stat['label']" :trend="$stat['trend'] ?? null" :trendDir="$stat['trend_dir'] ?? null" />
    @endforeach
</div>

<div class="grid-2">
    {{-- Recent Activity --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Activité récente</h3></div>
        <div class="card-body">
            @foreach($recent_activity as $activity)
            <div class="activity-item">
                <div class="activity-dot {{ $activity['color'] }}"></div>
                <div>
                    <div class="activity-text">{{ $activity['text'] }}</div>
                    <div class="activity-time">{{ $activity['time'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Moderation Alerts --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Alertes de modération</h3>
            <a href="{{ route('admin.moderation') }}" class="link-green">Voir tout →</a>
        </div>
        <div class="card-body">
            @foreach($moderation_alerts as $alert)
            <div style="padding:.85rem;border-radius:var(--radius-sm);border:1px solid {{ $alert['severity'] === 'high' ? '#fecaca' : '#fde68a' }};background:{{ $alert['severity'] === 'high' ? '#fef2f2' : '#fffbeb' }};margin-bottom:.75rem">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.35rem">
                    <span class="fw-600 text-sm">{{ $alert['type'] }}</span>
                    <x-badge :color="$alert['severity'] === 'high' ? 'red' : 'amber'">{{ $alert['severity'] === 'high' ? 'Urgent' : 'Moyen' }}</x-badge>
                </div>
                <div class="text-muted text-sm">{{ $alert['target'] }} · Signalé par {{ $alert['reporter'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Top Clubs Table --}}
<div class="card mt-2">
    <div class="card-header"><h3 class="card-title">Top clubs par activité</h3></div>
    <div style="overflow-x:auto">
        <table class="data-table">
            <thead>
                <tr><th>Club</th><th>Ligue</th><th>Offres</th><th>Candidatures</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @foreach($top_clubs as $club)
                <tr>
                    <td>
                        <div class="table-user">
                            <div class="table-avatar" style="background:linear-gradient(135deg,#0a1a18,#1a3a35)">{{ $club['initials'] }}</div>
                            <div class="table-user-info"><div class="name">{{ $club['name'] }}</div></div>
                        </div>
                    </td>
                    <td class="text-sm">{{ $club['league'] }}</td>
                    <td class="fw-700">{{ $club['offers'] }}</td>
                    <td class="fw-700">{{ $club['applications'] }}</td>
                    <td><button class="btn btn-outline btn-sm">Voir</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
