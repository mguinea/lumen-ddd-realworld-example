<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Lumen;

use App\Shared\Infrastructure\InfrastructureException;
use Throwable;

class CommandBusException extends InfrastructureException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "" === $message ? "Command bus exception" : $message;
        parent::__construct($message, $code, $previous);
    }
}
