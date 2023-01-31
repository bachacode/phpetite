<?php

require_once dirname(__DIR__) . '/app/Controllers/IndexController.php';
use App\Controllers\IndexController;
use Petite\Routing\Router;
use App\Controllers\AboutController;
use App\Controllers\ContactController;
use Petite\Testing;

$app = new Router;

$app->createMultipleRoutes(
    [
        IndexController::class,
        AboutController::class,
        ContactController::class,
    ]
);

$app->get('/test', function(){
        echo 'hola';
        return 1;
    });


