<?php

declare(strict_types=1);

namespace App\Blog\Article\Application;

use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\Criteria\Filters;
use App\Shared\Domain\Criteria\Order;

final class SearchArticlesQueryHandler implements QueryHandler
{
    public function __construct(private SearchArticles $searcher)
    {
    }

    public function __invoke(SearchArticlesQuery $query): ArticlesResponse
    {
        $filters = Filters::fromValues($query->filters());
        $order = Order::fromValues($query->orderBy(), $query->order());

        return $this->searcher->__invoke($filters, $order, $query->limit(), $query->offset());
    }
}
