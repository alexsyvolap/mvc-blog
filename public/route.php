<?php

use Core\Router;

/**
 * Роуты
 */
$router = new Router();

$router->add('', ['controller' => 'Home', 'action' => 'redirect']);
$router->add('news', ['controller' => 'News', 'action' => 'index']);
$router->add('news/{id:\d+}', ['controller' => 'News', 'action' => 'postView']);
$router->add('news/create', ['controller' => 'News', 'action' => 'createPost']);

$router->dispatch($_SERVER['QUERY_STRING']);