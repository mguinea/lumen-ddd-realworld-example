<?php

declare(strict_types=1);

namespace App\Blog\User\Infrastructure\Lumen;

use App\Blog\User\Application\GetUserByIdQueryHandler;
use App\Blog\User\Application\LogInUserQueryHandler;
use App\Blog\User\Application\RegisterUserCommandHandler;
use App\Blog\User\Domain\AuthUserRegistrar;
use App\Blog\User\Domain\UserAuthenticator;
use App\Blog\User\Domain\UserRepository;
use App\Blog\User\Infrastructure\HttpAuthUserRegistrar;
use App\Blog\User\Infrastructure\HttpUserAuthenticator;
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

        $this->app->bind(
            AuthUserRegistrar::class,
            HttpAuthUserRegistrar::class
        );

        $this->app->bind(
            UserAuthenticator::class,
            HttpUserAuthenticator::class
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
