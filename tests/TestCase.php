<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use RuntimeException;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    protected function token(): array
    {
        // simply to save time

        $email = 'test@mail.ru';
        $password = 'password';
        $name = 'Test';
        $response = $this->json('post', 'api/register',
            [
                'email' => $email,
                'password' => $password, 'name' => $name
            ]);
        $content = json_decode($response->getContent());
        if (! isset($content->authorisation->token)) {
            throw new RuntimeException('Token missing in response');
        }
        return ['token' => $content->authorisation->token,
            'user_id' => $content->user->id,
            'email'=>$content->user->email,
            'password'=>'password'
        ];
    }

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed');
    }
}
