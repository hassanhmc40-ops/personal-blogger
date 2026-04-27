{{--
    Shared form partial for create & edit.
    Variables: $article (optional), $categories, $action, $method
--}}

<form method="POST" action="{{ $action }}" id="article-form">
    @csrf
    @if(isset($method))
        @method($method)
    @endif

    <div style="display:grid; grid-template-columns:1fr 280px; gap:1.5rem; align-items:start;">

        {{-- ── Main Column ─────────────────────────────────────────── --}}
        <div style="display:flex; flex-direction:column; gap:1.25rem;">

            {{-- Validation Errors --}}
            @if($errors->any())
            <div style="background:var(--color-danger-bg); border:1px solid #fca5a5; border-radius:2px; padding:1rem 1.25rem; display:flex; gap:0.75rem;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-danger)" stroke-width="2" style="flex-shrink:0; margin-top:1px;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <div>
                    <p style="font-family:var(--font-sans); font-size:0.78rem; font-weight:600; color:var(--color-danger); margin:0 0 0.4rem;">Please fix the following errors:</p>
                    <ul style="font-family:var(--font-sans); font-size:0.75rem; color:var(--color-danger); margin:0; padding-left:1rem;">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            {{-- Title --}}
            <div style="background:#fff; border:1px solid var(--color-rule); border-radius:2px; padding:1.5rem; box-shadow:var(--shadow-card);">
                <label for="title" class="field-label">Article Title</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $article->title ?? '') }}"
                    class="field-input {{ $errors->has('title') ? 'error' : '' }}"
                    placeholder="e.g. The Fall of the Roman Republic: A Reassessment"
                    style="font-family:var(--font-display); font-size:1.1rem; font-weight:700;"
                    required
                >
                @error('title')
                <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Content --}}
            <div style="background:#fff; border:1px solid var(--color-rule); border-radius:2px; padding:1.5rem; box-shadow:var(--shadow-card);">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:0.5rem;">
                    <label for="content" class="field-label" style="margin:0;">Article Body</label>
                    <span style="font-family:var(--font-sans); font-size:0.65rem; color:var(--color-ink-light);">Supports paragraphs, line breaks</span>
                </div>
                <textarea
                    id="content"
                    name="content"
                    class="field-input {{ $errors->has('content') ? 'error' : '' }}"
                    style="min-height:420px; font-size:0.95rem; line-height:1.75;"
                    placeholder="Write your scholarly essay here..."
                    required
                >{{ old('content', $article->content ?? '') }}</textarea>
                @error('content')
                <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- ── Sidebar Column ──────────────────────────────────────── --}}
        <div style="display:flex; flex-direction:column; gap:1.25rem; position:sticky; top:80px;">

            {{-- Publish Panel --}}
            <div style="background:#fff; border:1px solid var(--color-rule); border-radius:2px; box-shadow:var(--shadow-card); overflow:hidden;">
                <div style="background:var(--color-paper); padding:1rem 1.25rem; border-bottom:1px solid var(--color-rule);">
                    <h3 style="font-family:var(--font-sans); font-size:0.7rem; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; color:var(--color-ink-light); margin:0;">Publishing</h3>
                </div>
                <div style="padding:1.25rem;">

                    {{-- Status --}}
                    <div style="margin-bottom:1.25rem;">
                        <label for="status" class="field-label">Status</label>
                        <select id="status" name="status" class="field-input {{ $errors->has('status') ? 'error' : '' }}" required>
                            <option value="draft"     {{ old('status', $article->status ?? 'draft') === 'draft'     ? 'selected' : '' }}>📝 Draft</option>
                            <option value="published" {{ old('status', $article->status ?? '') === 'published' ? 'selected' : '' }}>🌐 Published</option>
                        </select>
                        @error('status')
                        <p class="field-error">{{ $message }}</p>
                        @enderror
                        <p style="font-family:var(--font-sans); font-size:0.68rem; color:var(--color-ink-light); margin-top:0.4rem; line-height:1.5;">
                            Published articles are visible to all readers. Drafts are private.
                        </p>
                    </div>

                    <hr class="rule" style="margin:1rem 0;">

                    {{-- Buttons --}}
                    <button type="submit" id="submit-btn" class="btn btn-primary" style="width:100%; justify-content:center; margin-bottom:0.6rem;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        {{ isset($article) ? 'Save Changes' : 'Create Article' }}
                    </button>

                    <a href="{{ route('dashboard') }}" class="btn btn-ghost" style="width:100%; justify-content:center;">
                        Cancel
                    </a>

                    @if(isset($article))
                    <hr class="rule" style="margin:1rem 0;">
                    <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" onsubmit="return confirm('Permanently delete this article?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" style="width:100%; justify-content:center;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg>
                            Delete Article
                        </button>
                    </form>
                    @endif
                </div>
            </div>

            {{-- Category Panel --}}
            <div style="background:#fff; border:1px solid var(--color-rule); border-radius:2px; box-shadow:var(--shadow-card); overflow:hidden;">
                <div style="background:var(--color-paper); padding:1rem 1.25rem; border-bottom:1px solid var(--color-rule);">
                    <h3 style="font-family:var(--font-sans); font-size:0.7rem; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; color:var(--color-ink-light); margin:0;">Classification</h3>
                </div>
                <div style="padding:1.25rem;">
                    <label for="category_id" class="field-label">Category</label>
                    <select id="category_id" name="category_id" class="field-input {{ $errors->has('category_id') ? 'error' : '' }}" required>
                        <option value="">— Select a category —</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $article->category_id ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Preview info --}}
            @if(isset($article) && $article->status === 'published')
            <div style="background:var(--color-success-bg); border:1px solid #86efac; border-radius:2px; padding:1rem; display:flex; gap:0.6rem; align-items:flex-start;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--color-success)" stroke-width="2" style="flex-shrink:0; margin-top:1px;"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                <div>
                    <p style="font-family:var(--font-sans); font-size:0.7rem; font-weight:600; color:var(--color-success); margin:0 0 0.25rem;">Article is live</p>
                    <a href="{{ route('articles.show', $article) }}" style="font-family:var(--font-sans); font-size:0.68rem; color:var(--color-success); text-decoration:underline;" target="_blank">View on site →</a>
                </div>
            </div>
            @endif

        </div>

    </div>

</form>
