<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">FC</div>
        <div class="sidebar-brand">Football Connect <span>Club</span></div>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu principal</div>
        <a href="{{ route('club.dashboard') }}"
            class="nav-item {{ request()->routeIs('club.dashboard') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7" />
                <rect x="14" y="3" width="7" height="7" />
                <rect x="14" y="14" width="7" height="7" />
                <rect x="3" y="14" width="7" height="7" />
            </svg>
            Tableau de bord
        </a>
        <a href="{{ route('club.profile') }}" class="nav-item {{ request()->routeIs('club.profile') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                <polyline points="9 22 9 12 15 12 15 22" />
            </svg>
            Mon Club
        </a>
        <a href="{{ route('club.news') }}" class="nav-item {{ request()->routeIs('club.news') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path
                    d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v1m2 13a2 2 0 0 1-2-2V7m2 13a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2" />
            </svg>
            Actualités & Événements
            @if (isset($nav_badges['news']) && $nav_badges['news'] > 0)
                <span class="nav-badge">{{ $nav_badges['news'] }}</span>
            @endif
        </a>
        <div class="nav-section-label">Recrutement </div>
        <a href="{{ route('club.offers.create') }}"
            class="nav-item {{ request()->routeIs('club.offers.create') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" y1="8" x2="12" y2="16" />
                <line x1="8" y1="12" x2="16" y2="12" />
            </svg>
            Publier une offre
        </a>
        <a href="{{ route('club.offers') }}" class="nav-item {{ request()->routeIs('club.offers') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
            </svg>
            Mes Offres
            @if (isset($nav_badges['offers']) && $nav_badges['offers'] > 0)
                <span class="nav-badge">{{ $nav_badges['offers'] }}</span>
            @endif
        </a>
        <a href="{{ route('club.applications') }}"
            class="nav-item {{ request()->routeIs('club.applications') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
            Candidatures reçues
            @if (isset($nav_badges['applications']) && $nav_badges['applications'] > 0)
                <span class="nav-badge red">{{ $nav_badges['applications'] }}</span>
            @endif
        </a>
        <div class="nav-section-label" style="margin-top:1rem">Paramètres</div>
        <a href="{{ route('club.settings') }}"
            class="nav-item {{ request()->routeIs('club.settings') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="3" />
                <path
                    d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z" />
            </svg>
            Paramètres
        </a>
    </nav>
    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-avatar">OL</div>
            <div class="sidebar-user-info">
                <div class="sidebar-user-name">Olympique Lyonnais</div>
                <div class="sidebar-user-role">Ligue 1</div>
            </div>
        </div>
    </div>
</aside>
