<?php

namespace vendor\core\base;


class View {
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

    public function __construct($route, $layout = '', $view = '') {
        $this->route = $route;
        if($layout === false) {
            $this->layout = false;
        }else {
            $this->layout = $layout ?: LAYOUT;
        }

        $this->view = $view;
    }

    /**
     * Поключение вида и шаблона
     * @param $vars
     */
    public function render($vars) {
        if(is_array($vars)) {
            extract($vars);
        }
        $fileView = APP . "/views/{$this->route['controller']}/{$this->view}.php";
        ob_start();
        if(file_exists($fileView)) {
            require_once $fileView;
        }else {
            echo "<p>file: <b>$fileView</b> не найден</p>";
        }
        $content = ob_get_clean();

        if(false !== $this->layout) {
            $fileLayout = APP . "/views/layouts/{$this->layout}.php";
            if(file_exists($fileLayout)) {
                require_once $fileLayout;
            }else {
                echo "<p>Шаблон: <b>$fileView</b> не найден</p>";
            }
        }


    }

}