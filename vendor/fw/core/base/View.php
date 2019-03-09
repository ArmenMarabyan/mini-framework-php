<?php

namespace fw\core\base;


use mysql_xdevapi\Exception;

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
    public static $meta = ['title' => '', 'desc' => '', 'keywords' => ''];

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
     * Своя функция для сжатия страниц HTML
     * @param $buffer
     * @return string|string[]|null
     */
    protected function compressPage($buffer) {
        $search = [
            "/(\n)+/",
            "/\r\n+/",
            "/\n(\t)+/",
            "/\n(\ )+/",
            "/\>(\n)+</",
            "/\>\r\n</",
        ];

        $replace = [
            "\n",
            "\n",
            "\n",
            "\n",
            "><",
            "><",
        ];

        return preg_replace($search, $replace, $buffer);
    }

    /**
     * Поключение вида и шаблона
     *
     */
    public function render($vars) {
        if(is_array($vars)) {
            extract($vars);
        }
        $fileView = APP . "/views/{$this->route['prefix']}{$this->route['controller']}/{$this->view}.php";

        if(COMPRESS_HTML) {
            ob_start('ob_gzhandler');
            header("Content-Encoding: gzip");
        }else {
            ob_start();
        }


        if(file_exists($fileView)) {
            require_once $fileView;
        }else {
            throw new \Exception("file: <b>$fileView</b> не найден", 404);
        }
        $content = ob_get_contents();
        ob_clean();

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
                throw new \Exception("Шаблон: <b>$fileView</b> не найден", 404);
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