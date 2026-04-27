@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')

{{-- ══ STATS ROW ═══════════════════════════════════════════════ --}}
@php
    $total     = $articles->count();
    $published = $articles->where('status', 'published')->count();
    $drafts    = $articles->where('status', 'draft')->count();
@endphp

<div style="display:grid; grid-template-columns:repeat(3,1fr); gap:1.25rem; margin-bottom:2.5rem;">

    {{-- Total --}}
    <div style="background:#fff; border:1px solid var(--color-rule); border-radius:2px; padding:1.5rem; display:flex; align-items:flex-start; justify-content:space-between; box-shadow:var(--shadow-card);">
        <div>
            <p style="font-family:var(--font-sans); font-size:0.65rem; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; color:var(--color-ink-light); margin:0 0 0.5rem;">Total Articles</p>
            <p class="font-display" style="font-size:2.25rem; font-weight:700; color:var(--color-ink); margin:0; line-height:1;">{{ $total }}</p>
        </div>
        <div style="width:40px; height:40px; background:var(--color-azure-muted); border-radius:2px; display:flex; align-items:center; justify-content:center;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-azure)" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        </div>
    </div>

    {{-- Published --}}
    <div style="background:#fff; border:1px solid var(--color-rule); border-radius:2px; padding:1.5rem; display:flex; align-items:flex-start; justify-content:space-between; box-shadow:var(--shadow-card);">
        <div>
            <p style="font-family:var(--font-sans); font-size:0.65rem; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; color:var(--color-ink-light); margin:0 0 0.5rem;">Published</p>
            <p class="font-display" style="font-size:2.25rem; font-weight:700; color:var(--color-success); margin:0; line-height:1;">{{ $published }}</p>
        </div>
        <div style="width:40px; height:40px; background:var(--color-success-bg); border-radius:2px; display:flex; align-items:center; justify-content:center;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-success)" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
    </div>

    {{-- Drafts --}}
    <div style="background:#fff; border:1px solid var(--color-rule); border-radius:2px; padding:1.5rem; display:flex; align-items:flex-start; justify-content:space-between; box-shadow:var(--shadow-card);">
        <div>
            <p style="font-family:var(--font-sans); font-size:0.65rem; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; color:var(--color-ink-light); margin:0 0 0.5rem;">Drafts</p>
            <p class="font-display" style="font-size:2.25rem; font-weight:700; color:var(--color-warning); margin:0; line-height:1;">{{ $drafts }}</p>
        </div>
        <div style="width:40px; height:40px; background:var(--color-warning-bg); border-radius:2px; display:flex; align-items:center; justify-content:center;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-warning)" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
        </div>
    </div>

</div>

{{-- ══ ARTICLES TABLE ════════════════════════════════════════════ --}}
<div style="background:#fff; border:1px solid var(--color-rule); border-radius:2px; box-shadow:var(--shadow-card);">

    {{-- Table Header --}}
    <div style="padding:1.25rem 1.5rem; border-bottom:1px solid var(--color-rule); display:flex; align-items:center; justify-content:space-between;">
        <div>
            <h2 class="font-display" style="font-size:1.15rem; font-weight:700; color:var(--color-ink); margin:0 0 0.15rem;">Your Articles</h2>
            <p style="font-family:var(--font-sans); font-size:0.72rem; color:var(--color-ink-light); margin:0;">Manage your editorial content</p>
        </div>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary btn-sm">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            New Article
        </a>
    </div>

    @if($articles->count() === 0)
    {{-- Empty State --}}
    <div style="padding:4rem 2rem; text-align:center;">
        <div style="font-size:2.5rem; margin-bottom:0.75rem; opacity:0.4;">📝</div>
        <h3 class="font-display" style="font-size:1.2rem; font-weight:700; color:var(--color-ink); margin:0 0 0.5rem;">No articles yet</h3>
        <p style="font-family:var(--font-sans); font-size:0.82rem; color:var(--color-ink-light); margin:0 0 1.25rem;">Begin your scholarly journal by creating your first essay.</p>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">Write First Essay</a>
    </div>

    @else
    {{-- Table --}}
    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:var(--color-paper);">
                    <th style="padding:0.65rem 1.5rem; text-align:left; font-family:var(--font-sans); font-size:0.6rem; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; color:var(--color-ink-light); white-space:nowrap; border-bottom:1px solid var(--color-rule);">Title</th>
                    <th style="padding:0.65rem 1rem; text-align:left; font-family:var(--font-sans); font-size:0.6rem; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; color:var(--color-ink-light); white-space:nowrap; border-bottom:1px solid var(--color-rule);">Category</th>
                    <th style="padding:0.65rem 1rem; text-align:left; font-family:var(--font-sans); font-size:0.6rem; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; color:var(--color-ink-light); white-space:nowrap; border-bottom:1px solid var(--color-rule);">Status</th>
                    <th style="padding:0.65rem 1rem; text-align:left; font-family:var(--font-sans); font-size:0.6rem; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; color:var(--color-ink-light); white-space:nowrap; border-bottom:1px solid var(--color-rule);">Date</th>
                    <th style="padding:0.65rem 1rem; text-align:right; font-family:var(--font-sans); font-size:0.6rem; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; color:var(--color-ink-light); white-space:nowrap; border-bottom:1px solid var(--color-rule);">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                <tr style="border-bottom:1px solid var(--color-rule); transition:background 0.15s;"
                    onmouseover="this.style.background='var(--color-paper)'" onmouseout="this.style.background='transparent'">

                    {{-- Title --}}
                    <td style="padding:1rem 1.5rem; max-width:320px;">
                        <div class="font-display" style="font-size:0.95rem; font-weight:700; color:var(--color-ink); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            {{ $article->title }}
                        </div>
                        <div style="font-family:var(--font-sans); font-size:0.68rem; color:var(--color-ink-light); margin-top:0.2rem;">
                            {{ Str::limit($article->content, 60) }}
                        </div>
                    </td>

                    {{-- Category --}}
                    <td style="padding:1rem; white-space:nowrap;">
                        @if($article->category)
                        <span class="tag">{{ $article->category->name }}</span>
                        @else
                        <span style="font-family:var(--font-sans); font-size:0.72rem; color:var(--color-ink-light);">—</span>
                        @endif
                    </td>

                    {{-- Status --}}
                    <td style="padding:1rem; white-space:nowrap;">
                        <span class="badge {{ $article->status === 'published' ? 'badge-published' : 'badge-draft' }}">
                            <span style="width:5px; height:5px; border-radius:50%; background:currentColor; display:inline-block;"></span>
                            {{ ucfirst($article->status) }}
                        </span>
                    </td>

                    {{-- Date --}}
                    <td style="padding:1rem; white-space:nowrap;">
                        <div style="font-family:var(--font-sans); font-size:0.75rem; color:var(--color-ink-light);">
                            {{ $article->published_at ? $article->published_at->format('M j, Y') : $article->created_at->format('M j, Y') }}
                        </div>
                    </td>

                    {{-- Actions --}}
                    <td style="padding:1rem; text-align:right; white-space:nowrap;">
                        <div style="display:flex; gap:0.4rem; justify-content:flex-end; align-items:center;">
                            @if($article->status === 'published')
                            <a href="{{ route('articles.show', $article) }}" class="btn btn-ghost btn-sm" title="View Live" target="_blank">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                View
                            </a>
                            @endif
                            <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-outline btn-sm">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" style="display:inline;" onsubmit="return confirm('Delete this article permanently?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

</div>

@endsection
