<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Javier ',
            'email' => 'javimal26@hotmail.com',
            'password' => bcrypt('12345678'),
        ]);

        Category::factory(10)->create();

        Post::factory(100)->create();
    }
}
