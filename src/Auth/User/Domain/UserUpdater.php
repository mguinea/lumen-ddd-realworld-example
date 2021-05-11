<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

final class UserUpdater
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        ?UserName $username,
        ?UserEmail $email,
        ?UserPassword $password,
        ?UserBio $bio,
        ?UserImage $image
    ): User {
        $user = $this->repository->getCurrentUser();

        if (null === $user) {
            throw new \Exception('Not found');
            // throw new UserNotFound(); // TODO 404
        }

        $user->update(
            $email,
            $password,
            $username,
            $bio,
            $image
        );

        return $this->repository->save($user);
    }
}
