<?php

namespace Tests\Feature;

use App\Models\Favorite;
use App\Models\Review;
use Database\Factories\ReviewFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Tests\UserTestUtil;

class ReviewTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_reviews(): void
    {
        Review::factory()->create();

        $response = $this->get('/api/v1/reviews');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                array_keys(Review::first()->getAttributes())
            ]
        ]);
    }

    public function test_create_review(): void
    {
        [$user, $token] = UserTestUtil::getUserAndToken();

        $data_create = (new ReviewFactory())->definition();

        $response = $this->post('/api/v1/reviews', $data_create, ['authorization' => 'Bearer ' . $token]);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'data' => array_keys(Review::first()->getAttributes())
        ]);

        $this->assertDatabaseHas(Review::class, [...$data_create, 'user_id' => $user->id]);
    }

    public function test_update_review(): void
    {
        [$user, $token] = UserTestUtil::getUserAndToken();

        $data_finded = Review::inRandomOrder()->first();
        $data_create = (new ReviewFactory())->definition();

        $response = $this->patch('/api/v1/reviews/' . $data_finded->id, $data_create, ['authorization' => 'Bearer ' . $token]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => array_keys(Review::first()->getAttributes())
        ]);

        $this->assertDatabaseHas(Review::class, [...$data_create, 'id' => $data_finded->id, 'product_id' => $data_finded->product_id, 'user_id' => $user->id]);
    }

    public function test_delete_review(): void
    {
        [$user, $token] = UserTestUtil::getUserAndToken();

        $data_finded = Review::inRandomOrder()->first();

        $response = $this->delete('/api/v1/reviews/' . $data_finded->id, [], ['authorization' => 'Bearer ' . $token]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'message'
        ]);

        $this->assertDatabaseMissing(Review::class, ['id' => $data_finded->id]);
    }
}
