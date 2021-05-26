<?php

declare(strict_types=1);

namespace App\Auth\User\Application;

use App\Auth\User\Domain\InvalidToken;
use App\Auth\User\Domain\TokenExpired;
use App\Auth\User\Domain\TokenManager;
use App\Shared\Domain\Bus\Query\QueryHandler;
use DateTimeImmutable;

final class TokenValidationQueryHandler implements QueryHandler
{
    public function __construct(private TokenManager $tokenManager)
    {
    }

    public function __invoke(TokenValidationQuery $query): TokenResponse
    {
        $token = $this->tokenManager->decode($query->token());

        if (null === $token) {
            throw new InvalidToken("Invalid token");
        }

        if (new DateTimeImmutable('now') > new DateTimeImmutable($token['expires'])) {
            throw new TokenExpired("Token expired");
        }

        return TokenResponse::fromArray($token);
    }
}
