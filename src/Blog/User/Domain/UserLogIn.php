<?php

declare(strict_types=1);

namespace App\Blog\User\Domain;

use App\Blog\Shared\Domain\User\User;

final class UserLogIn
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UserEmail $email, UserPassword $password): User
    {
        return $this->repository->logIn($email, $password);
    }
}
