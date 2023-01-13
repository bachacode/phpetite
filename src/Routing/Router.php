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
      $response = $this->routes[$this->method][$this->path] ?? null;
      HttpNotFoundException::check($response);
    } catch (HttpNotFoundException $e) {
      http_response_code(404);
      echo $e->getMessage(), "\n";
    }
  }

  private function createRoute(string $method, string $uri, \Closure|array $response)
  {
    if(is_array($response))
    {
      $newResponse = $this->callMethodInClass($response);
      $this->routes[$method][$uri] = $newResponse;
    }else
    $this->routes[$method][$uri] = $response;
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
  }

}