<?php

use App\Blog\User\Application\CreateAuthUserListener;

return [
    'subscribers' => [
        CreateAuthUserListener::class => 'arn:aws:sns:eu-west-1:314899976907:user_created'
    ]
];
