<?php

namespace Petite;

use Petite\Config\Config;
use Petite\Container\Container;
use Petite\Routing\Router;
use Petite\View\View;
use Petite\Database\DB;
use Petite\Http\Request;

class App
{
    private static DB $db;

    public function __construct(
        protected Container $container,
        protected Router $router,
        protected Config $config
    ) {
        static::$db = new DB($config->db ?? []);
    }

    public static function db(): DB
    {
        return static::$db;
    }

    public function run(): void
    {
        try {
            $request = new Request(
                uri: $_SERVER['REQUEST_URI'],
                method: $_SERVER['REQUEST_METHOD']
            );
            echo $this->router->resolve($request);
        } catch (\Petite\Http\HttpNotFoundException $e) {
            http_response_code(404);
            echo new View('errors/404', ['message' => $e->getMessage(), 'code' => $e->getCode()]);
        }
    }
}
