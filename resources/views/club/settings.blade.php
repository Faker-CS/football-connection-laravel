@extends('layouts.dashboard')
@section('title', 'Paramètres - Club')

@section('content')
<div class="card">
    <div style="border-bottom:1px solid var(--border)">
        <div class="tabs" style="padding:0 1.5rem;border-bottom:none;margin-bottom:0">
            <div class="tab active" onclick="switchTab(this,'tab-info')">Informations club</div>
            <div class="tab" onclick="switchTab(this,'tab-notif')">Notifications</div>
            <div class="tab" onclick="switchTab(this,'tab-sec')">Sécurité</div>
        </div>
    </div>

    {{-- Info --}}
    <div class="card-body tab-panel" id="tab-info">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem">Informations générales</h3>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Nom du club</label>
                <input type="text" class="form-input" value="{{ $club['name'] }}">
            </div>
            <div class="form-group">
                <label class="form-label">Email de contact</label>
                <input type="email" class="form-input" value="{{ $club['email'] }}">
            </div>
        </div>
        <button class="btn btn-primary mt-1">Sauvegarder</button>
    </div>

    {{-- Notifications --}}
    <div class="card-body tab-panel" id="tab-notif" style="display:none">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem">Préférences de notifications</h3>
        @foreach($notifications as $notif)
        <div style="display:flex;align-items:center;justify-content:space-between;padding:.85rem 0;border-bottom:1px solid var(--border)">
            <span style="font-size:.85rem">{{ $notif['label'] }}</span>
            <label class="toggle">
                <input type="checkbox" {{ $notif['enabled'] ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
            </label>
        </div>
        @endforeach
    </div>

    {{-- Security --}}
    <div class="card-body tab-panel" id="tab-sec" style="display:none">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem">Sécurité du compte</h3>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Mot de passe actuel</label>
                <input type="password" class="form-input" placeholder="••••••••">
            </div>
            <div class="form-group">
                <label class="form-label">Nouveau mot de passe</label>
                <input type="password" class="form-input" placeholder="••••••••">
            </div>
        </div>
        <button class="btn btn-primary mt-1">Mettre à jour</button>
        <hr style="border-top:1px solid var(--border);margin:1.5rem 0">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:.5rem;color:#dc2626">Zone dangereuse</h3>
        <p class="text-muted text-sm mb-2">Supprimer définitivement le compte du club et toutes les données associées.</p>
        <button class="btn btn-danger">Supprimer le compte</button>
    </div>
</div>

@push('scripts')
<script>
function switchTab(el, tabId) {
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-panel').forEach(p => p.style.display = 'none');
    el.classList.add('active');
    document.getElementById(tabId).style.display = 'block';
}
</script>
@endpush
@endsection
