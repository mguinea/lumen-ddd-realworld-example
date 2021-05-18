<?php

declare(strict_types=1);

namespace App\Auth\User\Application;

use App\Blog\User\Domain\UserName;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserPassword;
use App\Auth\User\Domain\UserRegistrator as DomainUserRegistrator;

final class UserRegistrator
{
    private DomainUserRegistrator $registrator;

    public function __construct(DomainUserRegistrator $registrator)
    {
        $this->registrator = $registrator;
    }

    public function __invoke(string $email, string $password): UserResponse
    {
        $email = UserEmail::fromValue($email);
        $password = UserPassword::fromValue($password);

        $user = $this->registrator->__invoke($email, $password);

        return UserResponse::fromUser($user);

    }
}
