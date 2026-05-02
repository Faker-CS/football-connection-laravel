@extends('layouts.dashboard')
@section('title', 'Statistiques - Admin')

@section('content')
<div style="margin-bottom:1.5rem">
    <h2 style="font-size:1.1rem;font-weight:700">Statistiques de la plateforme</h2>
    <p class="text-muted text-sm">Analyse des performances et tendances</p>
</div>

{{-- Platform Stats Cards --}}
<div class="stats-grid" style="margin-bottom:2rem">
    @foreach($platform_stats as $stat)
    <div class="stat-card">
        <div>
            <div class="stat-num" style="font-size:1.3rem">{{ $stat['value'] }}</div>
            <div class="stat-lbl">{{ $stat['label'] }}</div>
            <div class="text-muted text-xs mt-1">{{ $stat['description'] }}</div>
        </div>
    </div>
    @endforeach
</div>

<div class="grid-2">
    {{-- User Growth Chart --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Croissance des utilisateurs</h3></div>
        <div class="card-body">
            <div class="chart-bar-group">
                @foreach($user_growth as $month)
                <div class="chart-bar-item">
                    <div class="chart-bar-label">{{ $month['month'] }}</div>
                    <div class="chart-bar-track">
                        <div class="chart-bar-fill green" style="width:{{ $month['percent'] }}%"></div>
                    </div>
                    <div class="chart-bar-value">{{ $month['value'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Offer Categories Chart --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Offres par catégorie</h3></div>
        <div class="card-body">
            <div class="chart-bar-group">
                @foreach($offer_categories as $cat)
                <div class="chart-bar-item">
                    <div class="chart-bar-label">{{ $cat['name'] }}</div>
                    <div class="chart-bar-track">
                        <div class="chart-bar-fill {{ $cat['color'] }}" style="width:{{ $cat['percent'] }}%"></div>
                    </div>
                    <div class="chart-bar-value">{{ $cat['count'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
