@extends('layouts.dashboard')
@section('title', 'Opportunités - Talent')

@section('content')
{{-- Filter Bar --}}
{{-- <div class="card mb-2">
    <div class="card-body">
        <div class="filter-bar">
            <div class="search-input">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" placeholder="Rechercher une offre...">
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
                <option value="">Contrat</option>
                @foreach($filters['contracts'] as $c)
                    <option>{{ $c }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

{{-- Offers Grid --}}
{{-- <div class="grid-3">
    @foreach($offers as $offer)
    <div class="offer-card">
        <div class="offer-card-header">
            <div class="offer-icon {{ $offer['icon_color'] }}">{{ $offer['club_initials'] }}</div>
            <div style="flex:1;min-width:0">
                <div class="offer-card-title">{{ $offer['title'] }}</div>
                <div class="offer-card-sub">{{ $offer['club'] }} · {{ $offer['location'] }}</div>
            </div>
        </div>
        <div class="offer-card-tags">
            <x-badge :color="'green'">{{ $offer['type'] }}</x-badge>
            @foreach($offer['tags'] as $tag)
                <x-badge :color="'gray'">{{ $tag }}</x-badge>
            @endforeach
        </div>
        <div style="font-size:.82rem;color:var(--muted);margin-bottom:.5rem">
            💰 {{ $offer['salary'] }} · 📅 {{ $offer['posted'] }}
        </div>
        <div class="offer-card-footer">
            <button class="btn btn-outline btn-sm">Détails</button>
            <button class="btn btn-primary btn-sm">Postuler</button>
        </div>
    </div>
    @endforeach
</div> --}}

{{-- Pagination --}}
{{-- <div class="pagination">
    <button class="pagination-btn">←</button>
    <button class="pagination-btn active">1</button>
    <button class="pagination-btn">2</button>
    <button class="pagination-btn">3</button>
    <button class="pagination-btn">→</button>
</div> --}}
@endsection
