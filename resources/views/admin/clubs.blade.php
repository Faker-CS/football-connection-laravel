@extends('layouts.dashboard')
@section('title', 'Clubs - Admin')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
    <h2 style="font-size:1.1rem;font-weight:700">Gestion des clubs</h2>
    <div class="search-input" style="max-width:280px">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" placeholder="Rechercher un club...">
    </div>
</div>

<x-data-table :headers="['Club', 'Ligue', 'Offres', 'Membres', 'Inscription', 'Statut', 'Actions']">
    @foreach($clubs as $club)
    <tr>
        <td>
            <div class="table-user">
                <div class="table-avatar" style="background:linear-gradient(135deg,#0a1a18,#1a3a35)">{{ $club['initials'] }}</div>
                <div class="table-user-info"><div class="name">{{ $club['name'] }}</div></div>
            </div>
        </td>
        <td class="text-sm">{{ $club['league'] }}</td>
        <td class="fw-700">{{ $club['offers'] }}</td>
        <td class="text-sm">{{ $club['members'] }}</td>
        <td class="text-muted text-sm">{{ $club['joined'] }}</td>
        <td><x-badge :color="$club['status_color']">{{ $club['status'] }}</x-badge></td>
        <td>
            <div class="table-actions">
                <button class="btn btn-outline btn-sm">Voir</button>
                @if($club['status'] === 'En attente')
                    <button class="btn btn-success btn-sm">Approuver</button>
                @endif
                @if($club['status'] === 'Actif')
                    <button class="btn btn-danger btn-sm">Suspendre</button>
                @endif
                @if($club['status'] === 'Suspendu')
                    <button class="btn btn-success btn-sm">Réactiver</button>
                @endif
            </div>
        </td>
    </tr>
    @endforeach
</x-data-table>
@endsection
