<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vendor;
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
            'link_name' => strtolower(str_replace(' ', '-', fake()->unique()->text(random_int(5, 30)))),
            'description' => fake()->text(random_int(50, 150)),
            'price' => fake()->numberBetween(1000, 50000) / 100,
            'old_price' => fake()->numberBetween(1000, 50000) / 100,
            'count' => random_int(0, 50),
            'is_infinitely'=> random_int(0, 1),
            'raiting' => (random_int(300, 500) / 100),
            'views' => random_int(0, 500),
            'user_id' => User::first()->id,
            'category_id' => random_int(1, 4),
            'vendor_id' => (Vendor::count() > 5 ? Vendor::inRandomOrder()->first(['id']) : Vendor::factory()->create())->id,
        ];
    }
}
