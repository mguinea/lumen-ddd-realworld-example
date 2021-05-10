<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

use App\Shared\Domain\ValueObject\EmailValueObject;
use App\Shared\Domain\ValueObject\NotValidValueObjectException;

final class UserEmail extends EmailValueObject
{
    public function __construct(string $value)
    {
        if (true === empty($value)) {
            throw new NotValidValueObjectException('email', "can't be empty");
        }

        parent::__construct($value);
    }
}
