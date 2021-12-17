<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Taggable;
use App\Models\Task;
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
        Taggable::truncate();
        Task::truncate();

        // generate tables
        $users = User::factory()->create([
            'name' => 'Samuel Wiese'
        ]);

        Category::factory(3)->create();

        for ($i = 1; $i <= 10; $i++) {
            $category_id = rand(1, 3);
            Post::factory()->create([
                'category_id' => $category_id,
                'user_id' => $users->id
            ]);
        }

        Tag::factory(5)->create();

        // generate taggable with existing tag and post ids
        foreach (Post::all() as $post) {
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

        // specific post with only one tag
        $tag = Tag::factory()->create();
        $post = Post::factory()->create();
        Taggable::factory()->create(
            [
                "tag_id" => $tag->id,
                "taggable_id" => $post->id,
                "taggable_type" => Post::class
            ]
        );

        Task::factory(3)->create();
    }
}
