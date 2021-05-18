<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->group(
    [
        'namespace' => 'Auth',
        'prefix' => 'api/users'
    ],
    function (Router $router) {
        $router->post('login', ['as' => 'log_in', 'uses' => 'UserLogInController']);
    }
);

$router->group(
    [
        'namespace' => 'User',
        'prefix' => 'api/users'
    ],
    function (Router $router) {
        $router->post('/', ['as' => 'register_user', 'uses' => 'RegisterUserController']);
    }
);
/*
$router->group(
    [
        'namespace' => 'User',
        'prefix' => 'api/user'
    ],
    function (Router $router) {
        $router->put('/', ['as' => 'update_user', 'uses' => 'UpdateUserController']);
        $router->get('/{id}', ['as' => 'get_current_user', 'uses' => 'GetCurrentUserController']);
    }
);

$router->group(
    [
        'namespace' => 'User',
        'prefix' => 'api/profiles'
    ],
    function (Router $router) {
        $router->get('/{username}', ['as' => 'get_user_profile', 'uses' => 'GetUserProfileController']);
        $router->post('/{username}/follow', ['as' => 'follow_user', 'uses' => 'FollowUserController']);
        $router->delete('/{username}/follow', ['as' => 'unfollow_user', 'uses' => 'UnfollowUserController']);
    }
);
//*/
