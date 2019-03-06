<?php

namespace fw\core;
use R;

class Db {

    use TSingleton;

    private $pdo;
    public static $countSql = 0;
    public static $queries = [];

    /**
     * Подключение RedBeanPHP
     * Db constructor.
     */
    private function __construct() {
        $db = require_once ROOT . '/config/db_params.php';
        require_once LIBS . "/rb.php";

        R::setup($db['dsn'], $db['user'], $db['password']);
        R::freeze(true);
//
//        подключение без использования ORM
//        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['password']);
//        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }


//      Встроенные методы для работы с БД
//    public function execute($sql, $params = []) {
//        self::$countSql++;
//        self::$queries[] = $sql;
//        $result = $this->pdo->prepare($sql);
//        return $result->execute($params);
//    }
//
//    public function query($sql, $params = []) {
//        self::$countSql++;
//        self::$queries[] = $sql;
//
//        $stmt = $this->pdo->prepare($sql);
//        $result = $stmt->execute($params);
//
//        if($result !== false) {
//            $stmt->setFetchMode(\PDO::FETCH_ASSOC);
//            return $stmt->fetchAll();
//        }
//        return [];
//    }
}