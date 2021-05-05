<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use Ramsey\Uuid\Uuid as RamseyUuid;

class UuidValueObject extends StringValueObject
{
    public static function create()
    {
        return new static(RamseyUuid::uuid4()->toString());
    }
}
