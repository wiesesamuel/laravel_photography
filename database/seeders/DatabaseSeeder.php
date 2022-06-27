<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Image;
use App\Models\Imageable;
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
        $this->call(UserSeeder::class);
        $this->call(ArtistSeeder::class);
    }

    private function seed_albums()
    {
        // drop tables
        Image::truncate();
        Album::truncate();
        Imageable::truncate();

        $coverImage = Image::factory()->create(
            [
                'title' => 'title image',
                'url' => '/images/wiese.png',
                'description' => 'description image'
            ]
        );

        Image::factory(5)->create();

        Album::factory(30)->create(
            [
                'image_id' => $coverImage->id
            ]
        );


        foreach (Album::all() as $album) {
            foreach (Image::all()->random(rand(1, 3))->pluck('id')->toArray() as $image) {
                Imageable::factory()->create(
                    [
                        'image_id' => $image,
                        'imageable_id' => $album->id,
                        'imageable_type' => Album::class
                    ]
                );
            }
        }
    }


}
