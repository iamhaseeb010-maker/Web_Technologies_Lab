<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::table('links')->count() === 0) {
            DB::table('links')->insert([
                ['name' => 'Laravel', 'url' => 'https://laravel.com', 'path' => null, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'PHP', 'url' => 'https://www.php.net', 'path' => null, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Vite', 'url' => 'https://vitejs.dev', 'path' => null, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }
}
