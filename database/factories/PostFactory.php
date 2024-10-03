<?php

namespace Database\Factories;

use App\Models\District;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array

    {
        return [
            'title' => fake()->name(),
            'description' => fake()->text(random_int(150, 200)),
            'content' => fake()->text(random_int(150, 300)),
            'user_id' => 1,
            'rubric_id' => random_int(1, 4),
            'source' => fake()->url(),
            'count_view' => random_int(0, 5000),
            'status' => 'publish',
        ];
    }
}
