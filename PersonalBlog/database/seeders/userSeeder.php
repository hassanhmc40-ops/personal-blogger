<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
    'name' => 'najwa Blogger',
    'email' => 'najwa@gmail.com',
    'password' => bcrypt('password123'),  // Hashed!
]);
    }
}
