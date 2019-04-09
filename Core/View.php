<?php


namespace Core;


class View
{

    /**
     * @param $view
     * @param array $args
     * @throws \Exception
     * Рендерим вьюхи
     */
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);
        $file = dirname(__DIR__) . "/App/Views/$view";
        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file не был найден!");
        }
    }

}