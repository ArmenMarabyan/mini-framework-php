<?php

namespace app\controllers;

use app\models\Main;

class PageController extends AppController {

    public function actionView() {
        $model = new Main;
        $news = \R::findOne('news', 'id=2');
        $this->setMeta('view');
        $meta = $this->meta;
        $this->set(compact('meta', 'news'));
    }

    public function actionIndex() {
        echo 'index';
    }

}