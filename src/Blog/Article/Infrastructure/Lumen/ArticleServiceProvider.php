<?php

declare(strict_types=1);

namespace App\Blog\Article\Infrastructure\Lumen;

use App\Blog\Article\Application\CreateArticleCommandHandler;
use App\Blog\Article\Application\GetArticleByIdQueryHandler;
use App\Blog\Article\Application\GetArticleBySlugQueryHandler;
use App\Blog\Article\Application\SearchArticlesQueryHandler;
use App\Blog\Article\Domain\ArticleRepository;
use App\Blog\Article\Infrastructure\Persistence\ArticleRepository as ConcreteArticleRepository;
use Illuminate\Support\ServiceProvider;

final class ArticleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ArticleRepository::class,
            ConcreteArticleRepository::class
        );

        $this->app->tag(
            CreateArticleCommandHandler::class,
            'command_handler'
        );

        $this->app->tag(
            GetArticleByIdQueryHandler::class,
            'query_handler'
        );

        $this->app->tag(
            GetArticleBySlugQueryHandler::class,
            'query_handler'
        );

        $this->app->tag(
            SearchArticlesQueryHandler::class,
            'query_handler'
        );
    }
}
