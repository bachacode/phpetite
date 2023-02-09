<?php

namespace Petite\Routing;

use Petite\Container\Container;
use Petite\Http\HttpNotFoundException;
use Petite\Http\Request;

class Router
{
    private array $routes = [];

    public function __construct(
        private Container $container
    ) {
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function resolve(Request $request): mixed
    {
        $action = $this->routes[$request->method][$request->path] ?? null;
        if ($action == null) {
            throw new HttpNotFoundException('Not Found', 404);
        }
        if (is_callable($action)) {
            return call_user_func($action);
        }
        if (is_array($action)) {
            return $this->callMethodInClass($action);
        }
        throw new HttpNotFoundException('Not Found', 404);
    }

    /**
     * Accepts an array of controllers classes to create multiple routes
     * based on the attribute Route above the methods of the controller
     * @param array<int, string> $controllers array of controller classes
     */

    public function createMultipleRoutes(array $controllers): void
    {
        foreach ($controllers as $controller) {
            $reflectionController = new \ReflectionClass($controller);
            foreach ($reflectionController->getMethods() as $method) {
                $attributes = $method->getAttributes(Route::class);
                foreach ($attributes as $attribute) {
                    $route = $attribute->newInstance();
                    $this->createRoute($route->method, $route->uri, [$controller, $method->getName()]);
                }
            }
        }
    }

    private function createRoute(string $method, string $uri, \Closure|array $action): self
    {
        $this->routes[$method][$uri] = $action;
        return $this;
    }

    private function callMethodInClass(array $action): mixed
    {
        [$class, $method] = $action;
        if (class_exists($class)) {
            $controller = $this->container->get($class);
            if (method_exists($class, $method)) {
                return call_user_func_array([$controller, $method], []);
            }
        }
        return 0;
    }

    public function get(string $uri, \Closure|array $action): self
    {
        return $this->createRoute("GET", $uri, $action);
    }

    public function post(string $uri, \Closure|array $action): self
    {
        return $this->createRoute("POST", $uri, $action);
    }

    public function put(string $uri, \Closure|array $action): self
    {
        return $this->createRoute("PUT", $uri, $action);
    }

    public function patch(string $uri, \Closure|array $action): self
    {
        return $this->createRoute("PATCH", $uri, $action);
    }

    public function delete(string $uri, \Closure|array $action): self
    {
        return $this->createRoute("DELETE", $uri, $action);
    }
}
