<?php

namespace App\Blog\User\Domain;

use App\Shared\Domain\User\UserEmail;

interface UserRepository
{
    public function findByEmail(UserEmail $email): ?User;

    public function save(User $user): void;
}
