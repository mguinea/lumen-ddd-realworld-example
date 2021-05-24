<?php

declare(strict_types=1);

namespace App\Blog\User\Application;

use App\Blog\User\Domain\UserRepository;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Blog\User\Application\UserResponse;
use App\Shared\Domain\User\UserId;

final class GetUserByIdQueryHandler implements QueryHandler
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(GetUserByIdQuery $query): UserResponse
    {
        $id = UserId::fromValue($query->id());
        $user = $this->repository->findById($id);

        if (null === $user) {
            throw new \Exception('not found'); // TODO
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
