<?php

return [
    \App\Blog\User\Domain\UserWasCreated::class => [
        \App\Blog\User\Application\CreateAuthUserListener::class
    ]
];
