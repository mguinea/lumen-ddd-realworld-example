<?php

namespace App\Auth\User\Domain;

interface UserRepository
{
    public function findByEmail(UserEmail $email): ?User;

    public function save(User $user): void;
}
