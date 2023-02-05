<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'intervall' => \Carbon\Carbon::createFromTime(fake()->numberBetween(0, 23), fake()->numberBetween(0, 59)),
            'active' => true,
        ];
    }
}
