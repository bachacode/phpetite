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
<<<<<<< HEAD
      $response = $this->routes[$this->method][$this->path] ?? null;
      HttpNotFoundException::check($response);
=======
      $action = $this->routes[$this->method][$this->path] ?? null;
      HttpNotFoundException::check($action);
>>>>>>> b5f6943a48275ae845ebe639ac6b21e940f912af
    } catch (HttpNotFoundException $e) {
      http_response_code(404);
      echo $e->getMessage(), "\n";
    }
  }

<<<<<<< HEAD
  private function createRoute(string $method, string $uri, \Closure|array $response)
  {
    if(is_array($response))
    {
      $newResponse = $this->callMethodInClass($response);
      $this->routes[$method][$uri] = $newResponse;
    }else
    $this->routes[$method][$uri] = $response;
=======
  private function createRoute(string $method, string $uri, \Closure|array $action)
  {
    if(is_array($action))
    {
      $fn = $this->callMethodInClass($action);
      $this->routes[$method][$uri] = $fn;
    }else
    $this->routes[$method][$uri] = $action;
>>>>>>> b5f6943a48275ae845ebe639ac6b21e940f912af
  }

  private function callMethodInClass(array $array): \Closure 
  {
    return function() use ($array){
      $class = $array[0];
      $method = $array[1];
      $controller = new $class;
      $controller->$method();
    };
  }

<<<<<<< HEAD
  public function get(string $uri, \Closure|array $response): void
  {
    $this->createRoute("GET", $uri, $response);
  }

  public function post(string $uri, \Closure|array $response): void
  {
    $this->createRoute("POST", $uri, $response);
  }

  public function put(string $uri, \Closure|array $response): void
  {
    $this->createRoute("PUT", $uri, $response);
  }

  public function patch(string $uri, \Closure|array $response): void
  {
    $this->createRoute("PATCH", $uri, $response);
  }

  public function delete(string $uri, \Closure|array $response): void
  {
    $this->createRoute("DELETE", $uri, $response);
=======
  public function get(string $uri, \Closure|array $action): void
  {
    $this->createRoute("GET", $uri, $action);
  }

  public function post(string $uri, \Closure|array $action): void
  {
    $this->createRoute("POST", $uri, $action);
  }

  public function put(string $uri, \Closure|array $action): void
  {
    $this->createRoute("PUT", $uri, $action);
  }

  public function patch(string $uri, \Closure|array $action): void
  {
    $this->createRoute("PATCH", $uri, $action);
  }

  public function delete(string $uri, \Closure|array $action): void
  {
    $this->createRoute("DELETE", $uri, $action);
>>>>>>> b5f6943a48275ae845ebe639ac6b21e940f912af
  }

}