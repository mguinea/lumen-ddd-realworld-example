<?php

declare(strict_types=1);

namespace Apps\BlogApi\Tests\Http\Controllers\Auth;

use Apps\BlogApi\Tests\TestCase;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\Auth\User\Domain\UserBioBuilder;
use Tests\Auth\User\Domain\UserBuilder;
use Tests\Auth\User\Domain\UserImageBuilder;

final class RegisterControllerTest extends TestCase
{
    use DatabaseMigrations;

    private string $endpoint = '/api/users';

    public function testRegisterUser()
    {
        $user = (new UserBuilder())->build();

        $payload = [
            'user' => [
                'username' => $user->username()->value(),
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
            )->assertStatus(Response::HTTP_OK);
    }

    public function testRegisterUserWithoutOptionalFields()
    {
        $user = (new UserBuilder())
            ->withBio((new UserBioBuilder())->withValue()->build())
            ->withImage((new UserImageBuilder())->withValue()->build())
            ->build();

        $payload = [
            'user' => [
                'username' => $user->username()->value(),
                'email' => $user->email()->value(),
                'password' => $user->password()->value(),
                'bio' => $user->bio()->value(),
                'image' => $user->image()->value()
            ]
        ];

        $this->post($this->endpoint, $payload);

        $this->response
            ->assertJson(
                [
                    'user' => [
                        'email' => $user->email()->value(),
                        'username' => $user->username()->value(),
                        'bio' => $user->bio()->value(),
                        'image' => $user->image()->value()
                    ]
                ]
            )->assertStatus(Response::HTTP_OK);
    }

    public function testCannotRegisterUserWithoutEmail()
    {
        $user = (new UserBuilder())->build();

        $payload = [
            'user' => [
                'username' => $user->username()->value(),
                'password' => $user->password()->value(),
                'bio' => $user->bio()->value(),
                'image' => $user->image()->value()
            ]
        ];

        $this->post($this->endpoint, $payload);

        $this->response
            ->assertJson(
                [
                    'errors' => [
                        'email' => "can't be empty"
                    ]
                ]
            )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
