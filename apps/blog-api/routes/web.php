<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->group(
    [
        'namespace' => 'User',
        'prefix' => 'api/users'
    ],
    function (Router $router) {
        $router->post('login', ['as' => 'log_in', 'uses' => 'LogInUserController']);
        $router->post('/', ['as' => 'register_user', 'uses' => 'RegisterUserController']);
        $router->get('/{id}', ['as' => 'test', 'uses' => 'TestUserController']);
    }
);
