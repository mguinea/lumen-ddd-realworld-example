<?php

namespace App\Blog\User\Domain;

use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserPassword;

interface AuthUserRegistrar
{
    public function register(UserEmail $email, UserPassword $password): void;
}
