<?php

declare(strict_types=1);

namespace App\Shared\Domain\Bus\Event;

abstract class DomainEvent
{
    abstract public function getEventName(): string;

    abstract public function toPrimitives(): array;
}
