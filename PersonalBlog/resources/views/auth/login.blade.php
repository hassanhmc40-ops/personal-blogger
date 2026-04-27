@extends('layouts.app')

@section('content')
<div style="min-height:100vh; background:var(--color-paper-dark); display:flex; align-items:center; justify-content:center; padding:3rem 1rem;">

    <div style="width:100%; max-width:420px;">

        {{-- Logo / Brand --}}
        <div style="text-align:center; margin-bottom:2.5rem;">
            <a href="{{ route('home') }}" style="text-decoration:none; display:inline-flex; flex-direction:column; align-items:center; gap:0.5rem;">
                <span style="font-size:2rem;">📖</span>
                <span class="font-display" style="font-size:1.4rem; font-weight:700; color:var(--color-ink);">The Scholarly Ledger</span>
                <span style="font-family:var(--font-sans); font-size:0.65rem; letter-spacing:0.12em; text-transform:uppercase; color:var(--color-ink-light);">Editor Portal</span>
            </a>
        </div>

        {{-- Card --}}
        <div style="background:#fff; border:1px solid var(--color-rule); border-radius:3px; box-shadow:var(--shadow-floating); overflow:hidden;">

            {{-- Card Header --}}
            <div style="background:var(--color-ink); padding:1.5rem 2rem;">
                <h1 class="font-display" style="font-size:1.4rem; font-weight:700; color:#fff; margin:0 0 0.25rem;">Welcome Back</h1>
                <p style="font-family:var(--font-sans); font-size:0.78rem; color:rgba(255,255,255,0.5); margin:0;">Sign in to manage your editorial content</p>
            </div>
            <div style="height:3px; background:linear-gradient(90deg, var(--color-gold), transparent);"></div>

            {{-- Form --}}
            <form method="POST" action="{{ route('login') }}" style="padding:2rem;">
                @csrf

                {{-- Error Alert --}}
                @if($errors->any())
                <div style="background:var(--color-danger-bg); border:1px solid #fca5a5; border-radius:2px; padding:0.75rem 1rem; margin-bottom:1.5rem; font-family:var(--font-sans); font-size:0.8rem; color:var(--color-danger); display:flex; align-items:flex-start; gap:0.5rem;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0; margin-top:1px;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <div>{{ $errors->first() }}</div>
                </div>
                @endif

                {{-- Email --}}
                <div style="margin-bottom:1.25rem;">
                    <label for="email" class="field-label">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="field-input {{ $errors->has('email') ? 'error' : '' }}"
                        placeholder="editor@thescholarlyledger.com"
                        autocomplete="email"
                        required
                    >
                </div>

                {{-- Password --}}
                <div style="margin-bottom:1.75rem;">
                    <label for="password" class="field-label">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="field-input {{ $errors->has('password') ? 'error' : '' }}"
                        placeholder="••••••••"
                        autocomplete="current-password"
                        required
                    >
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding:0.75rem;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                    Sign in to the Ledger
                </button>

            </form>
        </div>

        {{-- Back link --}}
        <div style="text-align:center; margin-top:1.5rem;">
            <a href="{{ route('home') }}" style="font-family:var(--font-sans); font-size:0.78rem; color:var(--color-ink-light); text-decoration:none;"
               onmouseover="this.style.color='var(--color-azure)'" onmouseout="this.style.color='var(--color-ink-light)'">
                ← Return to The Scholarly Ledger
            </a>
        </div>

    </div>
</div>
@endsection
