<?php

namespace App\Blog\User\Domain;

use App\Blog\Shared\Domain\User\User;

interface UserRepository
{
    public function findByEmail(UserEmail $email): ?User;

    public function getCurrentUser(): ?User;

    public function logIn(UserEmail $email, UserPassword $password): ?User;

    public function register(
        UserName $username,
        UserEmail $email,
        UserPassword $password,
        UserBio $bio,
        UserImage $image
    ): User;
}
