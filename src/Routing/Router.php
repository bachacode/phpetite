<?php

namespace Petite\Routing;

use Petite\Http\HttpNotFoundException;

class Router
{
  private array $routes;
  readonly array $uri;
  readonly string $method;
  readonly string $path;
  readonly array $params;

  public function __construct()
  {
    $this->uri = parse_url($_SERVER['REQUEST_URI']);
    $this->setPath($this->uri['path']);
    if(isset($this->uri['query'])){
      $this->setParams($this->uri['query']);
    }
    $this->setHttpMethod($_SERVER['REQUEST_METHOD']);
  }

  public function setPath(string $uri): void
  {
    if(strlen($uri) != 1){
      $uri = rtrim($uri, "/");
    }
    $this->path = $uri;
  }

  public function getRoutes(): array
  {
    return $this->routes;
  }

  public function setParams(mixed $params)
  {
    $this->params = explode('&', $params);
    print_r($this->params);
  }
  
  public function setHttpMethod(string $method): void
  {
    $this->method = $method;
  }

  public function resolve()
  {
    try {
      $action = $this->routes[$this->method][$this->path] ?? null;
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
    $controller->$method();
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