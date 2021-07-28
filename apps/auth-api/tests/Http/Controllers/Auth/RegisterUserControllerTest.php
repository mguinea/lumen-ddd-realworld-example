<?php

declare(strict_types=1);

namespace Apps\AuthApi\Tests\Http\Controllers\Auth;

use Apps\AuthApi\Tests\TestCase;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\Auth\User\Domain\UserBuilder;

final class RegisterUserControllerTest extends TestCase
{
    use DatabaseTransactions;

    private string $endpoint = '/auth/api/users';

    public function testRegisterUser()
    {
        $user = (new UserBuilder())->build();

        $payload = [
            'email' => $user->email()->value(),
            'password' => $user->password()->value()
        ];

        $this->post($this->endpoint, $payload);

        $this->response
            ->assertJson(
                [
                    'email' => $user->email()->value(),
                    'token' => null
                ]
            )->assertStatus(Response::HTTP_OK);
    }

    public function testCannotRegisterUserWithoutEmail()
    {
        $payload = [];

        $this->post($this->endpoint, $payload);

        $this->response
            ->assertExactJson(
                [
                    'errors' => [
                        'email' => [
                            "The email field is required."
                        ],
                        'password' => [
                            "The password field is required."
                        ]
                    ]
                ]
            )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
