<?php

namespace App\Http\Controllers;

use App\Models\articles;
use Illuminate\Http\Request;
use App\Models\Article;
class DashboardController extends Controller
{
    /**
     * Show the dashboard (Admin Home)
     */
    public function index()
    {
        // 1. IMPORTANT: Get ONLY the logged-in user's articles
        // auth()->id() gets the ID of the person currently logged in
        $articles = articles::where('user_id', auth()->id())
            ->with('category')          // Load category name
            ->latest()                  // Newest first
            ->get();

        // 2. Return view
        return view('dashboard.index', compact('articles'));
    }
}
