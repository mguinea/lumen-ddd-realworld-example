<?php

declare(strict_types=1);

namespace App\Auth\User\Infrastructure\Lumen;

use App\Auth\User\Application\GetUserByIdQueryHandler;
use App\Auth\User\Application\LogInUserQueryHandler;
use App\Auth\User\Application\RegisterUserCommandHandler;
use App\Auth\User\Domain\UserAuthenticator;
use App\Auth\User\Domain\UserRepository;
use App\Auth\User\Infrastructure\LumenUserAuthenticator;
use App\Auth\User\Infrastructure\Persistence\Eloquent\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    public function register()
    {
        parent::register();

        $this->app->bind(
            UserRepository::class,
            EloquentUserRepository::class
        );

        $this->app->bind(
            UserAuthenticator::class,
            LumenUserAuthenticator::class
        );

        $this->app->tag(
            GetUserByIdQueryHandler::class,
            'realworld.query_handler'
        );

        $this->app->tag(
            LogInUserQueryHandler::class,
            'realworld.query_handler'
        );

        $this->app->tag(
            RegisterUserCommandHandler::class,
            'realworld.command_handler'
        );
    }
}
