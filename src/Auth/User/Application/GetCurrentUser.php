<?php

declare(strict_types=1);

namespace App\Auth\User\Application;

use App\Auth\User\Domain\UserAuthenticator;

final class GetCurrentUser
{
    private UserAuthenticator $authenticator;

    public function __construct(UserAuthenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    public function __invoke(): UserResponse
    {
        $user = $this->authenticator->getCurrentUser();

        if (null === $user) {
            throw new \Exception('User not found'); // TODO custom exception
        }

        return UserResponse::fromUser($user);
    }
}
