<?php

declare(strict_types=1);

namespace Tests\Auth\User\Domain;

use App\Auth\User\Domain\UserToken;
use Faker\Factory;
use Tests\Shared\Domain\Builder;

final class UserTokenBuilder implements Builder
{
    private string $value;

    public function __construct()
    {
        $this->value = Factory::create()->ean8;
    }

    public function withValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function build(): UserToken
    {
        return new UserToken($this->value);
    }
}
