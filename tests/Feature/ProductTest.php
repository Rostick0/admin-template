<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_get_products(): void
    {
        $this->seed([
            CategorySeeder::class,
        ]);

        Product::factory(50)->create();

        $response = $this->get('/api/v1/products');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                array_keys(Product::first()->getAttributes())
            ]
        ]);
    }
}
