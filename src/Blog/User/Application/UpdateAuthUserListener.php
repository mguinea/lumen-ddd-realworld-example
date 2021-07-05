<?php

declare(strict_types=1);

namespace App\Blog\User\Application;

use App\Blog\User\Domain\UserAuthenticator;
use App\Blog\User\Domain\UserWasUpdated;
use App\Shared\Domain\Bus\Event\DomainEventSubscriber;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserPassword;

class UpdateAuthUserListener implements DomainEventSubscriber
{
    public function __construct(private UserAuthenticator $authenticator)
    {
    }

    public function __invoke(UserWasUpdated $event): void
    {
        $this->authenticator->update(
            UserId::fromValue($event->id()),
            UserEmail::fromValue($event->email()),
            UserPassword::fromValue($event->password())
        );
    }

    public static function subscribedTo(): array
    {
        return [
            UserWasUpdated::class
        ];
    }
}
