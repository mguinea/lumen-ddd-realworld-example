<?php

declare(strict_types=1);

namespace App\Blog\Article\Domain;

use App\Shared\Domain\Criteria\Criteria;

interface ArticleRepository
{
    public function find(ArticleId $id): ?Article;

    public function findBySlug(ArticleSlug $slug): ?Article;

    public function save(Article $article): void;

    public function search(Criteria $criteria): array;
}
