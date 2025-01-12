<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Database\Factories\ProductFactory;
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
        Product::factory(50)->create();

        $response = $this->get('/api/v1/products');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                array_keys(Product::first()->getAttributes())
            ]
        ]);
    }

    public function test_get_product(): void
    {
        $product = Product::factory()->create();

        $response = $this->get('/api/v1/products/' . $product->id);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => array_keys(Product::first()->getAttributes())
        ]);
    }

    public function test_create_product(): void
    {
        $product = (new ProductFactory)->definition();

        $response = $this->post('/api/v1/products', $product);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => array_keys(Product::first()->getAttributes())
        ]);
    }

    public function test_update_product(): void
    {
        $product = (new ProductFactory)->definition();

        $response = $this->patch('/api/v1/products', $product);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => array_keys(Product::first()->getAttributes())
        ]);
    }
}
