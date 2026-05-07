@extends('layouts.dashboard')
@section('title', 'Talents - Admin')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
    <h2 style="font-size:1.1rem;font-weight:700">Gestion des talents</h2>
    <div class="search-input" style="max-width:280px">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" placeholder="Rechercher un talent...">
    </div>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1.5rem;margin-bottom:2rem">
    <x-stat-card icon="users" color="blue" :value="$stats['total']" label="Total Talents"/>
    <x-stat-card icon="eye" color="green" :value="$stats['active']" label="Profils Actifs"/>
    <x-stat-card icon="trending" color="amber" :value="$stats['available']" label="Disponibles"/>
    <x-stat-card icon="star" color="red" :value="$stats['suspended']" label="Suspendus"/>
</div>

<x-data-table :headers="['Talent', 'Spécialité', 'Localisation', 'Candidatures', 'Inscription', 'Statut', 'Actions']">
    @foreach($talents as $talent)
    <tr>
        <td>
            <div class="table-user">
                <div class="table-avatar" style="background:linear-gradient(135deg,var(--green-dark),#4ade80)">{{ $talent['initials'] }}</div>
                <div class="table-user-info"><div class="name">{{ $talent['name'] }}</div></div>
            </div>
        </td>
        <td class="text-sm">{{ $talent['role'] }}</td>
        <td class="text-muted text-sm">{{ $talent['location'] }}</td>
        <td class="fw-700">{{ $talent['applications'] }}</td>
        <td class="text-muted text-sm">{{ $talent['joined'] }}</td>
        <td><x-badge :color="$talent['status_color']">{{ $talent['status'] }}</x-badge></td>
        <td>
            <div class="table-actions">
                <a href="{{ route('admin.talents.show', $talent['id']) }}" class="btn btn-outline btn-sm">Voir</a>
                @if($talent['status'] === 'Actif')
                    <button class="btn btn-danger btn-sm">Suspendre</button>
                @elseif($talent['status'] === 'Suspendu')
                    <button class="btn btn-success btn-sm">Réactiver</button>
                @endif
            </div>
        </td>
    </tr>
    @endforeach
</x-data-table>
<x-pagination :total="50" :per-page="10" :current-page="1" />
@endsection
