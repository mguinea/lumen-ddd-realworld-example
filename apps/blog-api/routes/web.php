<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->get(
    '/',
    function () use ($router) {
        return $router->app->version();
    }
);

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
