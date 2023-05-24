<?php

namespace App;

class Router
{
    protected $routes = [];

    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
        ];
    }

    public function get($uri, $controller)
    {
        $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        $this->add('PATCH', $uri, $controller);
    }

    public function route($uri, $method)
    {
        $urlFound = false;
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri) {
                if ($route['method'] === strtoupper($method)) {
                    return require basePath($route['controller']);
                } else {
                    $urlFound = true;
                }
            }
        }

        if ($urlFound) {
            error("La méthode HTTP utilisée n'est pas correcte.", 405);
        } else {
            error("La page n'a pas été trouvée.", 404);
        }
    }
}
