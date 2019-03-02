<?php


namespace app\controllers;


use app\models\Main;

class MainController extends AppController {

    public function actionIndex() {
        $model = new Main;


//        $one = $model->findOne(1);
//        $two = $model->findOne('2Lorem', 'short');
//        $three = $model->search('am', 'short', 'news');
//        $four = $model->query("SELECT * FROM news WHERE short LIKE ?", ['%am%']);
//        $five = $model->query("SELECT * FROM users");

//        $six = $model->exec("CREATE TABLE test (
//            test_id int,
//    LastName varchar(255),
//    FirstName varchar(255),
//    Address varchar(255),
//    City varchar(255)
//)");

//        $newsList = $model->findAll();
            $newsList = \R::findAll('news');
            $this->setMeta('Главная', 'Описание', 'Ключевые слова');
            $meta = $this->meta;
//            debug($newsList);
        $this->set(compact('newsList', 'meta'));

    }
}