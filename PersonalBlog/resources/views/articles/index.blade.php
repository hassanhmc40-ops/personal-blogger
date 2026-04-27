@extends('layouts.app')

@section('content')

{{-- ══ HERO BANNER ═════════════════════════════════════════════ --}}
<section class="hero-gradient" style="padding:5rem 0 4rem;">
    <div class="container-editorial" style="display:flex; flex-direction:column; align-items:center; text-align:center;">
        <span class="kicker animate-fade-up" style="color:#f5e9c4; margin-bottom:1rem;">Est. 2024 · The Scholarly Ledger</span>
        <h1 class="font-display animate-fade-up delay-100"
            style="font-size:clamp(2.25rem,5vw,3.75rem); font-weight:900; color:#fff; line-height:1.1; letter-spacing:-0.02em; margin:0 0 1.25rem; max-width:20ch;">
            History, Ideas &amp;<br>Curated Scholarship
        </h1>
        <p class="animate-fade-up delay-200"
           style="font-size:1.05rem; color:rgba(255,255,255,0.72); max-width:52ch; margin:0 0 2rem; line-height:1.7;">
            A journal for the intellectually curious — exploring the long arc of history, philosophy, and human culture.
        </p>
        {{-- Category Filter Chips --}}
        @if($categories->count())
        <div class="animate-fade-up delay-300" style="display:flex; flex-wrap:wrap; gap:0.5rem; justify-content:center;">
            <a href="{{ route('home') }}"
               class="btn btn-sm"
               style="background:rgba(255,255,255,0.18); color:#fff; border:1px solid rgba(255,255,255,0.3); backdrop-filter:blur(4px);">
                All Topics
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('home', ['category' => $cat->id]) }}"
               class="btn btn-sm"
               style="background:{{ request('category') == $cat->id ? '#fff' : 'rgba(255,255,255,0.1)' }};
                      color:{{ request('category') == $cat->id ? 'var(--color-azure)' : '#fff' }};
                      border:1px solid rgba(255,255,255,0.25);">
                {{ $cat->name }}
            </a>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- ══ ARTICLE GRID ═════════════════════════════════════════════ --}}
