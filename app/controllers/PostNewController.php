<?php

namespace app\controllers;

class PostNewController extends AppController {
    public function __construct()
    {
        echo 'PostNewController';
    }


    public function actionIndex() {
        echo '<br> PostNewController actionIndex';
    }

    public function actionTestPage() { // uri site.ru/post-new/test-page
        echo '<br> PostNewController actionTestPage';
    }
}