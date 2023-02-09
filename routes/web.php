<?php

require_once dirname(__DIR__) . '/app/Controllers/IndexController.php';
use App\Controllers\IndexController;
use Petite\Routing\Router;
use App\Controllers\AboutController;
use App\Controllers\ContactController;
use App\Controllers\UserController;
use Petite\Container\Container;

$container = new Container();
$router = new Router($container);

$namespace = "App\\Controllers";
$dir = dirname(__DIR__) . '/app/Controllers/';
$router->autowireRoutes($namespace, $dir);

// $router->createMultipleRoutes(
//     [
//         IndexController::class,
//         AboutController::class,
//         ContactController::class,
//         UserController::class
//     ]
// );

// $router->get('/route', fn() => 'response');
