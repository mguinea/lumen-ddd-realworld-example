<?php

namespace App\Blog\User\Domain;

use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserPassword;
use App\Shared\Domain\User\UserToken;

interface UserAuthenticator
{
    public function logIn(UserEmail $email, UserPassword $password): ?UserToken;

    public function validate(UserToken $token): UserId;
}
