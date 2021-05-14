<?php

declare(strict_types=1);

namespace App\Blog\User\Domain;

use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;

final class UserCreator
{
    private UserRepository $repository;
    private EventBus $eventBus;

    public function __construct(UserRepository $repository, EventBus $eventBus)
    {
        $this->repository = $repository;
        $this->eventBus = $eventBus;
    }

    public function __invoke(
        UserId $id,
        UserName $name,
        UserEmail $email
    ): void {
        $user = $this->repository->findByEmail($email);

        if (null !== $user) {
            throw new UserAlreadyExists();
        }

        $user = User::create(
            $id,
            $name,
            $email
        );

        $this->repository->save($user);
        $this->eventBus->publish(...$user->pullDomainEvents());
    }
}
