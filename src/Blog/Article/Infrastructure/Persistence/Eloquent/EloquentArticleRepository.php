<?php

declare(strict_types=1);

namespace App\Blog\Article\Infrastructure\Persistence\Eloquent;

use App\Blog\Article\Domain\Article;
use App\Blog\Article\Domain\ArticleRepository;
use App\Blog\Article\Domain\ArticleSlug;
use App\Blog\Article\Infrastructure\Persistence\Eloquent\Article as EloquentArticle;

final class EloquentArticleRepository implements ArticleRepository
{
    public function __construct(private EloquentArticle $eloquentArticle)
    {
    }

    public function findBySlug(ArticleSlug $slug): ?Article
    {
        $eloquentArticle = $this->eloquentArticle->where('slug', $slug->value())->first();

        if (null === $eloquentArticle) {
            return null;
        }

        return Article::fromPrimitives(
            $eloquentArticle->id,
            $eloquentArticle->slug,
            $eloquentArticle->title,
            $eloquentArticle->description,
            $eloquentArticle->body,
            $eloquentArticle->created_at->format('Y-m-d H:i:s'),
            $eloquentArticle->updated_at->format('Y-m-d H:i:s'),
            $eloquentArticle->favourited,
            $eloquentArticle->favorites_count
        );
    }

    public function save(Article $article): void
    {
        $eloquentArticle = new EloquentArticle();

        $eloquentArticle->id = $article->id()->value();
        $eloquentArticle->slug = $article->slug()->value();
        $eloquentArticle->title = $article->title()->value();
        $eloquentArticle->description = $article->description()->value();
        $eloquentArticle->body = $article->body()->value();
        $eloquentArticle->created_at = $article->id()->value();
        $eloquentArticle->updated_at = $article->id()->value();
        $eloquentArticle->favourited = $article->favourited()->value();
        $eloquentArticle->favorites_count = $article->favoritesCount()->value();

        $eloquentArticle->save();
    }
}
