<?php

namespace app\controllers;

use app\models\Main;
use fw\core\base\View;

class PageController extends AppController {

    public function actionView() {
        $model = new Main;
        $news = \R::findOne('news', 'id=2');
        View::setMeta('View', 1, 2);
        $this->set(compact('meta', 'news'));
    }

    public function actionIndex() {
        echo 'index';
        View::setMeta('View', 1, 2);
        $this->set(compact('meta', 'news'));
    }

}