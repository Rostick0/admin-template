<?php

namespace Tests\Feature;

use App\Enum\EmailCodeType;
use App\Models\EmailCode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserTest extends TestCase
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
    public function test_update_email(): void
    {
        User::create($this->request_data);
        $token = JWTAuth::attempt($this->request_data);

        $code = sprintf('%06d', rand(1, 1000000));
        EmailCode::create([
            'email' => $this->request_data['email'],
            'code' => $code,
            'type' => EmailCodeType::update_email->value,
        ]);

        $new_email = 'newmail@dd.com';

        $response = $this->patch('/api/v1/users/email-update', [
            'email_old' => $this->request_data['email'],
            'email' => $new_email,
            'code' => $code,
        ], ['authorization' => 'Bearer ' . $token]);

        $response->assertStatus(200);

        $this->assertDatabaseHas(User::class, ['email' => $new_email]);
    }
}
