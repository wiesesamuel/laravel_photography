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
        $users = User::factory()->create([
            'name' => 'Samuel Wiese'
        ]);
        $posts = Post::factory(20)->create([
            'user_id' => $users->id
        ]);
        $categorys = Category::factory(4)->create();

    }
}
