<?php

declare(strict_types=1);

namespace App\Blog\User\Application;

use App\Blog\User\Domain\UserEmail;
use App\Blog\User\Domain\UserLogIn;
use App\Blog\User\Domain\UserPassword;

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
