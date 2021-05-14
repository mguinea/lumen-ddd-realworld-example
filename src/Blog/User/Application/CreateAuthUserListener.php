<?php

declare(strict_types=1);

namespace App\Blog\User\Application;

// Lister of UserWasCreated domain event

final class CreateAuthUserListener
{
    public function __invoke(): void
    {
        dd('from listener');
    }
}
