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
        $router->put('/', ['as' => 'update_user', 'uses' => 'UpdateUserController']);
    }
);

$router->group(
    [
        'namespace' => 'Article',
        'prefix' => 'api/articles'
    ],
    function (Router $router) {
        $router->get('/', ['as' => 'search_articles', 'uses' => 'SearchArticlesController']);
        $router->get('{slug}', ['as' => 'get_article_by_slug', 'uses' => 'GetArticleBySlugController']);
    }
);

$router->group(
    [
        'namespace' => 'Article',
        'prefix' => 'api/articles',
        //'middleware' => 'auth'
    ],
    function (Router $router) {
        $router->post('/', ['as' => 'create_article', 'uses' => 'CreateArticleController']);
    }
);

$router->group(
    [
        'namespace' => 'Tag',
        'prefix' => 'api/tags'
    ],
    function (Router $router) {
        $router->get('/', ['as' => 'list_tags', 'uses' => 'ListTagsController']);
    }
);
