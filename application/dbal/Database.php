<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 05.08.17
 * Time: 10:58
 */
namespace application\dbal;


use PDO;

class Database
{

    /**
     * @var
     * ссылка на экзмепляр этого класса
     */
    protected static $instance;

    /**
     * ссылка на подключение к БД
     * @var PDO
     */
    protected $pdo;




    public static function getInstance()
    {
        if(is_null(static::$instance))
        {
            static::$instance = new static;
        }
        return static::$instance;
    }




    public function __construct()
    {
        $this->pdo = $this->getDB();
    }


    /**
     * @param $query
     * @return result of query
     */
    public function getDataFromDB($query)
    {
        return $this->prepareStatement($query);
    }

    public function makeSelect($query,$data)
    {
        return $this->prepareStatement($query, $data);
    }


    /**
     * Соединение с базой данных
     * @return PDO
     */
    public function getDB(){
        if(is_null($this->pdo))
        {
            $database = require_once '../application/config/database.php';
            $this->pdo = new PDO('mysql:host='.$database['host'].';dbname='.
                $database['database'].';charset=utf8;' ,$database['user'],$database['password']);

        }
        return $this->pdo;
    }

    public function insertData()
    {

    }
    public function deleteById($id)
    {
        $sql = "";
    }
    /**
     * @param $sql запрос
     * @param $data полученные данные
     * @return result
     */
    private function prepareStatement($sql, $data = null)
    {
        if(!$data)
        {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            $stmt = $this->pdo->prepare($sql);
            if(!is_array($data))
            {
                $stmt->execute(array($data));
            }
            else
            {
                $stmt->execute($data);
            }
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }


}