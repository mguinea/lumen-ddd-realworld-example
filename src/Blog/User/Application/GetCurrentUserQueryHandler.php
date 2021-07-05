<?php

declare(strict_types=1);

namespace App\Blog\User\Application;

use App\Blog\User\Domain\UserAuthenticator;
use App\Blog\User\Domain\UserNotFound;
use App\Blog\User\Domain\UserRepository;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\User\UserToken;

final class GetCurrentUserQueryHandler implements QueryHandler
{
    public function __construct(
        private UserRepository $repository,
        private UserAuthenticator $authenticator
    ) {
    }

    public function __invoke(GetCurrentUserQuery $query): UserResponse
    {
        $token = UserToken::fromValue($query->token());

        $userId = $this->authenticator->validate($token);
        $user = $this->repository->findById($userId);

        if (null === $user) {
            throw new UserNotFound("User not found");
        }

        return UserResponse::fromPrimitives(
            $user->id()->value(),
            $user->email()->value(),
            $token->value(),
            $user->name()->value(),
            $user->bio()->value(),
            $user->image()->value()
        );
    }
}
