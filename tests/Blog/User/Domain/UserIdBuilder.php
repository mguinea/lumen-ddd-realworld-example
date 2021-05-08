<?php

declare(strict_types=1);

namespace Tests\Blog\User\Domain;

use App\Blog\User\Domain\UserId;
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
        return new UserId($this->value);
    }
}
