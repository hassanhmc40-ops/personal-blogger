<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminArticleController;

// 1. Public Routes (Guests can visit)
Route::get('/', [ArticleController::class, 'index'])->name('home');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// 2. Auth Routes (Only for guests)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// 3. Authenticated Routes (Only for logged-in users)
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Article CRUD (Prefix: /admin/articles)
    Route::prefix('admin/articles')->name('admin.articles.')->group(function () {
        Route::get('/create', [AdminArticleController::class, 'create'])->name('create');
        Route::post('/', [AdminArticleController::class, 'store'])->name('store');
        Route::get('/{article}/edit', [AdminArticleController::class, 'edit'])->name('edit');
        Route::put('/{article}', [AdminArticleController::class, 'update'])->name('update');
        Route::delete('/{article}', [AdminArticleController::class, 'destroy'])->name('destroy');
    });

    // Logout (POST only for security)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});