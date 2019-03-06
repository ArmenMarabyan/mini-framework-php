<?php

namespace fw\core;
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
                foreach($matches as $key => $value) {

                    if(is_string($key)) {
                        $route[$key] = $value;
                    }
                }

                if(!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                //prefix для админ контроллеров
                if(!isset($route['prefix'])) {
                    $route['prefix'] = '';
                }else {
                    $route['prefix'] .= '\\';
                }

                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    /**
     * Создает экземпляр класса контроллера и запускает action
     */
    public static function dispatch($uri) {
       $uri = self::removeQueryString($uri);
        if(self::matchRoute($uri)) {

            $controllerName = 'app\controllers\\'.self::$route['prefix'].self::$route['controller'].'Controller';
            if(class_exists($controllerName)) {
                $controllerObject = new $controllerName(self::$route);
                $actionName = 'action' .self::upperCamelCase(self::$route['action']);

                if(method_exists($controllerObject, $actionName)) {
                    $controllerObject->$actionName();
                    $controllerObject->getView();
                }else {
//                    echo "method: $actionName не найден <br>";
                    throw new \Exception("method: $actionName не найден", 404);
                }
            }else {
                throw new \Exception("controller: $controllerName не найден", 404);

//                echo "controller: $controllerName не найден <br>";
            }
        }else {
            throw new \Exception("Страница не найдена", 404);
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

    protected static function removeQueryString($uri) {
        if($uri) {
            $params = explode('&', $uri, 2);
            if(false === strpos($params[0], '=')) {
                return rtrim($params[0], '/');
            }else {
                return '';
            }
            return $uri;
        }
    }


}