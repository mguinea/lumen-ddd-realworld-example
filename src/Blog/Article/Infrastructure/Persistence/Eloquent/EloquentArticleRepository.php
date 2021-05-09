<?php

declare(strict_types=1);

namespace App\Blog\Article\Infrastructure\Persistence\Eloquent;

use App\Blog\Article\Domain\ArticleRepository;
use App\Blog\Article\Domain\ArticleSlug;
use App\Blog\Article\Domain\Article as DomainArticle;

final class EloquentArticleRepository implements ArticleRepository
{
    private Article $model;

    public function __construct(Article $model)
    {
        $this->model = $model;
    }

    public function findBySlug(ArticleSlug $slug): ?DomainArticle
    {
        $article = $this->model->where('slug', $slug->value())->first();

        if (null === $article) {
            return null;
        }

        return $article;
    }
}
