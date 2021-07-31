<?php

declare(strict_types=1);

namespace App\Blog\Comment\Domain;


use App\Shared\Domain\User\UserId;

final class Comment
{
    public function __construct(
        private CommentId $id,
        private CommentBody $body,
        private UserId $authorId,
        private CommentCreatedAt $createdAt,
        private CommentUpdatedAt $updatedAt
    ) {
    }

    public function id(): CommentId
    {
        return $this->id;
    }

    public function body(): CommentBody
    {
        return $this->body;
    }

    public function authorId(): UserId
    {
        return $this->authorId;
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
