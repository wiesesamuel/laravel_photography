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
        User::truncate();
        Post::truncate();
        Category::truncate();

        $user = User::factory()->create();

        $private = Category::create([
            'name' => 'Persönlich',
            'slug' => 'private',
            'description' => 'Persönliches'
        ]);

        $family = Category::create([
            'name' => 'Familie',
            'slug' => 'family',
            'description' => 'Klein und Groß'
        ]);

        $art = Category::create([
            'name' => 'Kunst',
            'slug' => 'art',
            'description' => 'Natur und Kunst'
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $family->id,
            'title' => 'My family post',
            'slug' => 'famaily-post-u-should-see',
            'excerpt' => 'Familie ist alles',
            'body' => 'oiqretjoiqwnuecfoiweqhnfckjqshndfjaugs',
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $art->id,
            'title' => 'My art post',
            'slug' => 'art-post',
            'excerpt' => 'Kunstvorschau',
            'body' => 'asdfasdfasdfasdfasdfasdfasdf',
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $art->id,
            'title' => 'My second art post',
            'slug' => 'art-post-nr2',
            'excerpt' => 'Kunstvorschau 2',
            'body' => 'akisdhgoiabsdgkjabskdjfbgaisouhfdiouawbeikurbfksajdfb',
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $private->id,
            'title' => 'My private post',
            'slug' => 'dont-watch-me',
            'excerpt' => 'vorschau zum abschauen',
            'body' => 'oijaujg098q43t9ohis',
        ]);
    }
}
