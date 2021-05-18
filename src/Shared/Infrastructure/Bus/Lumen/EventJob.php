<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Lumen;

use App\Shared\Domain\Bus\Event\DomainEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class EventJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $listener;
    private DomainEvent $event;

    public function __construct($listener, DomainEvent $event)
    {
        $this->listener = $listener;
        $this->event = $event;
    }

    public function handle()
    {
        return $this->listener->handle($this->event);
    }
}
