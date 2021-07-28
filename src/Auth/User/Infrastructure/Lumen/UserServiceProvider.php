<?php

declare(strict_types=1);

namespace App\Auth\User\Infrastructure\Lumen;

use App\Auth\User\Application\GetUserByIdQueryHandler;
use App\Auth\User\Application\LogInUserQueryHandler;
use App\Auth\User\Application\RegisterUserCommandHandler;
use App\Auth\User\Application\TokenValidationQueryHandler;
use App\Auth\User\Domain\TokenManager;
use App\Auth\User\Domain\UserAuthenticator as UserAuthenticatorInterface;
use App\Auth\User\Domain\UserRepository;
use App\Auth\User\Infrastructure\FirebaseTokenManager;
use App\Auth\User\Infrastructure\UserAuthenticator;
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
            UserAuthenticatorInterface::class,
            UserAuthenticator::class
        );

        $this->app->bind(
            TokenManager::class,
            FirebaseTokenManager::class
        );

        $this->app->tag(
            GetUserByIdQueryHandler::class,
            'query_handler'
        );

        $this->app->tag(
            LogInUserQueryHandler::class,
            'query_handler'
        );

        $this->app->tag(
            TokenValidationQueryHandler::class,
            'query_handler'
        );

        $this->app->tag(
            RegisterUserCommandHandler::class,
            'command_handler'
        );
    }
}
