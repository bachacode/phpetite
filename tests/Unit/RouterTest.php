<?php

declare(strict_types=1);

namespace Test\Unit;

use Petite\Routing\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    private Router $router;

    protected function setUp(): void
    {
        parent::setUp();
        $this->router = new Router();
    }

    public function testItCreatesGetRoute(): void
    {
        $this->router->get('/', [IndexController::class, 'index']);

        $expected = [
            'GET' => [
                '/' => [IndexController::class, 'index']
            ]
        ];
        $this->assertEquals($expected, $this->router->getRoutes());
    }

    public function testItCreatesPostRoute(): void
    {
        $this->router->post('/', [IndexController::class, 'index']);

        $expected = [
            'POST' => [
                '/' => [IndexController::class, 'index']
            ]
        ];
        $this->assertEquals($expected, $this->router->getRoutes());
    }

    public function testItCreatesPutRoute(): void
    {
        $this->router->put('/', [IndexController::class, 'index']);

        $expected = [
            'PUT' => [
                '/' => [IndexController::class, 'index']
            ]
        ];  
        $this->assertEquals($expected, $this->router->getRoutes());
    }

    public function testItCreatesPatchRoute(): void
    {
        $this->router->patch('/', [IndexController::class, 'index']);

        $expected = [
            'PATCH' => [
                '/' => [IndexController::class, 'index']
            ]
        ];
        $this->assertEquals($expected, $this->router->getRoutes());
    }

    public function testItCreatesDeleteRoute(): void
    {
        $this->router->delete('/', [IndexController::class, 'index']);

        $expected = [
            'DELETE' => [
                '/' => [IndexController::class, 'index']
            ]
        ];
        $this->assertEquals($expected, $this->router->getRoutes());
    }

    public function testItHasNoRoutesAtCreation()
    {
        $this->assertEmpty((new Router())->getRoutes());
    }
}