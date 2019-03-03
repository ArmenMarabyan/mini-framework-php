<?php

$config = [
    'components' => [
        'cache' => 'classes\Cache',
        'test' => 'classes\Test',
    ],
];

spl_autoload_register(function($class) {
    $file = str_replace('\\', '/', $class) . '.php';

    if(file_exists($file)) {
        require_once $file;
    }
});

class Registry
{
    public static $objects = [];
    private static $instance;

    private function __construct() {
        global $config;
        foreach($config['components'] as $name => $component) {
            self::$objects[$name] = new $component;
        }
    }

    public static function instance() {
        if(self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function __get($name) {
        if(is_object(self::$objects[$name])) {
            return self::$objects[$name];
        }
    }

    public function __set($name, $obj) {
        if(!isset(self::$objects[$name])) {
            self::$objects[$name] = new $obj;
        }
    }

    public function getList() {
        echo "<pre>";
        var_dump(self::$objects);
    }
}

$app = Registry::instance();
$app->getList();
//$test = $app->test;
//$test->go();
$app->cache->test();
$app->test2 = 'classes\Test2';
$app->getList();
$app->test2->test2();