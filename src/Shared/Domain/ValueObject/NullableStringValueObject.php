<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

abstract class NullableStringValueObject
{
    protected ?string $value;

    public function __construct(?string $value)
    {
        $this->value = $value;
    }

    public static function fromValue(?string $value): static
    {
        return new static($value);
    }

    public function value(): ?string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
