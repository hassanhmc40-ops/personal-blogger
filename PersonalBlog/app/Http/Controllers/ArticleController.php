<?php

namespace App\Http\Controllers;

use App\Models\articles;
use App\Models\categories;
use Illuminate\Http\Request;
use App\Models\Article;     
use App\Models\Category;     


class ArticleController extends Controller
{
      public function index(Request $request)
    {
        // 1. Start query: Get articles with category relationship loaded
        // 'with' prevents N+1 queries (performance optimization)
        $query = articles::with('category')->published();

        // 2. Filter by category if URL has ?category=1
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // 3. Order by publication date (newest first)
        $articles = $query->latest('published_at')->get();

        // 4. Get all categories for the filter dropdown later
        $categories = categories::all();

        // 5. Return data to the view (we haven't made views yet, but this prepares the data)
        return view('articles.index', compact('articles', 'categories'));
    }

    /**
     * Show a SINGLE article detail
     */
    public function show(articles $article)
    {
        // 1. Security Check: Is this article published?
        // If visitor tries to access /articles/5 but status='draft', block it
        if ($article->status !== 'published') {
            abort(404); // Show 404 page
        }

        // 2. Return data to the view
        return view('articles.show', compact('article'));
    }
}
