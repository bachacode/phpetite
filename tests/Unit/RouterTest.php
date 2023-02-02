<?php

declare(strict_types=1);

namespace Test\Unit;

use App\Controllers\UserController;
use Petite\Routing\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    public function test_it_registers_a_get_route(): void
    {
        $router = new Router();

        $router->get('/users', [UserController::class, 'index']);

        $expected = [
            'GET' => [
                '/users' => [UserController::class, 'index']
            ]
        ];
        $this->assertEquals($expected, $router->getRoutes());
    }
}