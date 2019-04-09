<?php


namespace Core;


class Router
{

    /**
     * @var array $routes
     * Роут
     */
    protected $routes = [];

    /**
     * @var array $params
     * Параметры
     */
    protected $params = [];

    /**
     * @param $route
     * @param array $params
     * Добавляем роуты, ругелярками
     */
    public function add($route, $params = [])
    {
        $route = preg_replace('/\//', '\\/', $route);
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        $route = '/^' . $route . '$/i';
        $this->routes[$route] = $params;
    }

    /**
     * @return array
     * Возвращает роут
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @param $url
     * @return bool
     *
     */
    public function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                if($this->getRequestMethod() === 'POST') {
                    $this->params['POST'] = $_POST;
                }
                return true;
            }
        }
        return false;
    }

    /**
     * @return array
     * Возвращает параметры
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param $url
     * @throws \Exception
     * Проверки на существование контроллеров и методов
     */
    public function dispatch($url)
    {
        $url = $this->removeQueryStringVariables($url);
        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
            $controller = $this->getNamespace() . $controller;
            if (class_exists($controller)) {
                $request_method = $this->getRequestMethod();
                $controller_object = new $controller($this->params, $request_method);
                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);
                if (preg_match('/action$/i', $action) == 0) {
                    $controller_object->$action();
                } else {
                    throw new \Exception("Метод $action в контроллере $controller не может быть вызван - удалите суффикс Action для вызова!");
                }
            } else {
                throw new \Exception("Контроллер $controller не найден!");
            }
        } else {
            throw new \Exception('Не найдено такого роута.', 404);
        }
    }

    /**
     * @param $string
     * @return mixed
     * Конвертер
     */
    protected function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
     * @param $string
     * @return string
     * Конвертер
     */
    protected function convertToCamelCase($string)
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    /**
     * @param $url
     * @return string
     *
     * URL                           $_SERVER['QUERY_STRING']  Route
     * -------------------------------------------------------------------
     * localhost                     ''                        ''
     * localhost/?                   ''                        ''
     * localhost/?page=1             page=1                    ''
     * localhost/posts?page=1        posts&page=1              posts
     * localhost/posts/index         posts/index               posts/index
     * localhost/posts/index?page=1  posts/index&page=1        posts/index
     */
    protected function removeQueryStringVariables($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);
            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        return $url;
    }

    /**
     * @return string
     * Возвращает неймспейс
     */
    protected function getNamespace()
    {
        $namespace = 'App\Controllers\\';
        if (array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }
        return $namespace;
    }

    /**
     * @return mixed
     * Возвращает метод [post, get, delete, put]
     */
    protected function getRequestMethod()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        return $method;
    }

}