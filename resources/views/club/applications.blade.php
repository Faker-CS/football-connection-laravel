@extends('layouts.dashboard')
@section('title', 'Candidatures reçues - Club')

@section('content')
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
        <div>
            <h2 style="font-size:1.1rem;font-weight:700">Candidatures reçues</h2>
            <p class="text-muted text-sm">{{ count($applications) }} candidatures au total</p>
        </div>
        <div class="search-input" style="max-width:280px">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
            <input type="text" placeholder="Rechercher un candidatures...">
        </div>
    </div>

    <x-data-table :headers="['Candidat', 'Poste', 'Offre', 'Expérience', 'Date', 'Statut', 'Actions']">
        @foreach ($applications as $app)
            <tr>
                <td>
                    <div class="table-user">
                        <div class="table-avatar" style="background:linear-gradient(135deg,var(--green-dark),#4ade80)">
                            {{ $app['initials'] }}</div>
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
                        <button class="btn btn-primary btn-sm"
                            onclick="openApplicationView('{{ $app['name'] }}', '{{ $app['role'] }}', '{{ $app['offer'] }}', ['Analyse vidéo', 'Tactique', 'Formation jeunes', 'UEFA B'], 'Passionné par le football depuis 15 ans, je souhaite mettre mon expertise au service de votre club.', '{{ $app['initials'] }}')">
                            Voir
                        </button>
                        @if ($app['status'] === 'Nouveau' || $app['status'] === 'En cours')
                            <button class="btn btn-success btn-sm" onclick="openApplicationInvite('{{ $app['name'] }}')">
                                Inviter
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="openApplicationRefuse('{{ $app['name'] }}')">
                                Refuser
                            </button>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </x-data-table>
    <x-pagination :total="50" :per-page="10" :current-page="1" />

    {{-- Include Application Modals --}}
    @include('components.modals.applications-view')
    @include('components.modals.applications-invite')
    @include('components.modals.applications-refuse')
@endsection
