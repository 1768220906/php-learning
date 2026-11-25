
<?php

require_once __DIR__ . "/exceptions/routeNotFoundException.php";

class Router
{
  private array $routes = [];

  public function get(string $path, callable $callback): void
  {
    $this->routes['GET'][$path] = $callback;
  }

  public function post(string $path, callable $callback): void
  {
    $this->routes['POST'][$path] = $callback;
  }

  public function dispatch(string $method, string $path): void
  {
    $callback = $this->routes[$method][$path] ?? null;

    if ($callback === null) {
      throw new RouteNotFoundException('接口不存在');
    }
    $callback();
  }
}
