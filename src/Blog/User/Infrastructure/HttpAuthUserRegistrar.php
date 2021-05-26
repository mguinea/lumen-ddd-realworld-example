<?php

declare(strict_types=1);

namespace App\Blog\User\Infrastructure;

use App\Blog\User\Domain\AuthUserRegistrar;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserPassword;
use Illuminate\Http\Client\Factory;

final class HttpAuthUserRegistrar implements AuthUserRegistrar
{
    private Factory $http;

    public function __construct(Factory $http)
    {
        $this->http = $http;
    }

    public function register(UserId $id, UserEmail $email, UserPassword $password): void
    {
        // TODO url from env
        $this->http->post('realworld.auth.app:8879/auth/api/users', [
            'id' => $id->value(),
            'email' => $email->value(),
            'password' => $password->value()
        ]);
    }
}
