<?php

class Router
{
    public $routes = [];
    protected $uri;
    protected $method;

    public function __construct()
    {
        $this->uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');
        $this->method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
    }

    public function match()
    {
        $matches = false;
        foreach ($this->routes as $route) {
            if (($route['uri'] === $this->uri) && ($route['method'] === strtoupper($this->method))) {
                require_once CONTROLLERS . "/{$route['controller']}";
                $matches = true;
                break;
            }

        }
        if (!$matches) {
            abort(404);
        }
    }

    private function addRoute($uri, $controller, $method)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function get($uri, $controller)
    {
        $this->addRoute($uri, $controller, 'GET');
    }

    public function post($uri, $controller)
    {
        $this->addRoute($uri, $controller, 'POST');
    }
}