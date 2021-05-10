<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->group(
    [
        'namespace' => 'Auth',
        'prefix' => 'api/users'
    ],
    function (Router $router) {
        $router->post('login', ['as' => 'login', 'uses' => 'LoginController']);
        $router->post('/', ['as' => 'register', 'uses' => 'RegisterController']);
    }
);
