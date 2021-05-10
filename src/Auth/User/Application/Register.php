<?php

declare(strict_types=1);

namespace App\Auth\User\Application;

use App\Auth\User\Domain\UserEmail;
use App\Auth\User\Domain\UserName;
use App\Auth\User\Domain\UserPassword;
use App\Auth\User\Domain\UserRegistrator;

final class Register
{
    private UserRegistrator $registrator;

    public function __construct(UserRegistrator $registrator)
    {
        $this->registrator = $registrator;
    }

    public function __invoke(string $username, string $email, string $password): UserResponse
    {
        $username = UserName::fromValue($username);
        $email = UserEmail::fromValue($email);
        $password = UserPassword::fromValue($password);

        $user = $this->registrator->__invoke($username, $email, $password);

        return UserResponse::fromUser($user);
    }
}
