<?php

declare(strict_types=1);

namespace App\Blog\User\Application;

use App\Blog\User\Domain\UserAuthenticator;
use App\Blog\User\Domain\UserRepository;
use App\Blog\User\Application\UserResponse;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserPassword;

final class LogInUserQueryHandler implements QueryHandler
{
    public function __construct(
        private UserAuthenticator $authenticator,
        private UserRepository $repository
    ) {
    }

    public function __invoke(LogInUserQuery $query): UserResponse
    {
        $email = UserEmail::fromValue($query->email());
        $password = UserPassword::fromValue($query->password());

        $user = $this->repository->findByEmail($email);

        if (null === $user) {
            throw new \Exception('User not found');
        }

        $token = $this->authenticator->logIn($email, $password);

        return UserResponse::fromPrimitives(
            $user->id()->value(),
            $email->value(),
            $token->value(),
            $user->name()->value(),
            $user->bio()->value(),
            $user->image()->value()
        );
    }
}
