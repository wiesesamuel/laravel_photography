<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->firstName,
            'url' => public_path('images/wiese.png'),
            'description' => $this->faker->sentence,
            //
        ];
    }
}
