@extends('layouts.admin')

@section('page-title', 'New Article')

@section('content')

{{-- Page Header --}}
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:2rem;">
    <div>
        <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:0.3rem;">
            <a href="{{ route('dashboard') }}" style="font-family:var(--font-sans); font-size:0.72rem; color:var(--color-ink-light); text-decoration:none;"
               onmouseover="this.style.color='var(--color-azure)'" onmouseout="this.style.color='var(--color-ink-light)'">Dashboard</a>
            <span style="color:var(--color-rule); font-size:0.9rem;">›</span>
            <span style="font-family:var(--font-sans); font-size:0.72rem; color:var(--color-ink);">New Article</span>
        </div>
        <h1 class="font-display" style="font-size:1.6rem; font-weight:700; color:var(--color-ink); margin:0;">Write New Essay</h1>
    </div>
</div>

@include('admin.articles._form', [
    'action' => route('admin.articles.store'),
    'method' => null,
])

@endsection
