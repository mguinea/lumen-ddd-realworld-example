<?php

declare(strict_types=1);

namespace App\Blog\Article\Infrastructure\Lumen;

use App\Blog\Article\Domain\ArticleRepository;
use App\Blog\Article\Infrastructure\Persistence\Eloquent\EloquentArticleRepository;
use Illuminate\Support\ServiceProvider;

class ArticleServiceProvider extends ServiceProvider
{
    public function register()
    {
        parent::register();

        $this->app->bind(
            ArticleRepository::class,
            EloquentArticleRepository::class
        );
    }
}
