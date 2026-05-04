@extends('layouts.dashboard')
@section('title', 'Modération - Admin')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
    <div>
        <h2 style="font-size:1.1rem;font-weight:700">Modération</h2>
        <p class="text-muted text-sm">{{ count($items) }} éléments signalés en attente de revue</p>
    </div>
    <select class="form-select" style="width:auto;min-width:160px;padding:.45rem .75rem;font-size:.8rem">
        <option>Tous les types</option>
        <option>Publication</option>
        <option>Profil</option>
        <option>Commentaire</option>
        <option>Offre</option>
    </select>
</div>

@foreach($items as $item)
<div class="card mb-2">
    <div class="card-body">
        <div style="display:flex;align-items:flex-start;gap:1rem">
            <div style="width:42px;height:42px;border-radius:10px;background:{{ $item['severity'] === 'high' ? 'rgba(239,68,68,.1)' : ($item['severity'] === 'medium' ? 'rgba(245,158,11,.1)' : 'rgba(59,130,246,.1)') }};display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <svg viewBox="0 0 24 24" fill="none" stroke="{{ $item['severity'] === 'high' ? '#dc2626' : ($item['severity'] === 'medium' ? '#d97706' : '#2563eb') }}" stroke-width="2" width="20" height="20"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            </div>
            <div style="flex:1;min-width:0">
                <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.35rem">
                    <x-badge :color="$item['severity'] === 'high' ? 'red' : ($item['severity'] === 'medium' ? 'amber' : 'blue')">
                        {{ $item['severity'] === 'high' ? 'Urgent' : ($item['severity'] === 'medium' ? 'Moyen' : 'Faible') }}
                    </x-badge>
                    <x-badge color="gray">{{ $item['type'] }}</x-badge>
                    <span class="text-muted text-xs">{{ $item['date'] }}</span>
                </div>
                <div class="fw-600" style="font-size:.9rem;margin-bottom:.25rem">{{ $item['reason'] }}</div>
                <div style="background:var(--bg);border-radius:8px;padding:.75rem;margin:.65rem 0;font-size:.82rem;color:var(--muted);border-left:3px solid var(--border)">
                    {{ $item['content'] }}
                </div>
                <div class="text-muted text-xs">
                    Signalé par <strong>{{ $item['reporter'] }}</strong> · Auteur : <strong>{{ $item['author'] }}</strong>
                </div>
            </div>
        </div>
        <div style="display:flex;gap:.5rem;justify-content:flex-end;margin-top:1rem;padding-top:1rem;border-top:1px solid var(--border)">
            <button class="btn btn-success btn-sm">✓ Approuver</button>
            <button class="btn btn-danger btn-sm">✕ Rejeter</button>
            <button class="btn btn-danger btn-sm" style="background:#7f1d1d;color:#fff;border-color:#7f1d1d" onclick="openModerationBan('{{ $item['author'] }}')">Bannir l'utilisateur</button>
        </div>
    </div>
</div>
@endforeach

{{-- Include Moderation Ban Modal --}}
@include('components.modals.moderation-ban')
@endsection
