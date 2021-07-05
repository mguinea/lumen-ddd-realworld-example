<?php

declare(strict_types=1);

namespace App\Blog\Article\Domain;

interface ArticleRepository
{
    public function findBySlug(ArticleSlug $slug): ?Article;

    public function save(Article $article): void;
}
