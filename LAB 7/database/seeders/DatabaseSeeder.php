<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        if (Article::count() === 0) {
            Article::insert([
                ['title' => 'Welcome to Lab6', 'body' => 'This is the first sample article.', 'created_at' => now(), 'updated_at' => now()],
                ['title' => 'Using the Articles CRUD', 'body' => 'You can create, edit, view and delete articles through the UI.', 'created_at' => now(), 'updated_at' => now()],
                ['title' => 'Laravel + Vite', 'body' => 'This project uses Laravel for backend and Vite for frontend assets.', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }
}
