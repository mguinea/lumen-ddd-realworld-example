<?php

declare(strict_types=1);

namespace App\Blog\Article\Domain;

use App\Blog\Shared\Domain\Tag\Tags;
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
        private ArticleFavoritesCount $favoritesCount,
        private Tags $tags
    ) {
    }

    public static function create(
        ArticleId $id,
        ArticleTitle $title,
        ArticleDescription $description,
        ArticleBody $body,
        Tags $tags
    ): self {
        $slug = ArticleSlug::fromTitle($title);

        $article = new self(
            $id,
            $slug,
            $title,
            $description,
            $body,
            ArticleCreatedAt::fromValue('now'),
            ArticleUpdatedAt::fromValue('now'),
            ArticleFavourited::fromValue(false),
            ArticleFavoritesCount::fromValue(0),
            $tags
        );

        $article->record(ArticleWasCreated::fromArticle($article));

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
        int $favoritesCount,
        array $tags
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
            ArticleFavoritesCount::fromValue($favoritesCount),
            Tags::create($tags)
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

    public function tags(): Tags
    {
        return $this->tags;
    }
}
