<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use DateTimeImmutable;
use DateTimeZone;
use Exception;

abstract class DateTimeValueObject extends DateTimeImmutable
{
    /**
     * @throws Exception
     */
    public static function fromValue(string $datetime = "now", DateTimeZone $timezone = null): static
    {
        return new static($datetime, $timezone);
    }

    public function value(): string
    {
        return $this->format('Y-m-d H:i:s');
    }
}
