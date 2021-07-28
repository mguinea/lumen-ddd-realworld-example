<?php

declare(strict_types=1);

namespace App\Blog\Article\Application;

use App\Blog\Article\Domain\Article;
use App\Blog\Article\Domain\ArticleRepository;
use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filters;
use App\Shared\Domain\Criteria\Order;

final class SearchArticles
{
    public function __construct(private ArticleRepository $repository)
    {
    }

    public function __invoke(Filters $filters, Order $order, ?int $limit, ?int $offset): ArticlesResponse
    {
        $criteria = new Criteria($filters, $order, $offset, $limit);
        $articles = $this->repository->search($criteria);

        return new ArticlesResponse(array_map($this->toResponse(), $articles));
    }

    public function toResponse(): callable
    {
        return static fn(Article $article) => new ArticleResponse(
            $article->id()
        );
    }
}
