<?php

declare(strict_types=1);

namespace App\Blog\Article\Application;

use App\Blog\Article\Domain\Article;
use App\Shared\Domain\Bus\Query\Response;

final class GetArticleBySlugQueryResponse implements Response
{
    public function __construct(
        private string $slug,
        private string $title,
        private string $description,
        private string $body,
        private string $createdAt,
        private string $updatedAt,
        private bool $favourited,
        private int $favoritesCount
    ) {
    }

    public static function fromArticle(Article $article): self
    {
        return new self(
            $article->slug()->value(),
            $article->title()->value(),
            $article->description()->value(),
            $article->body()->value(),
            $article->createdAt()->value(),
            $article->updatedAt()->value(),
            $article->favourited()->value(),
            $article->favoritesCount()->value()
        );
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function body(): string
    {
        return $this->body;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }

    public function updatedAt(): string
    {
        return $this->updatedAt;
    }

    public function favourited(): bool
    {
        return $this->favourited;
    }

    public function favoritesCount(): int
    {
        return $this->favoritesCount;
    }

    public function toArray(): array
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'description' => $this->description,
            'body' => $this->body,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'favourited' => $this->favourited,
            'favoritesCount' => $this->favoritesCount
        ];
    }
}
