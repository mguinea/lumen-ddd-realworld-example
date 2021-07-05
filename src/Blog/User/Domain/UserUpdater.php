<?php

declare(strict_types=1);

namespace App\Blog\User\Domain;

use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserPassword;

final class UserUpdater
{
    public function __construct(
        private UserRepository $repository,
        private EventBus $eventBus
    ) {
    }

    public function __invoke(
        UserId $id,
        UserName $name,
        UserEmail $email,
        UserPassword $password,
        UserBio $bio,
        UserImage $image
    ) {
        $user = $this->repository->findById($id);

        if (null === $user) {
            throw new UserNotFound();
        }

        $user->update(
            $name,
            $email,
            $password,
            $bio,
            $image
        );

        $this->repository->save($user);
        $this->eventBus->publish(...$user->pullDomainEvents());
    }
}
