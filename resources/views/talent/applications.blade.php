@extends('layouts.dashboard')
@section('title', 'Mes Candidatures - Talent')

@section('content')
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
        <h2 style="font-size:1.1rem;font-weight:700">Mes Candidatures</h2>
        <div class="search-input" style="max-width:280px">

            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
            <input type="text" placeholder="Rechercher un candidature...">
        </div>
    </div>
    <x-data-table :headers="['Offre', 'Club', 'Date', 'Statut', 'Actions']">
        <x-slot:title>Mes Candidatures</x-slot:title>
        <x-slot:action><span class="text-muted text-sm">{{ count($applications) }} candidatures</span></x-slot:action>

        @foreach ($applications as $app)
            <tr>
                <td>
                    <div class="table-user">
                        <div class="table-avatar" style="background:linear-gradient(135deg,var(--green-dark),#4ade80)">
                            {{ $app['club_initials'] }}</div>
                        <div class="table-user-info">
                            <div class="name">{{ $app['offer'] }}</div>
                        </div>
                    </div>
                </td>
                <td>{{ $app['club'] }}</td>
                <td class="text-muted text-sm">{{ $app['date'] }}</td>
                <td><x-badge :color="$app['status_color']">{{ $app['status'] }}</x-badge></td>
                <td>
                    <div class="table-actions">
                        <button class="btn btn-outline btn-sm">Voir</button>
                        @if ($app['status'] === 'Entretien')
                            <button class="btn btn-primary btn-sm">Préparer</button>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </x-data-table>
    <x-pagination :total="50" :per-page="10" :current-page="1" />
@endsection
