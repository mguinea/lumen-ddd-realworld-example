<?php

namespace App\Auth\User\Domain;

interface UserRepository
{
    public function findByEmail(UserEmail $email): ?User;

    public function getCurrentUser(): ?User;

    public function logIn(UserEmail $email, UserPassword $password): ?User;

    public function register(User $user): User;

    public function save(User $user): User;
}
