@extends('layouts.dashboard')
@section('title', 'Mes Candidatures - Talent')

@section('content')
<x-data-table :headers="['Offre', 'Club', 'Date', 'Statut', 'Actions']">
    <x-slot:title>Mes Candidatures</x-slot:title>
    <x-slot:action><span class="text-muted text-sm">{{ count($applications) }} candidatures</span></x-slot:action>

    @foreach($applications as $app)
    <tr>
        <td>
            <div class="table-user">
                <div class="table-avatar" style="background:linear-gradient(135deg,var(--green-dark),#4ade80)">{{ $app['club_initials'] }}</div>
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
                @if($app['status'] === 'Entretien')
                    <button class="btn btn-primary btn-sm">Préparer</button>
                @endif
            </div>
        </td>
    </tr>
    @endforeach
</x-data-table>
@endsection
