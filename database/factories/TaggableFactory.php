<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaggableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tag_id' => $this->faker->randomDigitNotNull,
            'taggable_id' => $this->faker->randomDigitNotNull,
            'taggable_type' => null, // class name
        ];
    }

}
