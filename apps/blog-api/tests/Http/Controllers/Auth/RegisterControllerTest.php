<?php

declare(strict_types=1);

namespace Apps\BlogApi\Tests\Http\Controllers\Auth;

use App\Shared\Domain\ValueObject\NotValidValueObjectException;
use Apps\BlogApi\Tests\TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\Blog\Shared\Domain\User\UserBuilder;
use Tests\Blog\User\Domain\UserEmailBuilder;

final class RegisterControllerTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    private string $endpoint = '/api/users';

    public function testRegisterUser()
    {
        $user = (new UserBuilder())->build();

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

        $this->response->assertJson(
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

    // TODO cargar con data varias opciones
    public function testRegisterUserWithMissingRequiredParameters()
    {
        // $this->expectException(NotValidValueObjectException::class);

        $user = (new UserBuilder())
            ->withEmail((new UserEmailBuilder)->withValue("")->build())
            ->build();

        $payload = [
            'user' => [
                'username' => $user->username()->value(),
                'password' => $user->password()->value(),
                'bio' => $user->bio()->value(),
                'image' => $user->image()->value()
            ]
        ];

        $this->post($this->endpoint, $payload);

        $this->response->assertJson(
            [
                'errors' => [
                    'email' => "can't be empty"
                ]
            ]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
