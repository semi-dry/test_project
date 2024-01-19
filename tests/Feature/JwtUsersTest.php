<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class JwtUsersTest extends TestCase
{
    public function testsRegistersSuccessfully()
    {
        $payload = [
            'name' => 'Test',
            'email' => 'test@user.ru',
            'password' => 'password',
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'user' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ],
                'authorisation' => [
                    'token',
                    'type',
                ]]);
    }

    public function testLoginUser()
    {

        $data = $this->token();
        $token = $data['token'];
        $headers = ['Authorization' => "Bearer $token"];

        $this->json('POST', 'api/login', ['email' => $data['email'],
            'password' => $data['password']], $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                'user' => [
                    'name',
                    'email',
                    'updated_at',
                    'created_at',
                    'id',
                ],
                'authorisation' => [
                    'token',
                    'type',
                ]]);
    }

    public function testUserLogoutSuccessfully()
    {
        $token = $this->token()['token'];
        $headers = ['Authorization' => "Bearer $token"];

        $this->json('POST', 'api/logout', [], $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
            ]);

    }
}
