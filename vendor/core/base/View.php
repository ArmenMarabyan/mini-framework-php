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

    /**
     * @var array
     */
    public $scripts = [];

    /**
     * Мета данные
     * @var array
     */
    public static $meta = [];

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
                $content = $this->getScripts($content);
                $scripts = [];
                if(!empty($this->scripts[0])) {
                    $scripts = $this->scripts[0];
                }
                require_once $fileLayout;
            }else {
                echo "<p>Шаблон: <b>$fileView</b> не найден</p>";
            }
        }


    }

    protected function getScripts($content) {
        $pattern = "#<script.*?>.*?</script>#si";
        preg_match_all($pattern, $content, $this->scripts);
        if(!empty($this->scripts)) {
            $content = preg_replace($pattern, '', $content);
        }
        return $content;

    }

    public static function getMeta() {
        echo '<title>'.self::$meta['title'].'</title>
    <meta name="description" content="'.self::$meta['desc'] . '">
    <meta name="keywords" content="'.self::$meta['keywords'] . '">
        ';
    }
    public static function setMeta($title = '', $desc = '', $keywords = '') {
        self::$meta['title'] = $title;
        self::$meta['desc'] = $desc;
        self::$meta['keywords'] = $keywords;
    }

}