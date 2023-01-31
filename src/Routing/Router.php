<?php

namespace Petite\Routing;

use Petite\Http\HttpNotFoundException;
use Petite\Http\Request;

class Router
{
  private array $routes;
  readonly Request $request;

  public function __construct()
  {
    $this->request = new Request();
  }

  public function getRoutes(): array
  {
    return $this->routes;
  }

  public function resolve()
  {
    try {
      $action = $this->routes[$this->request->method][$this->request->path] ?? null;
      HttpNotFoundException::check($action);
      if (is_array($action)) {
        $this->callMethodInClass($action);
      }
    } catch (HttpNotFoundException $e) {
      http_response_code(404);
      echo $e->getMessage(), "\n";
    }
  }

  /**
   * Accepts an array of controllers classes to create multiple routes based on the attribute Route above the methods of the controller
   * @param array $controllers array of controller classes
   */

  public function createMultipleRoutes(array $controllers)
  {
    foreach($controllers as $controller)
    {
      $reflectionController = new \ReflectionClass($controller);
      foreach($reflectionController->getMethods() as $method)
      {
        $attributes = $method->getAttributes(Route::class);
        foreach ($attributes as $attribute)
        {
          $route = $attribute->newInstance();
          $this->createRoute($route->method, $route->uri, [$controller, $method->getName()]);
        }
      }
    }
  }

  private function createRoute(string $method = 'GET', string $uri, \Closure|array $action): self
  {
    $this->routes[$method][$uri] = $action;
    return $this;
  }

  private function callMethodInClass(array $array): void
  {
    $class = $array[0];
    $method = $array[1];
    $controller = new $class;
    echo $controller->$method();
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