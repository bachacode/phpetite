<?php

require_once dirname(__DIR__) . '/app/Controllers/IndexController.php';
use App\Controllers\IndexController;
use Petite\Routing\Router;
use App\Controllers\AboutController;
use App\Controllers\ContactController;
use App\Controllers\UserController;

$router = new Router;

$router->createMultipleRoutes(
    [
        IndexController::class,
        AboutController::class,
        ContactController::class,
        UserController::class
    ]
);

$router->get('/test', function(){
        echo 'hola';
        return 1;
    });


