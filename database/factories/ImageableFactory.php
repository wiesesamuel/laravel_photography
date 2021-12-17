<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image_id' => 1,
            'imageable_id' => 1,
            'imageable_type' => 'App\\\\Models\\\\Album',
            'numeration' => 1,
        ];
    }
}
