<?php

declare(strict_types=1);

namespace App\Auth\User\Infrastructure;

use App\Auth\User\Domain\TokenManager;
use Firebase\JWT\JWT;

final class FirebaseTokenManager implements TokenManager
{
    public function encode(array $payload): string
    {
        $privateKey = env('APP_KEY');

        return JWT::encode($payload, $privateKey, 'HS256');
    }

    public function decode(string $token): array
    {
        $publicKey = env('APP_KEY');
        $decoded = JWT::decode($token, $publicKey, ['HS256']);

        return (array)$decoded;
    }
}
