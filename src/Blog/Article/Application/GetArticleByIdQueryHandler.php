<?php

declare(strict_types=1);

namespace App\Blog\Article\Application;

use App\Blog\Article\Domain\ArticleId;
use App\Shared\Domain\Bus\Query\QueryHandler;

final class GetArticleByIdQueryHandler implements QueryHandler
{
    public function __construct(private GetArticleById $getArticleById)
    {
    }

    public function __invoke(GetArticleByIdQuery $query): ArticleResponse
    {
        $id = ArticleId::fromValue($query->id());
        $article = $this->getArticleById->__invoke($id);

        return ArticleResponse::fromArticle($article);
    }
}
