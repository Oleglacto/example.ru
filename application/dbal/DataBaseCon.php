<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 05.08.17
 * Time: 10:58
 */
namespace application\dbal;


use PDO;

class DataBaseCon{



    /**
     * @var
     * ссылка на экзмепляр этого класса
     */
    protected static $instance;

    /**
     * ссылка на подключение к БД
     * @var PDO
     */
    protected static $pdo;

    public static function getInstance()
    {
        if(is_null(static::$instance)){
            static::$instance = new static;
        }
        return static::$instance;
    }



    public function getDB(){
        if(is_null(static::$pdo)){
            $database = require_once '../application/config/database.php';
            static::$pdo = new PDO('mysql:host='.$database['host'].';dbname='.
                $database['database'].';charset=utf8;' ,$database['user'],$database['password']);
        }
        return static::$pdo;
    }



}