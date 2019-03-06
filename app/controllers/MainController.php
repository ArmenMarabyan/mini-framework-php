<?php


namespace app\controllers;


use app\models\Main;
use vendor\core\App;
use vendor\core\base\View;

class MainController extends AppController {

    public function actionIndex() {


        $model = new Main;
        echo $test;
        if($this->isAjax()) {
            sleep(1);
            $news = \R::findOne("news", "id = {$_POST['id']}");
            $this->loadView('Main/test', compact('news'));
            die;
        }



//        Пример использование кэша
//        $newsList = App::$app->cache->get('news'); // Получает данные кэша в виде массива
//        if(!$newsList) {
//            echo 'kan';
//            $newsList = \R::findAll('news');// запрос
//            App::$app->cache->set('news', $newsList); // создает файл кэша и добавляет туда данные
//        }
//        App::$app->cache->deleteCache('news'); // удаляет файл кэша

//        App::$app->getList();


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


//        \R::fancyDebug(true);

        $newsList = \R::findAll('news');// запрос
//        $this->setMeta('Главная', 'Описание', 'Ключевые слова');
//        $meta = $this->meta;
        View::setMeta('Главная', 'Описание', 'Ключевые слова');
        $this->set(compact('newsList', 'meta'));

    }

    public function actionTest() {
        echo __METHOD__;

    }
}