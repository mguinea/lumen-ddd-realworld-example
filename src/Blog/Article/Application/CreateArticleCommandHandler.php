<?php

declare(strict_types=1);

namespace App\Blog\Article\Application;

use App\Blog\Article\Domain\Article;
use App\Blog\Article\Domain\ArticleId;
use App\Blog\Article\Domain\ArticleRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Shared\Domain\Bus\Event\EventBus;

final class CreateArticleCommandHandler implements CommandHandler
{
    public function __construct(
        private ArticleRepository $repository,
        private EventBus $eventBus
    )
    {
    }

    public function __invoke(CreateArticleCommand $command): void
    {
        $article = Article::create(
            ArticleId::fromValue($command->id()),
        );

        $this->repository->save($article);
        $this->eventBus->publish(...$article->pullDomainEvents());
    }
}
