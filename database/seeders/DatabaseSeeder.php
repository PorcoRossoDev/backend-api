<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ArticleSeeder;
use Database\Seeders\CategorySeed;
use Database\Seeders\PostSeed;
use Database\Seeders\CommentSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //$this->call(ArticleSeeder::class);
        //$this->call(CategorySeed::class);
        //$this->call(PostSeed::class);
        //$this->call(CommentSeeder::class);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
