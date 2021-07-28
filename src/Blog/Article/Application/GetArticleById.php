<?php

declare(strict_types=1);

namespace App\Blog\Article\Application;

use App\Blog\Article\Domain\Article;
use App\Blog\Article\Domain\ArticleId;
use App\Blog\Article\Domain\ArticleNotFound;
use App\Blog\Article\Domain\ArticleRepository;

final class GetArticleById
{
    public function __construct(private ArticleRepository $repository)
    {
    }

    public function __invoke(ArticleId $id): Article
    {
        $article = $this->repository->find($id);

        if (null === $article) {
            throw new ArticleNotFound();
        }

        return $article;
    }
}
