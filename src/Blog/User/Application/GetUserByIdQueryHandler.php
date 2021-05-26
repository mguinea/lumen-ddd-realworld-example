<?php

declare(strict_types=1);

namespace App\Blog\User\Application;

use App\Blog\User\Domain\UserNotFound;
use App\Blog\User\Domain\UserRepository;
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

        return UserResponse::fromPrimitives(
            $user->email()->value(),
            null,
            $user->name()->value(),
            $user->bio()->value(),
            $user->image()->value()
        );
    }
}
