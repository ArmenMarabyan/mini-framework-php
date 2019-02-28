<?php

namespace app\controllers;

class PostController {
    public function __construct()
    {
        echo 'PostsController asd';
    }

    public function actionIndex() {
        echo '<br> PostsController actionIndex';
    }

    public function actionTest() {
        echo '<br>PostsController actionTest';
    }
}