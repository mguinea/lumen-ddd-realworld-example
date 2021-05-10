<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

final class UserRegistrator
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        UserName $username,
        UserEmail $email,
        UserPassword $password
    ): User {
        $user = $this->repository->findByEmail($email);

        if (null !== $user) {
            throw new UserAlreadyRegistered();
        }

        $domainUser = User::register(
            $username,
            $email,
            $password
        );

        return $this->repository->register($domainUser);
    }
}
