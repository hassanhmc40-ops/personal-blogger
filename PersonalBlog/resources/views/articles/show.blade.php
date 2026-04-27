@extends('layouts.app')

@section('content')

{{-- ══ ARTICLE HEADER ══════════════════════════════════════════ --}}
<header style="background:var(--color-ink); color:#fff; padding:4rem 0 3.5rem; position:relative; overflow:hidden;">

    {{-- Decorative circles --}}
    <div style="position:absolute; top:-60px; right:-60px; width:300px; height:300px; background:rgba(255,255,255,0.02); border-radius:50%; pointer-events:none;"></div>
    <div style="position:absolute; bottom:-80px; left:10%; width:200px; height:200px; background:rgba(26,79,163,0.12); border-radius:50%; pointer-events:none;"></div>

    <div class="container-narrow" style="position:relative;">
        {{-- Breadcrumb --}}
        <nav style="margin-bottom:1.5rem; display:flex; align-items:center; gap:0.5rem;">
            <a href="{{ route('home') }}" style="font-family:var(--font-sans); font-size:0.72rem; color:rgba(255,255,255,0.5); text-decoration:none; letter-spacing:0.06em; text-transform:uppercase;"
               onmouseover="this.style.color='rgba(255,255,255,0.85)'" onmouseout="this.style.color='rgba(255,255,255,0.5)'">
                The Scholarly Ledger
            </a>
            <span style="color:rgba(255,255,255,0.3); font-size:0.8rem;">›</span>
            @if($article->category)
            <span style="font-family:var(--font-sans); font-size:0.72rem; color:rgba(255,255,255,0.5); letter-spacing:0.06em; text-transform:uppercase;">
                {{ $article->category->name }}
            </span>
            @endif
        </nav>

        {{-- Category tag --}}
        @if($article->category)
        <div style="margin-bottom:1rem;">
            <span class="tag" style="background:rgba(255,255,255,0.12); color:#f5e9c4; border:1px solid rgba(255,255,255,0.15);">
                {{ $article->category->name }}
            </span>
        </div>
        @endif

        {{-- Title --}}
        <h1 class="font-display"
            style="font-size:clamp(2rem,5vw,3rem); font-weight:900; line-height:1.1; letter-spacing:-0.02em; color:#fff; margin:0 0 1.25rem; max-width:24ch;">
            {{ $article->title }}
        </h1>

        {{-- Meta row --}}
        <div style="display:flex; align-items:center; gap:1.5rem; flex-wrap:wrap;">
            <div style="display:flex; align-items:center; gap:0.6rem;">
                <div style="width:32px; height:32px; border-radius:50%; background:var(--color-azure); display:flex; align-items:center; justify-content:center; color:#fff; font-family:var(--font-sans); font-size:0.75rem; font-weight:700;">J</div>
                <div>
                    <div style="font-family:var(--font-sans); font-size:0.8rem; font-weight:600; color:#e2ddd6;">Julian Thorne</div>
                    <div style="font-family:var(--font-sans); font-size:0.68rem; color:rgba(255,255,255,0.45);">Editor &amp; Historian</div>
                </div>
            </div>
            @if($article->published_at)
            <div style="font-family:var(--font-sans); font-size:0.75rem; color:rgba(255,255,255,0.5); display:flex; align-items:center; gap:0.35rem;">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                {{ $article->published_at->format('F j, Y') }}
            </div>
            @endif
        </div>

    </div>
</header>

{{-- ══ GOLD RULE TRANSITION ════════════════════════════════════ --}}
<div style="height:4px; background:linear-gradient(90deg, var(--color-gold), transparent);"></div>

{{-- ══ ARTICLE BODY ════════════════════════════════════════════ --}}
<section style="padding:4rem 0 6rem;">
    <div class="container-narrow">
        <div style="display:grid; grid-template-columns:1fr 200px; gap:4rem; align-items:start;">

            {{-- Article content --}}
            <article class="prose-scholarly">
                {!! nl2br(e($article->content)) !!}
            </article>

            {{-- Sidebar --}}
            <aside style="position:sticky; top:80px;">
                <div style="background:#fff; border:1px solid var(--color-rule); border-radius:2px; padding:1.25rem;">
                    <p style="font-family:var(--font-sans); font-size:0.6rem; font-weight:600; letter-spacing:0.12em; text-transform:uppercase; color:var(--color-ink-light); margin:0 0 0.75rem;">About</p>
                    <div class="rule-gold" style="margin-bottom:1rem;"></div>

                    @if($article->category)
                    <div style="margin-bottom:1rem;">
                        <div style="font-family:var(--font-sans); font-size:0.65rem; color:var(--color-ink-light); letter-spacing:0.06em; text-transform:uppercase; margin-bottom:0.3rem;">Category</div>
                        <span class="tag">{{ $article->category->name }}</span>
                    </div>
                    @endif

                    @if($article->published_at)
                    <div style="margin-bottom:1rem;">
                        <div style="font-family:var(--font-sans); font-size:0.65rem; color:var(--color-ink-light); letter-spacing:0.06em; text-transform:uppercase; margin-bottom:0.3rem;">Published</div>
                        <div style="font-size:0.82rem; color:var(--color-ink);">{{ $article->published_at->format('M j, Y') }}</div>
                    </div>
                    @endif

                    <div style="margin-bottom:0;">
                        <div style="font-family:var(--font-sans); font-size:0.65rem; color:var(--color-ink-light); letter-spacing:0.06em; text-transform:uppercase; margin-bottom:0.3rem;">Author</div>
                        <div style="font-size:0.82rem; color:var(--color-ink); font-weight:600;">Julian Thorne</div>
                        <div style="font-size:0.75rem; color:var(--color-ink-light);">Editor &amp; Historian</div>
                    </div>
                </div>

                {{-- Back link --}}
                <div style="margin-top:1rem;">
                    <a href="{{ route('home') }}" class="btn btn-ghost" style="width:100%; justify-content:center; font-size:0.72rem;">
                        ← Back to Ledger
                    </a>
                </div>
            </aside>

        </div>
    </div>
</section>

{{-- ══ FOOTER RULE ══════════════════════════════════════════════ --}}
<div style="background:var(--color-paper-dark); border-top:1px solid var(--color-rule); padding:2rem 0;">
    <div class="container-narrow" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem;">
        <a href="{{ route('home') }}" style="font-family:var(--font-sans); font-size:0.8rem; color:var(--color-azure); text-decoration:none; font-weight:600;">
            ← More Essays
        </a>
        @auth
        <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-outline btn-sm">
            Edit Article
        </a>
        @endauth
    </div>
</div>

@endsection
