@extends('layouts.dashboard')
@section('title', 'Paramètres - Talent')

@section('content')
<div class="card">
    {{-- Tabs --}}
    <div style="border-bottom:1px solid var(--border)">
        <div class="tabs" style="padding:0 1.5rem;border-bottom:none;margin-bottom:0">
            <div class="tab active" onclick="switchTab(this, 'tab-compte')">Compte</div>
            <div class="tab" onclick="switchTab(this, 'tab-notifs')">Notifications</div>
            <div class="tab" onclick="switchTab(this, 'tab-privacy')">Confidentialité</div>
            <div class="tab" onclick="switchTab(this, 'tab-danger')">Supprimer le compte</div>
        </div>
    </div>

    {{-- Tab: Compte --}}
    <div class="card-body tab-panel" id="tab-compte">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem">Informations du compte</h3>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Adresse email</label>
                <input type="email" class="form-input" value="{{ $settings['email'] }}">
            </div>
            <div class="form-group">
                <label class="form-label">Mot de passe actuel</label>
                <input type="password" class="form-input" placeholder="••••••••">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Nouveau mot de passe</label>
                <input type="password" class="form-input" placeholder="••••••••">
            </div>
            <div class="form-group">
                <label class="form-label">Confirmer le mot de passe</label>
                <input type="password" class="form-input" placeholder="••••••••">
            </div>
        </div>
        <button class="btn btn-primary mt-1">Mettre à jour</button>
    </div>

    {{-- Tab: Notifications --}}
    <div class="card-body tab-panel" id="tab-notifs" style="display:none">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem">Préférences de notifications</h3>
        @foreach($settings['notifications'] as $notif)
        <div style="display:flex;align-items:center;justify-content:space-between;padding:.85rem 0;border-bottom:1px solid var(--border)">
            <span style="font-size:.85rem">{{ $notif['label'] }}</span>
            <label class="toggle">
                <input type="checkbox" {{ $notif['enabled'] ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
            </label>
        </div>
        @endforeach
    </div>

    {{-- Tab: Privacy --}}
    <div class="card-body tab-panel" id="tab-privacy" style="display:none">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem">Paramètres de confidentialité</h3>
        @foreach($settings['privacy'] as $priv)
        <div style="display:flex;align-items:center;justify-content:space-between;padding:.85rem 0;border-bottom:1px solid var(--border)">
            <span style="font-size:.85rem">{{ $priv['label'] }}</span>
            <label class="toggle">
                <input type="checkbox" {{ $priv['enabled'] ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
            </label>
        </div>
        @endforeach
    </div>

    {{-- Tab: Danger Zone --}}
    <div class="card-body tab-panel" id="tab-danger" style="display:none">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:.5rem;color:#dc2626">Zone dangereuse</h3>
        <p class="text-muted text-sm mb-2">Cette action est irréversible. Toutes vos données seront supprimées définitivement.</p>
        <button class="btn btn-danger">Supprimer mon compte</button>
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
