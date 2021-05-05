<?php

declare(strict_types=1);

namespace App\Blog\Article\Domain;

use App\Blog\Shared\Domain\User\User;
use App\Blog\Shared\Domain\Tag\Tags;

final class Article
{
    private ArticleId $id;
    private ArticleSlug $slug;
    private ArticleTitle $title;
    private ArticleDescription $description;
    private ArticleBody $body;
    private Tags $tags;
    private ArticleCreatedAt $createdAt;
    private ArticleUpdatedAt $updatedAt;
    private ArticleFavourited $favorited;
    private ArticleFavoritesCount $favoritesCount;
    private User $author;

    public function __construct(
        ArticleId $id,
        ArticleSlug $slug,
        ArticleTitle $title,
        ArticleDescription $description,
        ArticleBody $body,
        Tags $tags,
        ArticleCreatedAt $createdAt,
        ArticleUpdatedAt $updatedAt,
        ArticleFavourited $favorited,
        ArticleFavoritesCount $favoritesCount,
        User $author
    ) {
        $this->id = $id;
        $this->slug = $slug;
        $this->title = $title;
        $this->description = $description;
        $this->body = $body;
        $this->tags = $tags;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->favorited = $favorited;
        $this->favoritesCount = $favoritesCount;
        $this->author = $author;
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
    
    public function tags(): Tags
    {
        return $this->tags;
    }
    
    public function createdAt(): ArticleCreatedAt
    {
        return $this->createdAt;
    }
    
    public function updatedAt(): ArticleUpdatedAt
    {
        return $this->updatedAt;
    }
    
    public function favorited(): ArticleFavourited
    {
        return $this->favorited;
    }
    
    public function favoritesCount(): ArticleFavoritesCount
    {
        return $this->favoritesCount;
    }
    
    public function author(): User
    {
        return $this->author;
    }
}
