<?php

namespace app\controllers;


use app\models\User;
use fw\core\base\View;

class UserController extends AppController {

    public function actionRegister() {
        $user = new User;
        $user->isAuthorized();
        if(isset($_POST['register'])) {

            $data = [];

            foreach($_POST as $k => $v) {
                $data[$k] = trim(htmlspecialchars($v));
            }
            $user->load($data);
            if(!$user->validate($data) || !$user->checkUnique()) {
                $user->getErrors();
                $_SESSION['form_data'] = $data;
                redirect();
            }
            $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
            if($user->save('users')) {
                $_SESSION['success'] = 'Вы успешно зарегистрированы';
            }else {
                $_SESSION['error'] = 'Ошибка регистрации';
            }
            redirect();
        }
        $users = \R::findAll('users');
        View::setMeta('Регистрация');
        $this->set(compact('users'));
    }

    public function actionLogin() {
        $user = new User;
        $user->isAuthorized();
        if(isset($_POST['auth'])) {

            if($user->login()) {
                $_SESSION['success'] = 'OK';
            }else {
                $_SESSION['error'] = 'Не верный логин или пароль';
            }
            redirect('/fw_v2');
        }

        View::setMeta('Login');
    }

    public function actionLogout() {
        if(isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }

        redirect();
    }
}