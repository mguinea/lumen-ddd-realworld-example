<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserPassword;

final class UserLogIn
{
    private UserAuthenticator $authenticator;

    public function __construct(UserAuthenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    public function __invoke(UserEmail $email, UserPassword $password): UserToken
    {
        $userToken = $this->authenticator->logIn($email, $password);

        if (null === $userToken) {
            throw new AuthorizationException();
        }

        return $userToken;
    }
}
