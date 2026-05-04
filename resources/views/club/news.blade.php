@extends('layouts.dashboard')
@section('title', 'Actualités - Club')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
    <div>
        <h2 style="font-size:1.1rem;font-weight:700">Actualités & Événements</h2>
        <p class="text-muted text-sm">Gérez vos publications et événements</p>
    </div>
    <button class="btn btn-primary" onclick="ModalManager.open('newsFormModal')">+ Créer une actualité</button>
</div>

<div class="grid-2">
    @foreach($news as $item)
    <div class="card">
        <div style="height:140px;background:linear-gradient(135deg,#e8f5e9,#c8e6c9);border-radius:var(--radius) var(--radius) 0 0;display:flex;align-items:center;justify-content:center">
            <svg viewBox="0 0 24 24" fill="none" stroke="var(--green-dark)" stroke-width="1.5" width="40" height="40"><path d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v1m2 13a2 2 0 0 1-2-2V7m2 13a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2"/></svg>
        </div>
        <div class="card-body">
            <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.65rem">
                <x-badge :color="$item['status_color']">{{ $item['status'] }}</x-badge>
                <x-badge color="blue">{{ $item['type'] }}</x-badge>
            </div>
            <h4 style="font-size:.9rem;font-weight:700;margin-bottom:.4rem">{{ $item['title'] }}</h4>
            <p class="text-muted text-sm" style="line-height:1.5;margin-bottom:.75rem">{{ $item['excerpt'] }}</p>
            <div style="display:flex;align-items:center;justify-content:space-between">
                <span class="text-muted text-xs">📅 {{ $item['date'] }}</span>
                <div class="table-actions">
                    <button class="btn btn-outline btn-sm">Modifier</button>
                    <button class="btn btn-danger btn-sm">Supprimer</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Include Modal --}}
@include('components.modals.news-form')
@endsection
