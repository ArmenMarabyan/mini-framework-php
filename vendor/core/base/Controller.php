<?php

namespace vendor\core\base;

abstract class Controller {

    /**
     * Текущий маршрут
     * @var array
     */
    public $route = [];

    /**
     * Текущий вид
     * @var array
     */
    public $view;

    /**
     * Текущий шаблон
     * @var array
     */
    public $layout;

    /**
     * Пользовательские данные
     * @var array
     */
    public $vars = [];

    public function __construct($route) {
        $this->route = $route;
        $this->view = $route['action'];
    }

    public function getView() {
        $viewObj = new View($this->route, $this->layout, $this->view);
        $viewObj->render($this->vars);
    }

    /**
     * Передача данных в вид и шаблон
     * @param $vars
     */
    public function set($vars) {
        $this->vars = $vars;
    }


}