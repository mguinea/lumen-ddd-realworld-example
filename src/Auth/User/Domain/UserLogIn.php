<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

use App\Shared\Domain\User\UserPassword;

final class UserLogIn
{
    private UserAuthenticator $authenticator;

    public function __construct(UserAuthenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    public function __invoke(UserEmail $email, UserPassword $password): User
    {
        $user = $this->authenticator->logIn($email, $password);

        if (null === $user) {
            throw new AuthorizationException();
        }

        return $user;
    }
}
