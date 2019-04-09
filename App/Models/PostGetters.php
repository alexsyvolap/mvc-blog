<?php

namespace App\Models;

use App\Lang;

trait PostGetters
{

    /**
     * @return array
     * Возвращает статусы и их названия
     */
    public static function getStatuses()
    {
        return array(
            ['value' => self::STATUS_NEW, 'lang' => Lang::getRu()['posts']['status']['new']],
            ['value' => self::STATUS_OPEN, 'lang' => Lang::getRu()['posts']['status']['open']],
            ['value' => self::STATUS_CLOSED, 'lang' => Lang::getRu()['posts']['status']['closed']]
        );
    }

}