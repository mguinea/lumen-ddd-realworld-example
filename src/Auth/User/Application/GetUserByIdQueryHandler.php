<?php

declare(strict_types=1);

namespace App\Auth\User\Application;

use App\Auth\User\Domain\UserNotFound;
use App\Auth\User\Domain\UserRepository;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\User\UserId;

final class GetUserByIdQueryHandler implements QueryHandler
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function __invoke(GetUserByIdQuery $query): UserResponse
    {
        $id = UserId::fromValue($query->id());
        $user = $this->repository->findById($id);

        if (null === $user) {
            throw new UserNotFound();
        }

        return UserResponse::fromUser($user);
    }
}
