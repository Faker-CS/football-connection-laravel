@extends('layouts.dashboard')
@section('title', 'Publications - Talent')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
    <div>
        <h2 style="font-size:1.1rem;font-weight:700">Mes Publications</h2>
        <p class="text-muted text-sm">Partagez vos connaissances et votre expertise</p>
    </div>
    <button class="btn btn-primary" onclick="ModalManager.open('publicationFormModal')">+ Créer une publication</button>
</div>

<div class="grid-3">
    @foreach($publications as $pub)
    <div class="card">
        <div style="height:160px;background:linear-gradient(135deg,#e8f5e9,#c8e6c9);border-radius:var(--radius) var(--radius) 0 0;display:flex;align-items:center;justify-content:center">
            <svg viewBox="0 0 24 24" fill="none" stroke="var(--green-dark)" stroke-width="1.5" width="48" height="48"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
        </div>
        <div class="card-body">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.5rem">
                <x-badge :color="$pub['status_color']">{{ $pub['status'] }}</x-badge>
                @if($pub['views'] > 0)
                    <span class="text-muted text-xs">👁 {{ $pub['views'] }} vues</span>
                @endif
            </div>
            <h4 style="font-size:.9rem;font-weight:700;margin-bottom:.4rem;line-height:1.4">{{ $pub['title'] }}</h4>
            <p class="text-muted text-sm" style="line-height:1.5;margin-bottom:.65rem">{{ Str::limit($pub['excerpt'], 100) }}</p>
            <div style="display:flex;align-items:center;justify-content:space-between">
                <span class="text-muted text-xs">{{ $pub['date'] }}</span>
                <button class="btn btn-outline btn-sm">Modifier</button>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Include Publication Modal --}}
@include('components.modals.publications-form')
@endsection
