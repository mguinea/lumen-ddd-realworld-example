<?php

declare(strict_types=1);

namespace App\Blog\User\Domain;

use App\Blog\Shared\Domain\User\User;

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
        UserPassword $password,
        UserBio $bio,
        UserImage $image
    ): User {
        $user = $this->repository->findByEmail($email);

        if (null !== $user) {
            throw new UserAlreadyRegistered();
        }

        return $this->repository->register($username, $email, $password, $bio, $image);
    }
}
