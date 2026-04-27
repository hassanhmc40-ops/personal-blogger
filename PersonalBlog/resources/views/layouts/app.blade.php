<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description ?? 'The Scholarly Ledger — A curated journal of history, ideas, and culture by Julian Thorne.' }}">
    <title>{{ isset($title) ? $title.' — The Scholarly Ledger' : 'The Scholarly Ledger' }}</title>

    <!-- Preconnect Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

{{-- ══ NAVIGATION ══════════════════════════════════════════════ --}}
<header class="site-nav">
    <div class="container-editorial">
        <div style="display:flex; align-items:center; justify-content:space-between; height:64px; gap:1rem;">

            {{-- Logo --}}
            <a href="{{ route('home') }}" style="display:flex; align-items:center; gap:0.55rem; text-decoration:none; flex-shrink:0;">
                <span style="font-size:1.4rem;">📖</span>
                <span style="font-family:var(--font-display); font-size:1.15rem; font-weight:700; color:var(--color-ink); letter-spacing:-0.01em;">The Scholarly Ledger</span>
            </a>

            {{-- Nav Links --}}
            <nav style="display:flex; align-items:center; gap:0.25rem;">
                <a href="{{ route('home') }}"
                   style="font-family:var(--font-sans); font-size:0.78rem; font-weight:500; letter-spacing:0.06em; text-transform:uppercase; color:var(--color-ink-light); padding:0.4rem 0.75rem; text-decoration:none; transition:color 0.15s; border-radius:2px;"
                   onmouseover="this.style.color='var(--color-azure)'" onmouseout="this.style.color='var(--color-ink-light)'">
                    Home
                </a>

                @auth
                <a href="{{ route('dashboard') }}"
                   style="font-family:var(--font-sans); font-size:0.78rem; font-weight:500; letter-spacing:0.06em; text-transform:uppercase; color:var(--color-ink-light); padding:0.4rem 0.75rem; text-decoration:none; transition:color 0.15s;"
                   onmouseover="this.style.color='var(--color-azure)'" onmouseout="this.style.color='var(--color-ink-light)'">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-ghost btn-sm">Sign Out</button>
                </form>
                @else
                <a href="{{ route('login') }}" class="btn btn-outline btn-sm" style="margin-left:0.5rem;">Editor Login</a>
                @endauth
            </nav>

        </div>
    </div>
</header>

{{-- ══ PAGE CONTENT ════════════════════════════════════════════ --}}
<main>
    @yield('content')
</main>

{{-- ══ FOOTER ══════════════════════════════════════════════════ --}}
<footer style="background:var(--color-ink); color:#a09890; padding:3rem 0 2rem;">
    <div class="container-editorial">
        <div style="display:flex; flex-wrap:wrap; justify-content:space-between; align-items:flex-start; gap:2rem; padding-bottom:2rem; border-bottom:1px solid rgba(255,255,255,0.08);">
            <div>
                <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:0.5rem;">
                    <span style="font-size:1.2rem;">📖</span>
                    <span style="font-family:var(--font-display); font-size:1rem; font-weight:700; color:#e2ddd6;">The Scholarly Ledger</span>
                </div>
                <p style="font-size:0.85rem; max-width:28ch; line-height:1.6;">
                    A curated journal of history, culture, and ideas.
                </p>
            </div>
            <div>
                <p style="font-family:var(--font-sans); font-size:0.65rem; letter-spacing:0.1em; text-transform:uppercase; color:#5c5750; margin-bottom:0.75rem;">Navigate</p>
                <div style="display:flex; flex-direction:column; gap:0.3rem;">
                    <a href="{{ route('home') }}" style="font-size:0.85rem; color:#a09890; text-decoration:none;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#a09890'">Home</a>
                    @auth
                    <a href="{{ route('dashboard') }}" style="font-size:0.85rem; color:#a09890; text-decoration:none;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#a09890'">Dashboard</a>
                    @endauth
                </div>
            </div>
        </div>
        <div style="padding-top:1.5rem; display:flex; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
            <p style="font-size:0.78rem;">© {{ date('Y') }} Julian Thorne — Editor &amp; Historian</p>
            <p style="font-family:var(--font-sans); font-size:0.65rem; letter-spacing:0.08em; text-transform:uppercase; color:#5c5750;">The Scholarly Ledger</p>
        </div>
    </div>
</footer>

</body>
</html>
