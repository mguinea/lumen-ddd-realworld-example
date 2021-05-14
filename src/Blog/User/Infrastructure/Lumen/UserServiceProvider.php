<?php

declare(strict_types=1);

namespace App\Blog\User\Infrastructure\Lumen;

use App\Blog\User\Domain\UserRepository;
use App\Blog\User\Infrastructure\Persistence\Eloquent\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

final class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        parent::register();

        $this->app->bind(
            UserRepository::class,
            EloquentUserRepository::class
        );

        // TODO bind domain event with listeners??
    }
}
