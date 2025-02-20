<?php

namespace Kavlar\TestItSolutions\router;

class Router
{
    protected array $routes = [];
    protected string $requestUri;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
        $this->setRequestUri();
    }

    public function dispatch(): void
    {
        if (array_key_exists($this->requestUri, $this->routes)) {
            if ($_SERVER['REQUEST_METHOD'] == $this->routes[$this->requestUri]['method']) {
                $controller = new $this->routes[$this->requestUri]['handler'][0]();
                $method = $this->routes[$this->requestUri]['handler'][1];
                $controller->$method();
            }
        } else {
            // Если маршрут не найден, показываем 404
            header("HTTP/1.0 404 Not Found");
            //include BASE_PATH . '/views/404.php';
        }
    }

    protected function setRequestUri(): void
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $this->requestUri = strtok($requestUri, '?');
    }

}