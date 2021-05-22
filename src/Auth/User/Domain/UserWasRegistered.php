<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

final class UserWasRegistered extends UserDomainEvent
{
    public function eventName(): string
    {
        return 'realworld.auth.user_was_registered';
    }
}
