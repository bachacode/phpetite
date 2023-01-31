<?php

declare(strict_types=1);

use Petite\Testing;

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/routes/web.php';

define('VIEW_PATH', __DIR__ . '/../app/Views/');

$app->resolve();
$routes = $app->getRoutes();






