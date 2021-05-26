<?php

declare(strict_types=1);

namespace App\Auth\User\Application;

use App\Auth\User\Domain\AuthenticationException;
use App\Auth\User\Domain\UserAuthenticator;
use App\Auth\User\Domain\UserNotFound;
use App\Auth\User\Domain\UserRepository;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserPassword;

final class LogInUserQueryHandler implements QueryHandler
{
    public function __construct(
        private UserRepository $repository,
        private UserAuthenticator $authenticator
    ) {
    }

    public function __invoke(LogInUserQuery $query): UserResponse
    {
        $email = UserEmail::fromValue($query->email());
        $password = UserPassword::fromValue($query->password());

        $user = $this->repository->findByEmail($email);

        if (null === $user) {
            throw new AuthenticationException();
        }

        $userToken = $this->authenticator->logIn($email, $password);

        if (null === $userToken) {
            throw new AuthenticationException();
        }

        return UserResponse::fromPrimitives(
            $user->id()->value(),
            $user->email()->value(),
            $userToken->value()
        );
    }
}
