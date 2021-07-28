<?php

declare(strict_types=1);

namespace Apps\AuthApi\Tests\Http\Controllers\Auth;

use App\Auth\User\Domain\User;
use Apps\AuthApi\Tests\TestCase;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\Auth\User\Domain\UserBuilder;
use Tests\Auth\User\Domain\UserPasswordBuilder;

final class UserLoginControllerTest extends TestCase
{
    use DatabaseTransactions;

    private string $endpoint = '/auth/api/users/login';

    public function testLogInRegisteredUser(): void
    {
        $user = (new UserBuilder())->build();
        $this->registerUser($user);

        $payload = [
            'email' => $user->email()->value(),
            'password' => $user->password()->value()
        ];

        $this->post($this->endpoint, $payload);

        $this->response
            ->assertJson(
                [
                    'email' => $user->email()->value()
                ]
            )
            ->assertStatus(Response::HTTP_OK);
    }

    private function registerUser(User $user): void
    {
        $payload = [
            'email' => $user->email()->value(),
            'password' => $user->password()->value()
        ];

        $this->post('/auth/api/users', $payload);
    }

    public function testLogInNonRegisteredUser(): void
    {
        $user = (new UserBuilder())->build();
        $this->registerUser($user);

        $payload = [
            'email' => $user->email()->value(),
            'password' => ((new UserPasswordBuilder())->build())->value()
        ];

        $this->post($this->endpoint, $payload);

        $this->response
            ->assertJson(
                [
                    'errors' => "Authentication error"
                ]
            )
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
