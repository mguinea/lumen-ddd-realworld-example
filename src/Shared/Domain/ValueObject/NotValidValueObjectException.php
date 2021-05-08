<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use Throwable;

final class NotValidValueObjectException extends ValueObjectException
{
    private string $field;
    private array $errors;

    public function __construct(string $field, $message = "", $code = 0, Throwable $previous = null)
    {
        $this->field = $field;
        parent::__construct($message, $code, $previous);
    }

    public function field(): string
    {
        return $this->field;
    }
}
