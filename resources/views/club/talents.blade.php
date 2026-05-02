@extends('layouts.dashboard')
@section('title', 'Rechercher des talents - Club')

@section('content')
{{-- Filter Bar --}}
<div class="card mb-2">
    <div class="card-body">
        <div class="filter-bar">
            <div class="search-input">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" placeholder="Rechercher un talent...">
            </div>
            <select class="form-select" style="width:auto;min-width:160px;padding:.45rem .75rem;font-size:.8rem">
                <option value="">Poste</option>
                @foreach($filters['positions'] as $pos)
                    <option>{{ $pos }}</option>
                @endforeach
            </select>
            <select class="form-select" style="width:auto;min-width:140px;padding:.45rem .75rem;font-size:.8rem">
                <option value="">Localisation</option>
                @foreach($filters['locations'] as $loc)
                    <option>{{ $loc }}</option>
                @endforeach
            </select>
            <select class="form-select" style="width:auto;min-width:140px;padding:.45rem .75rem;font-size:.8rem">
                <option value="">Disponibilité</option>
                @foreach($filters['availability'] as $a)
                    <option>{{ $a }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

{{-- Talent Cards Grid --}}
<div class="grid-3">
    @foreach($talents as $talent)
    <div class="talent-card">
        <div style="display:flex;align-items:center;gap:.85rem;margin-bottom:.85rem">
            <div class="talent-avatar">{{ $talent['initials'] }}</div>
            <div style="flex:1">
                <div class="fw-600" style="font-size:.9rem">{{ $talent['name'] }}</div>
                <div class="text-muted text-sm">{{ $talent['role'] }}</div>
            </div>
            @if($talent['available'])
                <x-badge color="green">Disponible</x-badge>
            @else
                <x-badge color="gray">En poste</x-badge>
            @endif
        </div>
        <div style="font-size:.8rem;color:var(--muted);margin-bottom:.65rem">
            📍 {{ $talent['location'] }} · 💼 {{ $talent['experience'] }} · 📄 {{ $talent['contract'] }}
        </div>
        <div style="display:flex;flex-wrap:wrap;gap:.35rem;margin-bottom:.85rem">
            @foreach($talent['skills'] as $skill)
                <x-badge color="green">{{ $skill }}</x-badge>
            @endforeach
        </div>
        <div style="display:flex;gap:.5rem">
            <button class="btn btn-outline btn-sm" style="flex:1">Voir profil</button>
            <button class="btn btn-primary btn-sm" style="flex:1">Contacter</button>
        </div>
    </div>
    @endforeach
</div>

<div class="pagination">
    <button class="pagination-btn">←</button>
    <button class="pagination-btn active">1</button>
    <button class="pagination-btn">2</button>
    <button class="pagination-btn">3</button>
    <button class="pagination-btn">→</button>
</div>
@endsection
