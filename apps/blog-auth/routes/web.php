<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->group(
    [
        'namespace' => 'Auth',
        'prefix' => 'auth/api/users'
    ],
    function (Router $router) {
        $router->post('login', ['as' => 'log_in', 'uses' => 'LogInUserController']);
        $router->post('/', ['as' => 'register', 'uses' => 'RegisterUserController']);
    }
);
