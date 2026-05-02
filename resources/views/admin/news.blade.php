@extends('layouts.dashboard')
@section('title', 'Actualités - Admin')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
    <h2 style="font-size:1.1rem;font-weight:700">Gestion des actualités</h2>
    <div class="search-input" style="max-width:280px">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" placeholder="Rechercher...">
    </div>
</div>

<x-data-table :headers="['Titre', 'Auteur', 'Type', 'Date', 'Statut', 'Actions']">
    @foreach($news as $item)
    <tr>
        <td><span class="fw-600">{{ $item['title'] }}</span></td>
        <td class="text-sm">{{ $item['author'] }}</td>
        <td><x-badge :color="$item['author_type'] === 'Club' ? 'blue' : 'purple'">{{ $item['author_type'] }}</x-badge></td>
        <td class="text-muted text-sm">{{ $item['date'] }}</td>
        <td><x-badge :color="$item['status_color']">{{ $item['status'] }}</x-badge></td>
        <td>
            <div class="table-actions">
                <button class="btn btn-outline btn-sm">Voir</button>
                @if($item['status'] === 'En attente')
                    <button class="btn btn-success btn-sm">Publier</button>
                    <button class="btn btn-danger btn-sm">Rejeter</button>
                @elseif($item['status'] === 'Publié')
                    <button class="btn btn-danger btn-sm">Dépublier</button>
                @endif
            </div>
        </td>
    </tr>
    @endforeach
</x-data-table>
@endsection
