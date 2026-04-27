@extends('layouts.admin')

@section('page-title', 'Edit Article')

@section('content')

{{-- Page Header --}}
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:2rem;">
    <div>
        <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:0.3rem;">
            <a href="{{ route('dashboard') }}" style="font-family:var(--font-sans); font-size:0.72rem; color:var(--color-ink-light); text-decoration:none;"
               onmouseover="this.style.color='var(--color-azure)'" onmouseout="this.style.color='var(--color-ink-light)'">Dashboard</a>
            <span style="color:var(--color-rule); font-size:0.9rem;">›</span>
            <span style="font-family:var(--font-sans); font-size:0.72rem; color:var(--color-ink);">Edit Article</span>
        </div>
        <h1 class="font-display" style="font-size:1.6rem; font-weight:700; color:var(--color-ink); margin:0 0 0.2rem;">
            Edit Essay
        </h1>
        <p style="font-family:var(--font-sans); font-size:0.78rem; color:var(--color-ink-light); margin:0;">
            {{ Str::limit($article->title, 60) }}
        </p>
    </div>

    @if($article->status === 'published')
    <a href="{{ route('articles.show', $article) }}" class="btn btn-ghost btn-sm" target="_blank">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
        View Live
    </a>
    @endif
</div>

@include('admin.articles._form', [
    'action' => route('admin.articles.update', $article),
    'method' => 'PUT',
])

@endsection
