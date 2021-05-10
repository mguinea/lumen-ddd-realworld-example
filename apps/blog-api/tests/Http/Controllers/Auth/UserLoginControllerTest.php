<?php

declare(strict_types=1);

namespace Apps\BlogApi\Tests\Http\Controllers\Auth;

use App\Auth\User\Domain\User;
use Apps\BlogApi\Tests\TestCase;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\Auth\User\Domain\UserBuilder;
use Tests\Auth\User\Domain\UserEmailBuilder;
use Tests\Auth\User\Domain\UserPasswordBuilder;

final class UserLoginControllerTest extends TestCase
{
    use DatabaseMigrations;

    private string $endpoint = '/api/users/login';

    public function testLogInRegisteredUser(): void
    {
        $user = (new UserBuilder())->build();
        $this->registerUser($user);

        $payload = [
            'user' => [
                'email' => $user->email()->value(),
                'password' => $user->password()->value()
            ]
        ];

        $this->post($this->endpoint, $payload);

        $this->response
            ->assertJson(
                [
                    'user' => [
                        'email' => $user->email()->value(),
                        'username' => $user->username()->value(),
                        'bio' => null,
                        'image' => null
                    ]
                ]
            )
            ->assertStatus(Response::HTTP_OK);
    }

    private function registerUser(User $user): void
    {
        $payload = [
            'user' => [
                'username' => $user->username()->value(),
                'email' => $user->email()->value(),
                'password' => $user->password()->value(),
                'bio' => $user->bio()->value(),
                'image' => $user->image()->value()
            ]
        ];

        $this->post('/api/users', $payload);
    }

    public function testLogInNonRegisteredUser(): void
    {
        $user = (new UserBuilder())->build();

        $payload = [
            'user' => [
                'email' => $user->email()->value(),
                'password' => $user->password()->value()
            ]
        ];

        $this->post($this->endpoint, $payload);

        $this->response->assertSee('Not authorized')
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @dataProvider logins
     */
    public function testLogInWithoutRequiredFields(?string $email, ?string $password): void
    {
        $this->post(
            $this->endpoint,
            [
                'user' => [
                    'email' => $email,
                    'password' => $password
                ]
            ]
        );

        $this->response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function logins(): array
    {
        return [
            [(new UserEmailBuilder())->build()->value(), null],
            [null, (new UserPasswordBuilder())->build()->value()],
        ];
    }
}
