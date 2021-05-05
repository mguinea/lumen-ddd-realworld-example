<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

abstract class BooleanValueObject
{
    protected bool $value;

    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    public static function fromValue(bool $value): static
    {
        return new static($value);
    }

    public function value(): bool
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }
}