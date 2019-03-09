<?php

namespace fw\core\base;

use fw\core\Db;
use Valitron\Validator;

abstract class Model {

    protected $pdo;
    protected $table;
    /**
     * Первичный ключ
     * @var string
     */
    protected $pk = 'id';

    /**
     * @var array
     */
    public $attributes = [];
    /**
     * validate
     * @var array
     */
    public $errors = [];
    public $rules = [];

    public function __construct() {
       $this->pdo = Db::instance();
    }

    public function load($data) {
        foreach($this->attributes as $name => $value) {
            if(isset($data[$name])) {
                $this->attributes[$name] = $data[$name];
            }
        }
    }

    public function save($table) {
        $tbl = \R::dispense($table);
        foreach ($this->attributes as $name => $value) {
            $tbl->$name = $value;
        }
        return \R::store($tbl);
    }

    public function validate($data) {
        $v = new Validator($data);
        $v->rules($this->rules);
        if($v->validate()) {
            return true;
        }
        $this->errors = $v->errors();
        return false;
    }

    public function getErrors() {
        $errors = '<ul>';
        foreach($this->errors as $error) {
            foreach($error as $item) {
                $errors .= "<li>$item</li>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['error'] = $errors;
    }

    //Встроенные методы для работы с БД
    public function exec($sql) {
        return $this->pdo->execute($sql);
    }

    public function findAll() {
        $sql = "SELECT * FROM $this->table";
        return $this->pdo->query($sql);
    }

    public function findOne($id, $filed = '') {
        $filed = $filed ?: $this->pk;
        $sql = "SELECT * FROM $this->table WHERE $filed = ? LIMIT 1";
        return $this->pdo->query($sql, [$id])[0];
    }

    public function query($sql, $params = []) {
        return $this->pdo->query($sql, $params);
    }

    public function search($str, $field, $table = '') {
        $table = $table ?: $this->table;
        $sql = "SELECT * FROM $table WHERE $field LIKE ?";
        return $this->pdo->query($sql, ["%$str%"]);
    }
}