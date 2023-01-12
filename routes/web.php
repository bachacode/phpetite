<?php

use App\Controllers\IndexController;
use Petite\Routing\Router;
use App\Controllers\AboutController;


$app = new Router;

$app->get('/', function () { 
    $controller = new IndexController;
    $view = $controller->index();
    require $view;
});

$app->get('/about', function () { 
    $controller = new AboutController;
    $view = $controller->index();
    require $view;
});
