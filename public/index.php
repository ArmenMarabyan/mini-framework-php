<?php
error_reporting(E_ALL);

use vendor\core\Router;

$uri = rtrim($_SERVER['QUERY_STRING'], '/');

define('WWW', __DIR__);
define('CORE', dirname(__DIR__).'/vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');


require_once '../vendor/libs/functions.php';

spl_autoload_register(function($class) {
    $file = ROOT . '/'. str_replace('\\', '/', $class) . '.php';

    if(file_exists($file)) {
        require_once $file;
    }
});

//пользовательские маршруты
Router::add('^pages/?(?P<action>[a-z-]+)?$', ['controller' => 'Test', 'action' => 'test']);

//Дэфолтные маршруты
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

debug(Router::getRoutes());

Router::dispatch($uri);