<section style="padding:4rem 0 6rem;">
    <div class="container-editorial">

        @if($articles->count() === 0)
        {{-- Empty State --}}
        <div style="text-align:center; padding:5rem 0;">
            <div style="font-size:3rem; margin-bottom:1rem;">📜</div>
            <h2 class="font-display" style="font-size:1.75rem; font-weight:700; color:var(--color-ink); margin-bottom:0.5rem;">No articles yet</h2>
            <p style="color:var(--color-ink-light);">Check back soon — the ledger is being filled.</p>
        </div>

        @else

        {{-- Featured Article (first one) --}}
        @php $featured = $articles->first(); $rest = $articles->skip(1); @endphp

        <div style="margin-bottom:3rem;">
            <div style="display:flex; align-items:center; gap:1rem; margin-bottom:1.5rem;">
                <span class="kicker">Featured</span>
                <div class="rule" style="flex:1;"></div>
            </div>

            <a href="{{ route('articles.show', $featured) }}" style="text-decoration:none; display:block;">
                <div class="card" style="display:grid; grid-template-columns:1fr 1fr; min-height:300px; overflow:hidden; border-radius:3px;">
                    {{-- Left: Content --}}
                    <div style="padding:2.5rem 2.5rem 2rem; display:flex; flex-direction:column; justify-content:space-between;">
                        <div>
                            @if($featured->category)
                            <span class="tag" style="margin-bottom:1rem; display:inline-block;">{{ $featured->category->name }}</span>
                            @endif
                            <h2 class="font-display" style="font-size:1.9rem; font-weight:700; line-height:1.2; color:var(--color-ink); margin:0.5rem 0 1rem; letter-spacing:-0.01em;">
                                {{ $featured->title }}
                            </h2>
                            <p style="font-size:0.95rem; color:var(--color-ink-light); line-height:1.7;">
                                {{ Str::limit($featured->content, 200) }}
                            </p>
                        </div>
                        <div style="display:flex; align-items:center; gap:1.25rem; margin-top:1.5rem; padding-top:1.25rem; border-top:1px solid var(--color-rule);">
                            <div>
                                <div style="font-family:var(--font-sans); font-size:0.75rem; font-weight:600; color:var(--color-ink);">Julian Thorne</div>
                                <div style="font-family:var(--font-sans); font-size:0.68rem; color:var(--color-ink-light);">
                                    {{ $featured->published_at ? $featured->published_at->format('M j, Y') : 'Recently published' }}
                                </div>
                            </div>
                            <span style="font-family:var(--font-sans); font-size:0.72rem; color:var(--color-azure); font-weight:600; margin-left:auto;">
                                Read Essay →
                            </span>
                        </div>
                    </div>
                    {{-- Right: Decorative Panel --}}
                    <div class="hero-gradient" style="display:flex; align-items:center; justify-content:center; min-height:280px; position:relative; overflow:hidden;">
                        <div style="text-align:center; color:rgba(255,255,255,0.9); padding:2rem;">
                            <div style="font-size:3.5rem; margin-bottom:0.5rem; opacity:0.7;">📚</div>
                            <div style="font-family:var(--font-display); font-size:1.1rem; font-style:italic; opacity:0.8;">Featured Essay</div>
                        </div>
                        <div style="position:absolute; top:-20px; right:-20px; width:120px; height:120px; background:rgba(255,255,255,0.04); border-radius:50%;"></div>
                        <div style="position:absolute; bottom:-40px; left:-30px; width:180px; height:180px; background:rgba(255,255,255,0.03); border-radius:50%;"></div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Rest of Articles Grid --}}
        @if($rest->count())
        <div style="display:flex; align-items:center; gap:1rem; margin-bottom:1.5rem;">
            <span class="kicker">All Articles</span>
            <div class="rule" style="flex:1;"></div>
            <span style="font-family:var(--font-sans); font-size:0.72rem; color:var(--color-ink-light);">{{ $articles->count() }} {{ Str::plural('essay', $articles->count()) }}</span>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(320px, 1fr)); gap:1.5rem;">
            @foreach($rest as $article)
            <a href="{{ route('articles.show', $article) }}" style="text-decoration:none; display:block;">
                <article class="card" style="height:100%; display:flex; flex-direction:column;">
                    {{-- Card Accent Bar --}}
                    <div style="height:3px; background:linear-gradient(90deg, var(--color-azure), var(--color-azure-muted));"></div>

                    <div style="padding:1.5rem; flex:1; display:flex; flex-direction:column;">
                        @if($article->category)
                        <span class="tag" style="margin-bottom:0.75rem; align-self:flex-start;">{{ $article->category->name }}</span>
                        @endif

                        <h2 class="font-display" style="font-size:1.2rem; font-weight:700; line-height:1.3; color:var(--color-ink); margin:0 0 0.75rem;">
                            {{ $article->title }}
                        </h2>

                        <p style="font-size:0.875rem; color:var(--color-ink-light); line-height:1.65; flex:1; margin:0 0 1.25rem;">
                            {{ Str::limit($article->content, 130) }}
                        </p>

                        <div style="display:flex; align-items:center; justify-content:space-between; padding-top:1rem; border-top:1px solid var(--color-rule);">
                            <div style="font-family:var(--font-sans); font-size:0.68rem; color:var(--color-ink-light);">
                                {{ $article->published_at ? $article->published_at->format('M j, Y') : '—' }}
                            </div>
                            <span style="font-family:var(--font-sans); font-size:0.68rem; font-weight:600; color:var(--color-azure);">Read →</span>
                        </div>
                    </div>
                </article>
            </a>
            @endforeach
        </div>
        @endif

        @endif {{-- end articles.count check --}}

    </div>
</section>

@endsection
