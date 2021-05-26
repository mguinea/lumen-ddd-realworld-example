<?php

declare(strict_types=1);

namespace Tests\Auth\User\Domain;

use App\Shared\Domain\User\UserId;
use Faker\Factory;
use Tests\Shared\Domain\Builder;

final class UserIdBuilder implements Builder
{
    private string $value;

    public function __construct()
    {
        $this->value = Factory::create()->uuid;
    }

    public function withValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function build(): UserId
    {
        return UserId::fromValue($this->value);
    }
}
