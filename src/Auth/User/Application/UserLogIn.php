<?php

declare(strict_types=1);

namespace App\Auth\User\Application;

use App\Auth\User\Domain\UserLogIn as DomainUserLogIn;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserPassword;

final class UserLogIn
{
    private DomainUserLogIn $userLogIn;

    public function __construct(DomainUserLogIn $userLogIn)
    {
        $this->userLogIn = $userLogIn;
    }

    public function __invoke(string $email, string $password): UserResponse
    {
        $email = UserEmail::fromValue($email);
        $password = UserPassword::fromValue($password);

        $user = $this->userLogIn->__invoke($email, $password);

        return UserResponse::fromUser($user);
    }
}
