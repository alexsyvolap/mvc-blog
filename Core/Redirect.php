<?php


namespace Core;


class Redirect
{

    /**
     * @param $url
     * Просто редиректим на УРЛ
     */
    public static function to($url)
    {
        header("Location: " . $url, 301);
        exit();
    }

}