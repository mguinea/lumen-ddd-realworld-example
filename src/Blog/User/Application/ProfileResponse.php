<?php

declare(strict_types=1);

namespace App\Blog\User\Application;

final class ProfileResponse extends UserResponse
{
    public function toArray(): array
    {
        return [
            'profile' => [
                'username' => $this->username(),
                'bio' => $this->bio(),
                'image' => $this->image(),
                'following' => $this->following()
            ]
        ];
    }
}
