<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Taggable;
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
        Tag::truncate();

        // generate tables
        $users = User::factory()->create([
            'name' => 'Samuel Wiese'
        ]);
        $posts = Post::factory(20)->create([
            'user_id' => $users->id
        ]);
        $tags = Tag::factory(5)->create();
        $categorys = Category::factory(4)->create();

        // generate taggable with existing tag and post ids
        foreach ($posts as $post) {
            foreach (Tag::all()->random(rand(1, 3))->pluck('id')->toArray() as $tag) {
                Taggable::factory()->create(
                    [
                        "tag_id" => $tag,
                        "taggable_id" => $post->id,
                        "taggable_type" => Post::class
                    ]
                );
            }
        }

    }
}
