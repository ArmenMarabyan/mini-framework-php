<?php

namespace vendor\core;
/**
 * Class Router
 */

class Router {

    /**
     * Все маршруты
     * @var array
     */
    protected static $routes = [];
    /**
     * Текущий маршрут
     * @var array
     */
    protected static $route = [];

    /**
     * Добавляет текущий маршрут в таблицу маршрутов
     * @param $regexp
     * @param array $route
     */
    public static function add($regexp, $route = []) {
        self::$routes[$regexp] = $route;
    }

    /**
     * Возвращает таблицу маршрутов
     * @return array
     */
    public static function getRoutes() {
        return self::$routes;
    }

    /**
     * Возвращает текущий маршрут
     * @return array
     */
    public static function getRoute() {
        return self::$route;
    }

    /**
     * Ищет uri в таблице маршрутов
     * @param $uri
     * @return bool
     */
    public static function matchRoute($uri) {
        foreach(self::$routes as $pattern => $route) {
            if(preg_match("#$pattern#i", $uri, $matches)) {
                debug($matches);
                foreach($matches as $key => $value) {

                    if(is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                if(!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                self::$route = $route;
                debug($route);
                return true;
            }
        }
        return false;
    }

    /**
     * Создает экземпляр класса контроллера и запускает action
     * @param $uri
     */
    public static function dispatch($uri) {
        if(self::matchRoute($uri)) {
//            $controllerName = self::$route['controller'].'Controller';

            $controllerName = 'app\controllers\\'.self::upperCamelCase(self::$route['controller']).'Controller';
            if(class_exists($controllerName)) {
                $controllerObject = new $controllerName;
                $actionName = 'action' .self::upperCamelCase(self::$route['action']);

                if(method_exists($controllerObject, $actionName)) {
                    $controllerObject->$actionName();
                }else {
                    echo "method: $actionName не найден <br>";
                }
            }else {
                echo "controller: $controllerName не найден <br>";
            }
        }else {
            http_response_code(404);
            echo "404.html";

        }
    }

    /**
     * Принимает строку разделителем и возвращает в camelCase варианте/test-test TestTest
     * @param $name
     * @return mixed|string
     */
    protected static function upperCamelCase($name) {
        $name = str_replace('-', ' ', $name);
        $name = ucwords($name);
        $name = str_replace(' ', '', $name);

        return $name;
    }


}