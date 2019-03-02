<?php

namespace app\controllers;

class TestController extends AppController{
    public function actionIndex() {
        echo "TestController action index";
    }

    public function actionTest() {
        echo "TestController action test";
    }
}