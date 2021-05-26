<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

use App\Shared\Domain\DomainException;

final class TokenExpired extends DomainException
{

}
