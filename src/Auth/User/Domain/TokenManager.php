<?php

namespace App\Auth\User\Domain;

interface TokenManager
{
    public function encode(array $payload): string;

    public function decode(string $token): ?array;
}
