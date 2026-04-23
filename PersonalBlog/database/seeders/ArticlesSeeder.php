<?php

namespace Database\Seeders;

use App\Models\articles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\Models\Article;
class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Article 1 - Published, Laravel category
articles::create([
    'user_id' => 1,
    'category_id' => 1,  // Laravel
    'title' => 'Getting Started with Laravel 11',
    'content' => 'Laravel 11 introduces many exciting features including improved performance...',
    'status' => 'published',
    'published_at' => now(),
]);

// Article 2 - Published, PHP category
articles::create([
    'user_id' => 1,
    'category_id' => 2,  // PHP
    'title' => 'PHP 8.3 New Features',
    'content' => 'PHP 8.3 brings performance improvements and new features...',
    'status' => 'published',
    'published_at' => now()->subDays(2),
]);

// Article 3 - Published, DevOps category
articles::create([
    'user_id' => 1,
    'category_id' => 4,  // DevOps
    'title' => 'Docker for Laravel Development',
    'content' => 'Docker makes development easier. Learn how to containerize...',
    'status' => 'published',
    'published_at' => now()->subDays(5),
]);

// Article 4 - Published, Laravel category
articles::create([
    'user_id' => 1,
    'category_id' => 1,  // Laravel
    'title' => 'Building REST APIs with Laravel',
    'content' => 'APIs are essential for modern applications. This tutorial covers...',
    'status' => 'published',
    'published_at' => now()->subDays(1),
]);
// Article 5 - Draft, JavaScript category
articles::create([
    'user_id' => 1,
    'category_id' => 3,  // JavaScript
    'title' => 'Modern JavaScript Best Practices',
    'content' => 'JavaScript has evolved significantly. In this article...',
    'status' => 'draft',
    'published_at' => null,  // NULL because draft
]);

// Article 6 - Draft, Laravel category
articles::create([
    'user_id' => 1,
    'category_id' => 1,  // Laravel
    'title' => 'Eloquent Advanced Techniques',
    'content' => 'Master advanced Eloquent ORM techniques including...',
    'status' => 'draft',
    'published_at' => null,  // NULL because draft
]);
    }
}
