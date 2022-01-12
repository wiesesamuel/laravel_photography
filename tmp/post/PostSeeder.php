
    private function seed_posts()
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
            'name' => 'SamuelWiese'
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
                        'tag_id' => $tag,
                        'taggable_id' => $post->id,
                        'taggable_type' => Post::class
                    ]
                );
            }
        }

        // specific post with only one tag
        $tag = Tag::factory()->create();
        $post = Post::factory()->create();
        Taggable::factory()->create(
            [
                'tag_id' => $tag->id,
                'taggable_id' => $post->id,
                'taggable_type' => Post::class
            ]
        );

        Task::factory(3)->create();
    }
