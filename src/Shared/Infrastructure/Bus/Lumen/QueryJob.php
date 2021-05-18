<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Lumen;

use App\Shared\Domain\Bus\Query\Query;
use App\Shared\Domain\Bus\Query\QueryHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class QueryJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private QueryHandler $handler;
    private Query $query;

    public function __construct(QueryHandler $handler, Query $query)
    {
        $this->handler = $handler;
        $this->query = $query;
    }

    public function handle()
    {
        return $this->handler->__invoke($this->query);
    }
}
