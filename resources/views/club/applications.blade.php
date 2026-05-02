@extends('layouts.dashboard')
@section('title', 'Candidatures reçues - Club')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
    <div>
        <h2 style="font-size:1.1rem;font-weight:700">Candidatures reçues</h2>
        <p class="text-muted text-sm">{{ count($applications) }} candidatures au total</p>
    </div>
    <div class="filter-bar" style="margin-bottom:0">
        <select class="form-select" style="width:auto;min-width:140px;padding:.45rem .75rem;font-size:.8rem">
            <option>Tous les statuts</option>
            <option>Nouveau</option>
            <option>En cours</option>
            <option>Entretien</option>
            <option>Accepté</option>
            <option>Refusé</option>
        </select>
    </div>
</div>

<x-data-table :headers="['Candidat', 'Poste', 'Offre', 'Expérience', 'Date', 'Statut', 'Actions']">
    @foreach($applications as $app)
    <tr>
        <td>
            <div class="table-user">
                <div class="table-avatar" style="background:linear-gradient(135deg,var(--green-dark),#4ade80)">{{ $app['initials'] }}</div>
                <div class="table-user-info">
                    <div class="name">{{ $app['name'] }}</div>
                    <div class="sub">{{ $app['city'] }}</div>
                </div>
            </div>
        </td>
        <td class="text-sm">{{ $app['role'] }}</td>
        <td class="text-sm fw-600">{{ $app['offer'] }}</td>
        <td class="text-sm text-muted">{{ $app['experience'] }}</td>
        <td class="text-muted text-sm">{{ $app['date'] }}</td>
        <td><x-badge :color="$app['status_color']">{{ $app['status'] }}</x-badge></td>
        <td>
            <div class="table-actions">
                <button class="btn btn-outline btn-sm">Voir</button>
                @if($app['status'] === 'Nouveau' || $app['status'] === 'En cours')
                    <button class="btn btn-success btn-sm">Accepter</button>
                    <button class="btn btn-warning btn-sm">Entretien</button>
                    <button class="btn btn-danger btn-sm">Refuser</button>
                @endif
            </div>
        </td>
    </tr>
    @endforeach
</x-data-table>
@endsection
