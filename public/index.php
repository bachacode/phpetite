<?php

declare(strict_types=1);

use Petite\App;
use Petite\Config\Config;

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/routes/web.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$dotenv->required(['DB_CONNECTION','DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS']);

define('VIEW_PATH', dirname(__DIR__) . '/app/Views/');
define('LAYOUT_PATH', dirname(__DIR__) . '/app/Views/layouts/');

(new App($container, $router, new Config($_ENV)))->run();
