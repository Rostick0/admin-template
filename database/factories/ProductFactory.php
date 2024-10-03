<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'link_name' => strtolower(str_replace(' ', '-', fake()->unique()->text(random_int(4, 30)))),
            'description' => fake()->text(random_int(50, 150)),
            'price' => fake()->numberBetween(1000, 50000) / 100,
            'old_price' => fake()->numberBetween(1000, 50000) / 100,
            'count' => random_int(0, 50),
            'is_infinitely'=> random_int(0, 1),
            'raiting' => (random_int(300, 500) / 100),
            'views' => random_int(0, 500),
            'user_id' => 1,
            'category_id' => random_int(1, 4),
            'vendor_id' => random_int(1, 10),
        ];
    }
}
