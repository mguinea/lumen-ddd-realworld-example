<?php

declare(strict_types=1);

namespace App\Blog\Article\Application;

use App\Blog\Article\Domain\ArticleBody;
use App\Blog\Article\Domain\ArticleDescription;
use App\Blog\Article\Domain\ArticleId;
use App\Blog\Article\Domain\ArticleTitle;
use App\Blog\Shared\Domain\Tag\Tags;
use App\Shared\Domain\Bus\Command\CommandHandler;

final class CreateArticleCommandHandler implements CommandHandler
{
    public function __construct(private CreateArticle $createArticle)
    {
    }

    public function __invoke(CreateArticleCommand $command): void
    {
        $id = ArticleId::fromValue($command->id());
        $title = ArticleTitle::fromValue($command->title());
        $description = ArticleDescription::fromValue($command->description());
        $body = ArticleBody::fromValue($command->body());
        $tagList = Tags::create();

        $this->createArticle->__invoke(
            $id,
            $title,
            $description,
            $body,
            $tagList
        );
    }
}
