<?php

declare(strict_types=1);

namespace App\Blog\Article\Application;

use App\Shared\Domain\Bus\Command\Command;

final class CreateArticleCommand implements Command
{
    public function __construct(
        private string $id,
        private string $title,
        private string $description,
        private string $body,
        private array $tagList
    )
    {
    }

    public function id(): string
    {
        return $this->id;
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

    public function tagList(): array
    {
        return $this->tagList;
    }
}
