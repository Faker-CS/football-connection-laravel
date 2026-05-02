<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Football Connect')</title>
    <meta name="description" content="@yield('description', 'Football Connect - Plateforme de recrutement football')">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @stack('styles')
</head>
<body>
<div class="app-layout">
    @include('components.sidebar.' . $sidebarType)
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <div class="main-area">
        @include('components.topbar', ['title' => $pageTitle ?? ''])
        <div class="content">
            @yield('content')
        </div>
    </div>
</div>
@stack('scripts')
<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const hamburger = document.getElementById('hamburgerDash');
    if (hamburger) {
        hamburger.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        });
    }
    if (overlay) {
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
        });
    }
</script>
</body>
</html>
