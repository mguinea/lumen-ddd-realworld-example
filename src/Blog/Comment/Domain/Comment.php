<?php

declare(strict_types=1);

namespace App\Blog\Comment\Domain;

use App\Blog\Shared\Domain\User\User;

final class Comment
{
    private CommentId $id;
    private CommentBody $body;
    private User $author;
    private CommentCreatedAt $createdAt;
    private CommentUpdatedAt $updatedAt;

    public function __construct(
        CommentId $id,
        CommentBody $body,
        User $author,
        CommentCreatedAt $createdAt,
        CommentUpdatedAt $updatedAt
    ) {
        $this->id = $id;
        $this->body = $body;
        $this->author = $author;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function id(): CommentId
    {
        return $this->id;
    }

    public function body(): CommentBody
    {
        return $this->body;
    }

    public function author(): User
    {
        return $this->author;
    }

    public function createdAt(): CommentCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): CommentUpdatedAt
    {
        return $this->updatedAt;
    }
}
