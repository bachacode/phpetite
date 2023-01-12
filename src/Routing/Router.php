<?php

declare(strict_types=1);
namespace Petite\Routing;


use Petite\Http\Request;
use Petite\Http\HttpNotFoundException;


class Router
{
  public array $routes;
  private array $uri;
  private string $method;
  private string $path;

  public function __construct()
  {
    $this->uri = parse_url($_SERVER['REQUEST_URI']);
    $this->setPath($this->uri['path']);
    $this->setHttpMethod($_SERVER['REQUEST_METHOD']);
  }

  public function setPath(string $uri): void
  {
    $this->path = $uri;
  }
  
  public function setHttpMethod(string $method): void
  {
    $this->method = $method;
  }

  public function run() {

    $action = $this->routes[$this->method][$this->path];
    if (is_null($action)) {
        throw new HttpNotFoundException();
    }

    if ($action && is_callable($action)) {
      $action();
    }
  }

  private function match(string $method, string $uri, mixed $action)
  {
    $this->routes[$method][$uri] = $action;
  }

  public function view(array $array): callable 
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
      $fn = $this->view($action);
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