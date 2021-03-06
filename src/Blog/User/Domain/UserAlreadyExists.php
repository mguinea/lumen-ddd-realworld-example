<?php

declare(strict_types=1);

namespace App\Blog\User\Domain;

use App\Shared\Domain\DomainException;

final class UserAlreadyExists extends DomainException
{

}
