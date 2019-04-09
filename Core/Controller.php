<?php


namespace Core;


class Controller
{

    /**
     * @var array $route_params
     * Параметры /?
     */
    protected $route_params = [];

    /**
     * @var string $request_method
     * Метод [post, get, delete, put], default GET
     */
    protected $request_method = 'GET';

    /**
     * Controller constructor.
     * @param $route_params
     */
    public function __construct($route_params, $request_method)
    {
        $this->route_params = $route_params;
        $this->request_method = $request_method;
    }

    /**
     * @param $name
     * @param $args
     * @throws \Exception
     * Вызываем метод контроллера (если таков есть)
     */
    public function __call($name, $args)
    {
        $method = $name . 'Action';
        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            throw new \Exception("Метод $method не найден в контроллере " . get_class($this));
        }
    }

    protected function before()
    {
    }

    protected function after()
    {
    }

}