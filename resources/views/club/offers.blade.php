@extends('layouts.dashboard')
@section('title', 'Mes Offres - Club')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
    <div>
        <h2 style="font-size:1.1rem;font-weight:700">Mes Offres</h2>
        <p class="text-muted text-sm">{{ count($offers) }} offres publiées</p>
    </div>
    <a href="{{ route('club.offers.create') }}" class="btn btn-primary">+ Nouvelle offre</a>
</div>

<x-data-table :headers="['Offre', 'Type', 'Salaire', 'Candidats', 'Vues', 'Statut', 'Date', 'Actions']">
    @foreach($offers as $offer)
    <tr>
        <td><span class="fw-600">{{ $offer['title'] }}</span></td>
        <td><x-badge color="blue">{{ $offer['type'] }}</x-badge></td>
        <td class="text-sm">{{ $offer['salary'] }}</td>
        <td>
            <span class="fw-700">{{ $offer['applicants'] }}</span>
        </td>
        <td class="text-muted text-sm">{{ $offer['views'] }}</td>
        <td><x-badge :color="$offer['status_color']">{{ $offer['status'] }}</x-badge></td>
        <td class="text-muted text-sm">{{ $offer['date'] }}</td>
        <td>
            <div class="table-actions">
                <button class="btn btn-outline btn-sm">Modifier</button>
                @if($offer['status'] === 'Active')
                    <button class="btn btn-warning btn-sm">Pause</button>
                @endif
                <button class="btn btn-danger btn-sm">Suppr.</button>
            </div>
        </td>
    </tr>
    @endforeach
</x-data-table>
@endsection
