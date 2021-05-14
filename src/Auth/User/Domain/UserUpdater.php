<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

use App\Shared\Domain\User\UserPassword;

final class UserUpdater
{
    private UserAuthenticator $authenticator;
    private UserRepository $repository;

    public function __construct(UserAuthenticator $authenticator, UserRepository $repository)
    {
        $this->authenticator = $authenticator;
        $this->repository = $repository;
    }

    public function __invoke(
        ?UserEmail $email,
        ?UserPassword $password
    ): void {
        $user = $this->authenticator->getCurrentUser();

        if (null === $user) {
            throw new \Exception('Not found');
            // throw new UserNotFound(); // TODO 404
        }

        $user->update(
            $email,
            $password
        );

        $this->repository->save($user);
    }
}
