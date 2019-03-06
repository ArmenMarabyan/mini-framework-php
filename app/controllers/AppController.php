<?php


namespace app\controllers;


use fw\core\base\Controller;

class AppController extends Controller {

    public $meta = [];

    protected function setMeta($title = '', $description = '', $keywords = '') {
        $this->meta['title'] = $title;
        $this->meta['description'] = $description;
        $this->meta['keywords'] = $keywords;
    }
}