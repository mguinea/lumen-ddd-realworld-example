<?php

declare(strict_types=1);

namespace App\Auth\User\Application;

use App\Auth\User\Domain\UserEmail;
use App\Auth\User\Domain\UserLogIn;
use App\Auth\User\Domain\UserPassword;

final class LogIn
{
    private UserLogIn $userLogIn;

    public function __construct(UserLogIn $userLogIn)
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
