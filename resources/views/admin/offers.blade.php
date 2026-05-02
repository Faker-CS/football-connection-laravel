@extends('layouts.dashboard')
@section('title', 'Offres - Admin')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
    <h2 style="font-size:1.1rem;font-weight:700">Gestion des offres</h2>
    <div class="search-input" style="max-width:280px">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" placeholder="Rechercher une offre...">
    </div>
</div>

<x-data-table :headers="['Offre', 'Club', 'Date', 'Candidats', 'Statut', 'Actions']">
    @foreach($offers as $offer)
    <tr>
        <td><span class="fw-600">{{ $offer['title'] }}</span></td>
        <td>
            <div class="table-user">
                <div class="table-avatar" style="background:linear-gradient(135deg,#0a1a18,#1a3a35);width:28px;height:28px;font-size:.6rem">{{ $offer['club_initials'] }}</div>
                <span class="text-sm">{{ $offer['club'] }}</span>
            </div>
        </td>
        <td class="text-muted text-sm">{{ $offer['date'] }}</td>
        <td class="fw-700">{{ $offer['applicants'] }}</td>
        <td><x-badge :color="$offer['status_color']">{{ $offer['status'] }}</x-badge></td>
        <td>
            <div class="table-actions">
                <button class="btn btn-outline btn-sm">Voir</button>
                @if($offer['status'] === 'En attente')
                    <button class="btn btn-success btn-sm">Approuver</button>
                    <button class="btn btn-danger btn-sm">Rejeter</button>
                @elseif($offer['status'] === 'Active')
                    <button class="btn btn-danger btn-sm">Supprimer</button>
                @endif
            </div>
        </td>
    </tr>
    @endforeach
</x-data-table>
@endsection
