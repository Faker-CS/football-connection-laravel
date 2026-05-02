@extends('layouts.app')
@section('title', 'Connexion - Football Connect')

@section('content')
<div class="login-wrapper">
    <div class="login-left">
        <div>
            <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:2.5rem">
                <div class="sidebar-logo" style="width:42px;height:42px;font-size:1rem">FC</div>
                <span style="font-weight:700;font-size:1.15rem">Football Connect</span>
            </div>
            <h1>Rejoignez la plateforme de recrutement football</h1>
            <p>Connectez les talents du football avec les meilleurs clubs professionnels.</p>
            <ul class="login-features">
                <li>
                    <div class="feat-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </div>
                    <div><strong>Trouvez les meilleures opportunités</strong><br><span style="color:rgba(255,255,255,.55);font-size:.82rem">Accédez à des centaines d'offres dans le football professionnel</span></div>
                </li>
                <li>
                    <div class="feat-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div><strong>Réseau professionnel</strong><br><span style="color:rgba(255,255,255,.55);font-size:.82rem">Connectez-vous directement avec les clubs et recruteurs</span></div>
                </li>
                <li>
                    <div class="feat-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div><strong>Profil vérifié</strong><br><span style="color:rgba(255,255,255,.55);font-size:.82rem">Système de vérification pour garantir la fiabilité</span></div>
                </li>
            </ul>
        </div>
    </div>
    <div class="login-right">
        <div class="login-form">
            <h2>Connexion</h2>
            <p class="subtitle">Entrez vos identifiants pour accéder à votre espace</p>

            <div class="login-tabs">
                <div class="login-tab active" onclick="this.parentElement.querySelectorAll('.login-tab').forEach(t=>t.classList.remove('active'));this.classList.add('active')">Talent</div>
                <div class="login-tab" onclick="this.parentElement.querySelectorAll('.login-tab').forEach(t=>t.classList.remove('active'));this.classList.add('active')">Club</div>
            </div>

            <form>
                <div class="form-group">
                    <label class="form-label">Adresse email</label>
                    <input type="email" class="form-input" placeholder="nom@exemple.com" value="marc.lefebvre@email.com">
                </div>
                <div class="form-group">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" class="form-input" placeholder="••••••••" value="password">
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
                    <label class="form-check">
                        <input type="checkbox" checked> Se souvenir de moi
                    </label>
                    <a href="#" class="link-green">Mot de passe oublié ?</a>
                </div>
                <a href="{{ route('talent.dashboard') }}" class="btn btn-primary btn-block btn-lg" style="margin-bottom:.75rem">Se connecter en tant que Talent</a>
                <a href="{{ route('club.dashboard') }}" class="btn btn-dark btn-block btn-lg" style="margin-bottom:.75rem">Se connecter en tant que Club</a>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline btn-block btn-lg">Se connecter en tant qu'Admin</a>
            </form>

            <div class="login-divider">ou continuer avec</div>

            <div class="social-btns">
                <button class="social-btn" type="button">
                    <svg width="18" height="18" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                    Google
                </button>
                <button class="social-btn" type="button">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#1877F2"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    Facebook
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
