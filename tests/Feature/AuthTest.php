<?php

namespace Tests\Feature;

use App\Enum\EmailCodeType;
use App\Http\Controllers\AuthController;
use App\Models\EmailCode;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected array $request_data = [
        'email' => 'test@email.com',
        'password' => '@432rfvc',
        'name' => 'test',
    ];
    /**
     * A basic feature test example.
     */

    public function test_auth_register(): void
    {
        $code = sprintf('%06d', rand(1, 1000000));

        EmailCode::create([
            'email' => $this->request_data['email'],
            'code' => $code,
            'type' => EmailCodeType::register->value,
        ]);

        $response = $this->post('/api/v1/auth/register', [...$this->request_data, 'code' => $code]);

        $response->assertStatus(201);

        $this->assertDatabaseHas(User::class, ['email' => $this->request_data['email']]);
    }

    public function test_auth_login(): void
    {
        User::create($this->request_data);

        $response = $this->post('/api/v1/auth/login', $this->request_data);
        $response->assertStatus(201);
        $response->assertJsonStructure(['data' => [
            'access_token',
            'token_type',
            'expires_in',
            'user',
        ]]);
    }

    public function test_auth_me(): void
    {
        User::create($this->request_data);

        $token = JWTAuth::attempt($this->request_data);

        $response = $this->get('/api/v1/auth/me', ['authorization' => 'Bearer ' . $token]);
        $response->assertStatus(200);

        $response->assertJsonStructure(['data']);
    }
}
