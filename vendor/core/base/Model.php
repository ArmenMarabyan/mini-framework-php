<?php

namespace vendor\core\base;

use vendor\core\Db;

abstract class Model {

    protected $pdo;
    protected $table;
    /**
     * Первичный ключ
     * @var string
     */
    protected $pk = 'id';

    public function __construct() {
       $this->pdo = Db::instance();
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