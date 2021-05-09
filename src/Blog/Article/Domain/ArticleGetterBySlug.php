<?php

declare(strict_types=1);

namespace App\Blog\Article\Domain;

class ArticleGetterBySlug
{
    private ArticleRepository $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ArticleSlug $slug): Article
    {
        // TODO: Implement __invoke() method.
    }
}
