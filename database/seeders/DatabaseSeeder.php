<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // drop tables
        User::truncate();
        Post::truncate();
        Category::truncate();

        // generate tables
        $users = User::factory(20)->create();
        $posts = Post::factory(20)->create();
        $categorys = Category::factory(4)->create();

    }
}
