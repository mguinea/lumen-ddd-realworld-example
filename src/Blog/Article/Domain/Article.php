<?php

declare(strict_types=1);

namespace App\Blog\Article\Domain;

use App\Shared\Domain\AggregateRoot;

final class Article extends AggregateRoot
{
    public function __construct(
        private ArticleId $id,
        private ArticleSlug $slug,
        private ArticleTitle $title,
        private ArticleDescription $description,
        private ArticleBody $body,
        private ArticleCreatedAt $createdAt,
        private ArticleUpdatedAt $updatedAt,
        private ArticleFavourited $favourited,
        private ArticleFavoritesCount $favoritesCount
    ) {
    }

    public static function create(
        ArticleId $id,
        ArticleSlug $slug,
        ArticleTitle $title,
        ArticleDescription $description,
        ArticleBody $body,
        ArticleCreatedAt $createdAt,
        ArticleUpdatedAt $updatedAt,
        ArticleFavourited $favourited,
        ArticleFavoritesCount $favoritesCount
    ): self {
        $article = new self(
            $id,
            $slug,
            $title,
            $description,
            $body,
            $createdAt,
            $updatedAt,
            $favourited,
            $favoritesCount
        );

        // $article->record(ArticleWasCreated::fromArticle($article));

        return $article;
    }

    public static function fromPrimitives(
        string $id,
        string $slug,
        string $title,
        string $description,
        string $body,
        string $createdAt,
        string $updatedAt,
        bool $favourited,
        int $favoritesCount
    ): self {
        return new self(
            ArticleId::fromValue($id),
            ArticleSlug::fromValue($slug),
            ArticleTitle::fromValue($title),
            ArticleDescription::fromValue($description),
            ArticleBody::fromValue($body),
            ArticleCreatedAt::fromValue($createdAt),
            ArticleUpdatedAt::fromValue($updatedAt),
            ArticleFavourited::fromValue($favourited),
            ArticleFavoritesCount::fromValue($favoritesCount)
        );
    }

    public function id(): ArticleId
    {
        return $this->id;
    }

    public function slug(): ArticleSlug
    {
        return $this->slug;
    }

    public function title(): ArticleTitle
    {
        return $this->title;
    }

    public function description(): ArticleDescription
    {
        return $this->description;
    }

    public function body(): ArticleBody
    {
        return $this->body;
    }

    public function createdAt(): ArticleCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): ArticleUpdatedAt
    {
        return $this->updatedAt;
    }

    public function favourited(): ArticleFavourited
    {
        return $this->favourited;
    }

    public function favoritesCount(): ArticleFavoritesCount
    {
        return $this->favoritesCount;
    }
}
