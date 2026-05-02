@extends('layouts.dashboard')
@section('title', 'Candidatures - Admin')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
    <h2 style="font-size:1.1rem;font-weight:700">Gestion des candidatures</h2>
    <select class="form-select" style="width:auto;min-width:160px;padding:.45rem .75rem;font-size:.8rem">
        <option>Tous les statuts</option>
        <option>Nouveau</option>
        <option>En cours</option>
        <option>Entretien</option>
        <option>Accepté</option>
        <option>Refusé</option>
    </select>
</div>

<x-data-table :headers="['Candidat', 'Offre', 'Club', 'Date', 'Statut', 'Actions']">
    @foreach($applications as $app)
    <tr>
        <td>
            <div class="table-user">
                <div class="table-avatar" style="background:linear-gradient(135deg,var(--green-dark),#4ade80)">{{ $app['initials'] }}</div>
                <div class="table-user-info"><div class="name">{{ $app['applicant'] }}</div></div>
            </div>
        </td>
        <td class="text-sm fw-600">{{ $app['offer'] }}</td>
        <td class="text-sm">{{ $app['club'] }}</td>
        <td class="text-muted text-sm">{{ $app['date'] }}</td>
        <td><x-badge :color="$app['status_color']">{{ $app['status'] }}</x-badge></td>
        <td>
            <div class="table-actions">
                <button class="btn btn-outline btn-sm">Détails</button>
            </div>
        </td>
    </tr>
    @endforeach
</x-data-table>
@endsection
