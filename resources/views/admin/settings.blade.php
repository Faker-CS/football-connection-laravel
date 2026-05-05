@extends('layouts.dashboard')
@section('title', 'Paramètres - Admin')

@section('content')
<div class="card">
    <div style="border-bottom:1px solid var(--border)">
        <div class="tabs" style="padding:0 1.5rem;border-bottom:none;margin-bottom:0">
            <div class="tab active" onclick="switchTab(this,'tab-general')">Général</div>
            <div class="tab" onclick="switchTab(this,'tab-emails')">Templates email</div>
        </div>
    </div>

    {{-- General --}}
    <div class="card-body tab-panel" id="tab-general">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem">Configuration générale</h3>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Nom du site</label>
                <input type="text" class="form-input" value="{{ $general['site_name'] }}">
            </div>
            <div class="form-group">
                <label class="form-label">Email de contact</label>
                <input type="email" class="form-input" value="{{ $general['contact_email'] }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Email de support</label>
                <input type="email" class="form-input" value="{{ $general['support_email'] }}">
            </div>
            <div class="form-group">
                <label class="form-label">Mode maintenance</label>
                <div style="margin-top:.5rem">
                    <label class="toggle">
                        <input type="checkbox" {{ $general['maintenance_mode'] ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>
        </div>
        <button class="btn btn-primary mt-1">Sauvegarder</button>
    </div>

    {{-- Email Templates --}}
    <div class="card-body tab-panel" id="tab-emails" style="display:none">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem">Templates email</h3>
        @foreach($email_templates as $tpl)
        <div style="display:flex;align-items:center;justify-content:space-between;padding:.85rem 0;border-bottom:1px solid var(--border)">
            <span style="font-size:.85rem">{{ $tpl['label'] }}</span>
            <label class="toggle">
                <input type="checkbox" {{ $tpl['enabled'] ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
            </label>
        </div>
        @endforeach
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
