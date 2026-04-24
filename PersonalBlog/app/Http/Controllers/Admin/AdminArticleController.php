<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\articles;
use App\Models\categories;

use Illuminate\Support\Facades\Auth;
class AdminArticleController extends Controller
{
    // --- CREATE ---

    /**
     * Show the form to create a new article
     */
    public function create()
    {
        // Get all categories for the select dropdown
        $categories = categories::all();
        
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Save the new article to the database
     */
    public function store(Request $request)
    {
        // 1. Validate inputs
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'content'     => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'status'      => ['required', 'in:draft,published'],
        ]);

        // 2. Add current user ID automatically
        $validated['user_id'] = Auth::id();

        // 3. Set published_at timestamp if status is 'published'
        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        } else {
            $validated['published_at'] = null;
        }

        // 4. Save to database
        articles::create($validated);

        // 5. Redirect back to dashboard with success message
        return redirect()->route('dashboard')->with('success', 'Article created successfully.');
    }

    // --- EDIT ---

    /**
     * Show the form to edit an existing article
     */
    public function edit(articles $article)
    {
        // 1. Security Check: Does this user OWN this article?
        if ($article->user_id !== Auth::id()) {
            abort(403); // Forbidden - not allowed
        }

        $categories = categories::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the article in the database
     */
    public function update(Request $request, articles $article)
    {
        // 1. Security Check: Ownership
        if ($article->user_id !== Auth::id()) {
            abort(403);
        }

        // 2. Validate inputs
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'content'     => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'status'      => ['required', 'in:draft,published'],
        ]);

        // 3. Handle timestamps
        // If changing DRAFT -> PUBLISH, set time.
        // If PUBLISH -> DRAFT, remove time.
        if ($validated['status'] === 'published' && $article->status === 'draft') {
            $validated['published_at'] = now();
        } elseif ($validated['status'] === 'draft') {
            $validated['published_at'] = null;
        }

        // 4. Update record
        $article->update($validated);

        // 5. Redirect
        return redirect()->route('dashboard')->with('success', 'Article updated.');
    }

    // --- DELETE ---

    /**
     * Delete the article from the database
     */
    public function destroy(articles $article)
    {
        // 1. Security Check: Ownership
        if ($article->user_id !== Auth::id()) {
            abort(403);
        }

        // 2. Delete
        $article->delete();

        // 3. Redirect
        return redirect()->route('dashboard')->with('success', 'Article deleted.');
    }
}

