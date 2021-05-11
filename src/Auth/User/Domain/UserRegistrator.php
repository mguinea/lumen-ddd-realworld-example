<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

use App\Shared\Domain\Bus\Event\EventBus;

final class UserRegistrator
{
    private UserRepository $repository;
    private EventBus $eventBus;

    public function __construct(UserRepository $repository, EventBus $eventBus)
    {
        $this->repository = $repository;
        $this->eventBus = $eventBus;
    }

    public function __invoke(
        UserName $username,
        UserEmail $email,
        UserPassword $password
    ): User {
        $user = $this->repository->findByEmail($email);

        if (null !== $user) {
            throw new UserAlreadyRegistered();
        }

        $domainUser = User::register(
            $username,
            $email,
            $password
        );

        $user = $this->repository->register($domainUser);
        $this->eventBus->publish(...$user->pullDomainEvents());

        return $user;
    }
}
