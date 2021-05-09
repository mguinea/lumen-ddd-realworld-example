<?php

declare(strict_types=1);

namespace App\Blog\Article\Application;

use App\Blog\Article\Domain\ArticleGetterBySlug;
use App\Blog\Article\Domain\ArticleSlug;

final class GetArticleBySlug
{
    private ArticleGetterBySlug $getter;

    public function __construct(ArticleGetterBySlug $getter)
    {
        $this->getter = $getter;
    }

    public function __invoke(string $slug): ArticleResponse
    {
        $slug = ArticleSlug::fromValue($slug);

        $article = $this->getter->__invoke($slug);

        return ArticleResponse::fromArticle($article);
    }
}
