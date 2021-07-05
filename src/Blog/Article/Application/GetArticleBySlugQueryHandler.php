<?php

declare(strict_types=1);

namespace App\Blog\Article\Application;

use App\Blog\Article\Domain\ArticleNotFound;
use App\Blog\Article\Domain\ArticleRepository;
use App\Blog\Article\Domain\ArticleSlug;
use App\Shared\Domain\Bus\Query\QueryHandler;

final class GetArticleBySlugQueryHandler implements QueryHandler
{
    public function __construct(private ArticleRepository $repository)
    {
    }

    public function __invoke(GetArticleBySlugQuery $query): GetArticleBySlugQueryResponse
    {
        $slug = ArticleSlug::fromValue($query->slug());
        $article = $this->repository->findBySlug($slug);

        if (null === $article) {
            throw new ArticleNotFound();
        }

        return GetArticleBySlugQueryResponse::fromArticle($article);
    }
}
