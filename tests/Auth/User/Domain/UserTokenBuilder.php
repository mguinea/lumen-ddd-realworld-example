<?php

declare(strict_types=1);

namespace Tests\Auth\User\Domain;

use App\Shared\Domain\User\UserToken;
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
        return UserToken::fromValue($this->value);
    }
}
