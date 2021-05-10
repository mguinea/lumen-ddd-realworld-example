<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

use App\Shared\Domain\ValueObject\NotValidValueObjectException;
use App\Shared\Domain\ValueObject\StringValueObject;

final class UserPassword extends StringValueObject
{
    public function __construct(string $value)
    {
        if (true === empty($value)) {
            throw new NotValidValueObjectException('password', "can't be empty");
        }

        parent::__construct($value);
    }
}
