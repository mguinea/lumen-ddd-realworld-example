<?php

declare(strict_types=1);

namespace App\Shared\Domain\User;

use App\Shared\Domain\ValueObject\NotValidValueObjectException;
use App\Shared\Domain\ValueObject\NullableStringValueObject;
use App\Shared\Domain\ValueObject\StringValueObject;

final class UserPassword extends NullableStringValueObject
{
}
