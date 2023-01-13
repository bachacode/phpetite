<?php

require_once dirname(__DIR__) . '/app/Controllers/IndexController.php';
use App\Controllers\IndexController;
use Petite\Routing\Router;
use App\Controllers\AboutController;
use App\Controllers\ContactController;
use Petite\Testing;

$app = new Router;

$app->get('/', [IndexController::class, 'index']);

$app->get('/about', [AboutController::class, 'index']);

$app->get('/test', function(){
    echo 'hola';
    return 1;
});

$app->resolve();
