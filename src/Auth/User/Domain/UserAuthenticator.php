<?php

namespace App\Auth\User\Domain;

use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserPassword;

interface UserAuthenticator
{
    public function getCurrentUser(): ?User;

    public function logIn(UserEmail $email, UserPassword $password): ?UserToken;

    public function register(User $user): void;
}
