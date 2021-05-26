<?php

declare(strict_types=1);

namespace App\Blog\User\Infrastructure;

use App\Blog\User\Domain\UserAuthenticator;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserPassword;
use App\Shared\Domain\User\UserToken;
use Illuminate\Http\Client\Factory;

final class HttpUserAuthenticator implements UserAuthenticator
{
    private Factory $http;

    public function __construct(Factory $http)
    {
        $this->http = $http;
    }

    public function logIn(UserEmail $email, UserPassword $password): ?UserToken
    {
        // TODO url from env

        $response = $this->http->post(
            'realworld.auth.app:8879/auth/api/users/login',
            [
                'email' => $email->value(),
                'password' => $password->value()
            ]
        );

        return UserToken::fromValue($response->json('token'));
    }

    public function validate(UserToken $token): UserId
    {
        $payload = [
            'token' => $token->value()
        ];

        $response = $this->http->post('realworld.auth.app:8879/auth/api/tokens/validate', $payload);

        return UserId::fromValue($response->json('token')['id']);
    }
}
