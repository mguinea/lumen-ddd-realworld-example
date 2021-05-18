<?php

declare(strict_types=1);

namespace App\Blog\User\Domain;

use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserPassword;

final class UserCreator
{
    private UserRepository $repository;
    private EventBus $eventBus;
    private AuthUserRegistrar $registrar;

    public function __construct(
        UserRepository $repository,
        EventBus $eventBus,
        AuthUserRegistrar $registrar
    ) {
        $this->repository = $repository;
        $this->eventBus = $eventBus;
        $this->registrar = $registrar;
    }

    public function __invoke(
        UserId $id,
        UserName $name,
        UserEmail $email,
        UserPassword $password
    ): void {
        $user = $this->repository->findByEmail($email);

        if (null !== $user) {
            throw new UserAlreadyExists();
        }

        $user = User::create(
            $id,
            $name,
            $email,
            UserBio::fromValue(null),
            UserImage::fromValue(null)
        );

        $this->registrar->register(
            $email,
            $password
        );

        $this->repository->save($user);
        $this->eventBus->publish(...$user->pullDomainEvents());
    }
}
