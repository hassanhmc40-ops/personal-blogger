<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description ?? 'The Scholarly Ledger — Admin Panel' }}">
    <title>{{ isset($title) ? $title.' — Admin' : 'Admin — The Scholarly Ledger' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="margin:0; background:var(--color-paper-dark); display:flex; min-height:100vh;">

{{-- ══ SIDEBAR ══════════════════════════════════════════════════ --}}
<aside class="admin-sidebar" style="position:fixed; top:0; left:0; height:100vh; overflow-y:auto; display:flex; flex-direction:column;">

    {{-- Brand --}}
    <div style="padding:1.5rem 1.2rem 1rem; border-bottom:1px solid rgba(255,255,255,0.06);">
        <a href="{{ route('home') }}" style="display:flex; align-items:center; gap:0.5rem; text-decoration:none;">
            <span style="font-size:1.25rem;">📖</span>
            <div>
                <div style="font-family:var(--font-display); font-size:0.9rem; font-weight:700; color:#e2ddd6; line-height:1.2;">The Scholarly</div>
                <div style="font-family:var(--font-display); font-size:0.9rem; font-weight:700; color:#e2ddd6;">Ledger</div>
            </div>
        </a>
    </div>

    {{-- User Info --}}
    <div style="padding:1rem 1.2rem; border-bottom:1px solid rgba(255,255,255,0.06);">
        <div style="display:flex; align-items:center; gap:0.6rem;">
            <div style="width:32px; height:32px; border-radius:50%; background:var(--color-azure); display:flex; align-items:center; justify-content:center; color:#fff; font-family:var(--font-sans); font-size:0.75rem; font-weight:600; flex-shrink:0;">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div>
                <div style="font-family:var(--font-sans); font-size:0.78rem; font-weight:600; color:#e2ddd6; line-height:1.2;">{{ auth()->user()->name ?? 'Admin' }}</div>
                <div style="font-size:0.68rem; color:#5c5750;">Editor &amp; Historian</div>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav style="padding:1rem 0.6rem; flex:1;">
        <p style="font-family:var(--font-sans); font-size:0.58rem; letter-spacing:0.12em; text-transform:uppercase; color:#5c5750; padding:0 0.6rem; margin-bottom:0.5rem;">Main</p>

        <a href="{{ route('dashboard') }}" class="admin-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
            Dashboard
        </a>
        <a href="{{ route('admin.articles.create') }}" class="admin-nav-link {{ request()->routeIs('admin.articles.create') ? 'active' : '' }}">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            New Article
        </a>
        <a href="{{ route('home') }}" class="admin-nav-link">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            View Site
        </a>
    </nav>

    {{-- Logout --}}
    <div style="padding:1rem 0.6rem; border-top:1px solid rgba(255,255,255,0.06);">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="admin-nav-link" style="width:100%; background:none; border:none; cursor:pointer; text-align:left;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Sign Out
            </button>
        </form>
    </div>

</aside>

{{-- ══ MAIN CONTENT ═════════════════════════════════════════════ --}}
<div style="margin-left:240px; flex:1; display:flex; flex-direction:column; min-height:100vh;">

    {{-- Top bar --}}
    <div style="background:#fff; border-bottom:1px solid var(--color-rule); padding:0 2rem; height:56px; display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:40;">
        <div style="font-family:var(--font-sans); font-size:0.72rem; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; color:var(--color-ink-light);">
            @yield('page-title', 'Dashboard')
        </div>
        <div style="font-family:var(--font-sans); font-size:0.75rem; color:var(--color-ink-light);">
            {{ now()->format('l, F j, Y') }}
        </div>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
    <div style="background:var(--color-success-bg); color:var(--color-success); border-bottom:1px solid #86efac; padding:0.75rem 2rem; font-family:var(--font-sans); font-size:0.82rem; display:flex; align-items:center; gap:0.5rem;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Page Content --}}
    <div style="flex:1; padding:2.5rem 2rem;">
        @yield('content')
    </div>

</div>

</body>
</html>
