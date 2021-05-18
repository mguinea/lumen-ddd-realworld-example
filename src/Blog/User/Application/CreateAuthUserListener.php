<?php

declare(strict_types=1);

namespace App\Blog\User\Application;

use App\Blog\User\Domain\AuthUserRegistrar;
use App\Blog\User\Domain\UserWasCreated;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserPassword;

final class CreateAuthUserListener
{
    private AuthUserRegistrar $registrar;

    public function __construct(AuthUserRegistrar $registrar)
    {
        $this->registrar = $registrar;
    }

    public function handle(UserWasCreated $event): void
    {
        $this->registrar->register(
            UserEmail::fromValue($event->email()),
            UserPassword::fromValue($event->password())
        );
    }
}
