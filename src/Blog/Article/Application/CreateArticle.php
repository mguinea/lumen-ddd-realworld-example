<?php

declare(strict_types=1);

namespace App\Blog\Article\Application;

use App\Blog\Article\Domain\Article;
use App\Blog\Article\Domain\ArticleBody;
use App\Blog\Article\Domain\ArticleDescription;
use App\Blog\Article\Domain\ArticleId;
use App\Blog\Article\Domain\ArticleRepository;
use App\Blog\Article\Domain\ArticleTitle;
use App\Blog\Shared\Domain\Tag\Tags;
use App\Shared\Domain\Bus\Event\EventBus;

final class CreateArticle
{
    public function __construct(
        private ArticleRepository $repository,
        private EventBus $eventBus
    ) {
    }

    public function __invoke(
        ArticleId $id,
        ArticleTitle $title,
        ArticleDescription $description,
        ArticleBody $body,
        Tags $tagList
    ): void {
        $article = Article::create(
            $id,
            $title,
            $description,
            $body,
            $tagList
        );

        $this->repository->save($article);
        $this->eventBus->publish(...$article->pullDomainEvents());
    }
}
