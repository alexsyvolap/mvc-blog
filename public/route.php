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
$router->add('news/delete/{id:\d+}', ['controller' => 'News', 'action' => 'postDelete']);
$router->add('news/edit/{id:\d+}', ['controller' => 'News', 'action' => 'postEdit']);
$router->add('news/{id:\d+}/comment', ['controller' => 'Comments', 'action' => 'commentSend']);
$router->add('news/{id:\d+}/comment/count', ['controller' => 'Comments', 'action' => 'getCommentCount']);

$router->dispatch($_SERVER['QUERY_STRING']);