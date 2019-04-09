<?php

namespace App;

/**
 * Class Helper
 * @package App
 * Функции помощи
 */
class Helper
{

    /**
     * @param $tags
     * @return array[]|false|string[]
     * Возвращает распарсенные теги
     */
    public static function getTags($tags)
    {
        $explodeTags = preg_split('/(,| )\s*/', $tags);
        return $explodeTags;
    }

}