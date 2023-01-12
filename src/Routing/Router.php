<?php

declare(strict_types=1);
namespace Petite\Routing;


use Petite\Http\Request;
use Petite\Http\HttpNotFoundException;


class Router
{
  private array $routes;
  private array $uri;
  private string $method;
  private string $path;

  public function __construct()
  {
    $this->uri = parse_url($_SERVER['REQUEST_URI']);
    $this->setPath();
    $this->setHttp();
  }

  public function setPath(): void
  {
    $this->path = $this->uri['path'];
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

  public function setHttp(): void
  {
    $method = $_SERVER['REQUEST_METHOD'];
    $this->method = $method;
  }

  private function match(string $method, string $uri, mixed $action)
  {
    $this->routes[$method][$uri] = $action;
  }

  public function get(string $uri, callable $action): void
  {
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