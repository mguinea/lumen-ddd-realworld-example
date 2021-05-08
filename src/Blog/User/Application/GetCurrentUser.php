<?php

declare(strict_types=1);

namespace App\Blog\User\Application;

use App\Blog\User\Domain\UserRepository;

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
            // TODO not loged in
        }

        return UserResponse::fromUser($user);
    }
}
