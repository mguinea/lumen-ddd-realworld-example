<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Lumen;

use App\Shared\Domain\Bus\Command\Command;
use App\Shared\Domain\Bus\Command\CommandHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class CommandJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private CommandHandler $handler;
    private Command $command;

    public function __construct(CommandHandler $handler, Command $command)
    {
        $this->handler = $handler;
        $this->command = $command;
    }

    public function handle()
    {
        return $this->handler->__invoke($this->command);
    }
}
