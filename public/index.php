<?php
error_reporting(E_ALL);

use vendor\core\Router;

$uri = rtrim($_SERVER['QUERY_STRING'], '/');

define('WWW', __DIR__);
define('CORE', dirname(__DIR__).'/vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');
define('LIBS', dirname(__DIR__) . '/vendor/libs');
define('LAYOUT', 'default');


require_once '../vendor/libs/functions.php';

spl_autoload_register(function($class) {
    $file = ROOT . '/'. str_replace('\\', '/', $class) . '.php';

    if(file_exists($file)) {
        require_once $file;
    }
});

//пользовательские маршруты
Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Page']);
Router::add('^page/(?P<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);

//Дэфолтные маршруты
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

//debug(Router::getRoutes());

Router::dispatch($uri);
