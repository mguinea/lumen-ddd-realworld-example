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
        $router->post('/', ['as' => 'register_user', 'uses' => 'RegisterUserController']);
        $router->put('/', ['as' => 'update_user', 'uses' => 'UpdateUserController']);
    }
);

$router->group(
    [
        'namespace' => 'Auth',
        'prefix' => 'api/user'
    ],
    function (Router $router) {
        $router->get('/', ['as' => 'get_current_user', 'uses' => 'GetCurrentUserController']);
    }
);
