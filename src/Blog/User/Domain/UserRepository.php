<?php

namespace App\Blog\User\Domain;

use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;

interface UserRepository
{
    public function findByEmail(UserEmail $email): ?User;

    public function findById(UserId $id): ?User;

    public function save(User $user): void;
}
