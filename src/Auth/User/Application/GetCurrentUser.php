<?php

declare(strict_types=1);

namespace App\Auth\User\Application;

use App\Auth\User\Domain\UserRepository;

final class GetCurrentUser
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): UserResponse
    {
        $user = $this->repository->getCurrentUser();

        if (null === $user) {
            throw new \Exception('User not found'); // TODO custom exception
        }

        return UserResponse::fromUser($user);
    }
}
