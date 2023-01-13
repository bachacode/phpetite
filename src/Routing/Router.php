<?php

declare(strict_types=1);
namespace Petite\Routing;

use Petite\Http\HttpNotFoundException;

class Router
{
  private array $routes;
  private array $uri;
  private string $method;
  private string $path;
  private array $params;

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

  public function run()
  {
    $notFound = new HttpNotFoundException('Not Found', 404);
    try {
      $action = $this->routes[$this->method][$this->path] ?? null;
      $notFound->check($action);
    } catch (HttpNotFoundException $e) {
      http_response_code(404);
      echo $e->getMessage(), "\n";
    }
  }

  private function match(string $method, string $uri, mixed $action)
  {
    $this->routes[$method][$uri] = $action;
  }

  private function callMethodInClass(array $array): callable 
  {
    return function() use ($array){
      $class = $array[0];
      $method = $array[1];
      $controller = new $class;
      $controller->$method();
    };
  }

  public function get(string $uri, callable|array $action): void
  {
    if(is_array($action))
    {
      $fn = $this->callMethodInClass($action);
      $this->match("GET", $uri, $fn);
    }else
    $this->match("GET", $uri, $action);
  }

  public function post(string $uri, callable $action): void
  {
    $this->match("POST", $uri, $action);
  }

  public function put(string $uri, callable $action): void
  {
    $this->match("PUT", $uri, $action);
  }

  public function patch(string $uri, callable $action): void
  {
    $this->match("PATCH", $uri, $action);
  }

  public function delete(string $uri, callable $action): void
  {
    $this->match("DELETE", $uri, $action);
  }

}