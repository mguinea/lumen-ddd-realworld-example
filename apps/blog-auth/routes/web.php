<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->group(
    [
        'namespace' => 'Auth',
        'prefix' => 'api/auth/users'
    ],
    function (Router $router) {
        $router->post('login', ['as' => 'log_in', 'uses' => 'UserLogInController']);
        $router->post('/', ['as' => 'register', 'uses' => 'RegisterUserController']);
    }
);
