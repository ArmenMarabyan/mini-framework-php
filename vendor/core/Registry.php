<?php

namespace vendor\core;

/**
 * Class Registry
 * @package vendor\core
 */
class Registry {

    use TSingleton;

    public static $objects = [];

    private function __construct() {
        $config = require_once ROOT . '/config/config.php';
        foreach($config['components'] as $name => $component) {
            self::$objects[$name] = new $component;
        }
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
        debug(self::$objects);
    }
}