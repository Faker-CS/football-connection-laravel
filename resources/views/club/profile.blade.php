@extends('layouts.dashboard')
@section('title', 'Mon Club - Club')

@section('content')
<div class="grid-2">
    {{-- Left: Club Card --}}
    <div>
        <div class="card mb-2">
            <div class="card-body" style="text-align:center">
                <div class="talent-avatar" style="width:80px;height:80px;font-size:1.5rem;margin:0 auto 1rem;background:linear-gradient(135deg,#0a1a18,#1a3a35)">{{ $club['initials'] }}</div>
                <h3 style="font-size:1.1rem;font-weight:700">{{ $club['name'] }}</h3>
                <p class="text-muted text-sm">{{ $club['league'] }}</p>
                <p class="text-muted text-xs mt-1">📍 {{ $club['city'] }}, {{ $club['country'] }}</p>
                <p class="text-muted text-xs">🏟 {{ $club['stadium'] }}</p>
                <button class="btn btn-outline btn-sm mt-2 btn-block">Modifier le logo</button>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h3 class="card-title">Réseaux sociaux</h3></div>
            <div class="card-body">
                @foreach($club['social'] as $platform => $handle)
                <div style="display:flex;align-items:center;justify-content:space-between;padding:.5rem 0;border-bottom:1px solid var(--border)">
                    <span class="fw-600 text-sm" style="text-transform:capitalize">{{ $platform }}</span>
                    <span class="text-muted text-sm">{{ $handle }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Right: Form --}}
    <div>
        <div class="card">
            <div class="card-header"><h3 class="card-title">Informations du club</h3></div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nom du club</label>
                        <input type="text" class="form-input" value="{{ $club['name'] }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ligue / Division</label>
                        <input type="text" class="form-input" value="{{ $club['league'] }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Ville</label>
                        <input type="text" class="form-input" value="{{ $club['city'] }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Année de fondation</label>
                        <input type="text" class="form-input" value="{{ $club['founded'] }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Stade</label>
                        <input type="text" class="form-input" value="{{ $club['stadium'] }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Site web</label>
                        <input type="url" class="form-input" value="{{ $club['website'] }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea class="form-textarea" rows="4">{{ $club['description'] }}</textarea>
                </div>
                <button class="btn btn-primary">Sauvegarder les modifications</button>
            </div>
        </div>
    </div>
</div>
@endsection
