<?php

declare(strict_types=1);

namespace Tests\Blog\User\Domain;

use App\Blog\User\Domain\UserEmail;
use Faker\Factory;
use Tests\Shared\Domain\Builder;

final class UserEmailBuilder implements Builder
{
    private string $value;

    public function __construct()
    {
        $this->value = Factory::create()->email;
    }

    public function withValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function build(): UserEmail
    {
        return new UserEmail($this->value);
    }
}
