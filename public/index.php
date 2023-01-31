<?php

declare(strict_types=1);

use Petite\Testing;

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/routes/web.php';

define('VIEW_PATH', __DIR__ . '/../app/Views/');
define('LAYOUT_PATH', __DIR__ . '/../app/Views/layouts/');


try {
    $app->resolve();
} catch (\Petite\Http\HttpNotFoundException $e) {
    http_response_code(404);
    echo $e->getMessage(), "\n";
}






