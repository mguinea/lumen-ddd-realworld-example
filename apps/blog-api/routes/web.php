<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->group(
    [
        'namespace' => 'User',
        'prefix' => 'api/users'
    ],
    function (Router $router) {
        $router->post('/', ['as' => 'register_user', 'uses' => 'RegisterUserController']);
        $router->post('login', ['as' => 'log_in', 'uses' => 'LogInUserController']);
    }
);

$router->group(
    [
        'namespace' => 'User',
        'prefix' => 'api/user',
        'middleware' => 'auth'
    ],
    function (Router $router) {
        $router->get('/', ['as' => 'get_current_user', 'uses' => 'GetCurrentUserController']);
        //$router->put('login', ['as' => 'upadte_user', 'uses' => 'LogInUserController']);
    }
);
