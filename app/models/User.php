<?php

namespace app\models;
use fw\core\base\Model;

class User extends Model {

    public $attributes = [
        'login' => '',
        'password' => '',
        'email' => '',
        'name' => '',
    ];

    public $rules = [
        'required' => [
            ['login'],
            ['password'],
            ['email'],
            ['name'],
        ],
        'email' => [
            ['email'],
        ],
        'lengthMin' => [
            ['password', 6],
        ]
    ];


    public function checkUnique() {
        $user = \R::findOne('users', 'login = ? OR email = ? LIMIT 1', [$this->attributes["login"], $this->attributes["email"]]);
        if($user) {
            if($user->login == $this->attributes['login']) {
                $this->errors['unique'][] = 'Такой логин уже существует';
            }
            if($user->email == $this->attributes['email']) {
                $this->errors['unique'][] = 'Такой email уже существует';
            }
            return false;
        }
        return true;
    }

    public function login() {
        $loginOrEmail = !empty(trim($_POST['login'])) ? trim($_POST['login']) : null;
        $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;

        if($loginOrEmail && $password) {
            $user = \R::findOne('users', 'login = ? OR email = ? LIMIT 1', [$loginOrEmail, $loginOrEmail]);
            if($user) {
                if(password_verify($password, $user->password)) {
                    foreach($user as $k => $v) {
                        if($k != 'password') {
                            $_SESSION['user'][$k] = $v;
                        }
                    }
                    return true;
                }
            }
        }
        return false;
    }

    public function isAuthorized() {
        if(!isset($_SESSION['user'])) {
            return false;
        }
        redirect();
    }


}