@extends('layouts.dashboard')
@section('title', 'Publier une offre - Club')

@section('content')
<div style="margin-bottom:1.5rem">
    <h2 style="font-size:1.1rem;font-weight:700">Publier une nouvelle offre</h2>
    <p class="text-muted text-sm">Remplissez les informations pour publier votre offre d'emploi</p>
</div>

<div class="grid-2">
    <div>
        {{-- Main Form --}}
        <div class="card mb-2">
            <div class="card-header"><h3 class="card-title">Informations de l'offre</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Titre du poste</label>
                    <input type="text" class="form-input" placeholder="Ex: Préparateur Physique">
                </div>
                <div class="form-group">
                    <label class="form-label">Catégorie</label>
                    <select class="form-select">
                        <option value="">Sélectionner une catégorie</option>
                        @foreach($categories as $cat)
                            <option>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Description du poste</label>
                    <textarea class="form-textarea" rows="6" placeholder="Décrivez le poste, les missions principales..."></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Profil recherché</label>
                    <textarea class="form-textarea" rows="4" placeholder="Compétences requises, expérience, diplômes..."></textarea>
                </div>
            </div>
        </div>

        {{-- Requirements --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Avantages & Conditions</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Avantages proposés</label>
                    <textarea class="form-textarea" rows="3" placeholder="Ex: Mutuelle, logement, véhicule de fonction..."></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Processus de recrutement</label>
                    <textarea class="form-textarea" rows="3" placeholder="Décrivez les étapes du recrutement..."></textarea>
                </div>
            </div>
        </div>
    </div>

    <div>
        {{-- Details --}}
        <div class="card mb-2">
            <div class="card-header"><h3 class="card-title">Détails</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Type de contrat</label>
                    <select class="form-select">
                        @foreach($contract_types as $type)
                            <option>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Localisation</label>
                    <input type="text" class="form-input" value="Lyon" placeholder="Ville">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Salaire min (€)</label>
                        <input type="number" class="form-input" placeholder="30000">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Salaire max (€)</label>
                        <input type="number" class="form-input" placeholder="50000">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Date limite</label>
                    <input type="date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Expérience minimum</label>
                    <select class="form-select">
                        <option>Débutant accepté</option>
                        <option>1-3 ans</option>
                        <option>3-5 ans</option>
                        <option>5-10 ans</option>
                        <option>10+ ans</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Publish Actions --}}
        <div class="card">
            <div class="card-body">
                <button class="btn btn-primary btn-block btn-lg mb-1">Publier l'offre</button>
                <button class="btn btn-outline btn-block">Enregistrer en brouillon</button>
            </div>
        </div>
    </div>
</div>
@endsection
