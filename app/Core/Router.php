<?php
declare(strict_types=1);

namespace App\Core;

final class Router
{
    private array $routes = [];

    public function get(string $path, callable|array $handler): void
    {
        $this->routes[] = ['method' => 'GET', 'path' => $path, 'handler' => $handler];
    }

    public function post(string $path, callable|array $handler): void
    {
        $this->routes[] = ['method' => 'POST', 'path' => $path, 'handler' => $handler];
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = rtrim(parse_url($uri, PHP_URL_PATH) ?? '/', '/') ?: '/';

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method || $route['path'] !== $path) {
                continue;
            }

            $handler = $route['handler'];

            if (is_array($handler) && is_string($handler[0])) {
                $class = $handler[0];
                $instance = new $class();
                $handler = [$instance, $handler[1]];
            }

            $handler();

            return;
        }

        http_response_code(404);
        View::render('errors/404', [], 'layouts/main');
    }
}
