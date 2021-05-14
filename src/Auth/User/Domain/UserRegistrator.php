<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserPassword;

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
        UserEmail $email,
        UserPassword $password
    ): User {
        $user = $this->repository->findByEmail($email);

        if (null !== $user) {
            throw new UserAlreadyRegistered();
        }

        $user = User::register(
            $email,
            $password
        );

        $this->repository->save($user);
        $this->eventBus->publish(...$user->pullDomainEvents());

        return $user;
    }
}
