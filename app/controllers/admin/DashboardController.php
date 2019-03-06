<?php

namespace app\controllers\admin;


use fw\core\base\View;

class DashboardController extends AppController {

    public function actionIndex() {
        $pageTitle = 'Dashboard';
        View::setMeta('Admin Panel');
        $this->set(compact('pageTitle'));
    }

    public function actionTest() {
    }
}