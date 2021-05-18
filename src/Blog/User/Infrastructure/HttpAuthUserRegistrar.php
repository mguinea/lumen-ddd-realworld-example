<?php

declare(strict_types=1);

namespace App\Blog\User\Infrastructure;

use App\Blog\User\Domain\AuthUserRegistrar;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserPassword;
use Illuminate\Http\Client\Factory;

final class HttpAuthUserRegistrar implements AuthUserRegistrar
{
    private Factory $http;

    public function __construct(Factory $http)
    {
        $this->http = $http;
    }

    public function register(UserEmail $email, UserPassword $password): void
    {
        // TODO url from env
        $this->http->post('localhost:8880/api/auth/users', [
            'email' => $email->value(),
            'password' => $password->value()
        ]);
    }
}
