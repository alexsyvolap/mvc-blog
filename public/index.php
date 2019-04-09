<?php

/**
 * Композер
 */
require dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Ошибочки
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * Роуты
 */
require dirname(__DIR__) . '/public/route.php';