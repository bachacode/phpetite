<?php

namespace Petite;

use Petite\Config\Config;
use Petite\Routing\Router;
use Petite\View\View;
use Petite\Database\DB;

class App
{
    static private DB $db;

    public function __construct(
        protected Router $router,
        protected Config $config
    )
    {
        static::$db = new DB($config->db ?? []);
    }

    public static function db(): DB
    {
        return static::$db;
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Petite\Http\HttpNotFoundException $e) {
            http_response_code(404);
            echo View::make('errors/404', ['message' =>$e->getMessage(), 'code' => $e->getCode()]);
        }
    }
}