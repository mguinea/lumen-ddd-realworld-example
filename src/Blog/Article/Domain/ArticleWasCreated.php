<?php

declare(strict_types=1);

namespace App\Blog\Article\Domain;

use App\Shared\Domain\Bus\Event\DomainEvent;

final class ArticleWasCreated extends DomainEvent
{
    public function __construct(string $aggregateId, string $eventId = null, string $occurredOn = null)
    {
        parent::__construct($eventId, $occurredOn);
        $this->aggregateId = $aggregateId;
    }

    public static function fromArticle(Article $article): self
    {
        return new self();
    }

    public function fromPrimitives(string $aggregateId, array $body, string $eventId, string $occurredOn): DomainEvent
    {
        // TODO: Implement fromPrimitives() method.
    }

    public function eventName(): string
    {
        return 'blog.article_was_created';
    }

    public function toPrimitives(): array
    {
        // TODO: Implement toPrimitives() method.
    }
}
