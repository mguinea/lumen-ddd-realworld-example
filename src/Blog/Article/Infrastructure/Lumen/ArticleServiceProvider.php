<?php

declare(strict_types=1);

namespace App\Blog\Article\Infrastructure\Lumen;

use App\Blog\Article\Application\CreateArticleCommandHandler;
use App\Blog\Article\Application\GetArticleBySlugQueryHandler;
use App\Blog\Article\Domain\ArticleRepository;
use App\Blog\Article\Infrastructure\Persistence\Eloquent\EloquentArticleRepository;
use Illuminate\Support\ServiceProvider;

final class ArticleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Persistence/Lumen/database/migrations');
    }

    public function register()
    {
        $this->app->bind(
            ArticleRepository::class,
            EloquentArticleRepository::class
        );

        $this->app->tag(
            CreateArticleCommandHandler::class,
            'realworld.command_handler'
        );

        $this->app->tag(
            GetArticleBySlugQueryHandler::class,
            'realworld.query_handler'
        );
    }
}
