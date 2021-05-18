<?php

use App\Blog\User\Domain\UserWasCreated;

return [
    'sns'    => [
        'key'    => env('PUBLISHER_SNS_KEY'),
        'secret' => env('PUBLISHER_SNS_SECRET'),
        'region' => env('PUBLISHER_SNS_REGION'),
    ],
    'events' => [
        UserWasCreated::class
    ]
];
