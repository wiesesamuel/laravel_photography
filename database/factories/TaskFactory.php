<?php

namespace Database\Factories;

use App\Enum\TaskState;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'taskStateKey' => TaskState::getRandomKey()
            //
        ];
    }
}
