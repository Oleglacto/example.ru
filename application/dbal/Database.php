<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 05.08.17
 * Time: 10:58
 */
namespace application\dbal;


use \Exception;
use PDO;

class Database
{
    /**
     * ссылка на подключение к БД
     * @var PDO
     */
    protected $pdo;

    /**
     * Хранит последнюю ошибку PDO
     * @var $error
     */
    protected $error;

    public function __construct()
    {
        $this->pdo = $this->getDB();
    }

    /**
     * @param $data array
     * @return array [columns,values,anchors]
     */
    public function getPreparedData(array $data)
    {
        $columns = [];
        $values = [];
        $anchors = [];
        foreach ($data as $key => $value) {
            $columns[] = $key;
            $values[] = $value;
            $anchors[] = ":" . $key;
        }
        return [
            'columns' => $columns,
            'anchors' => $anchors,
            'values' => $values
        ];
    }

    /**
     * Соединение с базой данных
     * @return PDO
     */
    public function getDB(){
        if (is_null($this->pdo)) {
            try{
                $database = require_once '../application/config/database.php';
                $this->pdo = new PDO('mysql:host='.$database['host'].';dbname='.
                    $database['database'].';charset=utf8;' ,$database['user'],$database['password']);
            } catch (Exception $exception) {
                echo $exception->getMessage();
            }
        }
        return $this->pdo;
    }

    /**
     * возвращат послднюю ошибку PDO
     * @return $error
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Выполнение sql запроса
     * @param $sql подготовленный sql запрос
     * @param $data [values[0],anchors[1]]
     * @return true|false
     */
    public function executeQuery($sql, $data = null)
    {
        $statement = null;
        if (!$data) {
            if (!$statement = $this->pdo->prepare($sql)) {
                $this->error = $statement->errorInfo();
            }
        } else {
            if ($statement = $this->pdo->prepare($sql)) {
                $statement = $this->bindParams($statement, $data);
            } else {
                $this->error = $statement->errorInfo();
            }
        }
        if ($result = $statement->execute()) {
            return $result;
        } else {
            $this->error = $statement->errorInfo();
            return false;
        }
    }


    /**
     * Возвращает выборку из БД или ошибку.
     * @param $sql
     * @param $data
     * @return array|bool
     */
    public function makeSelect($sql, $data = null)
    {
        if (!$data) {
            $statement = $this->pdo->prepare($sql);
        } else {
            if ($statement = $this->pdo->prepare($sql)) {
                $statement = $this->bindParams($statement, $data);
            } else {
                $this->error = $this->pdo->errorInfo();
            }
        }
        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $this->error = $statement->errorInfo();
            return false;
        }

    }

    /**
     * Метод, который присваевает якорям их значения
     * @param $statement
     * @param $data [values[0], anchors[1]]
     * @return mixed $statement
     */
    protected function bindParams($statement, $data)
    {
        $values = $data[0];
        $anchors = $data[1];
        if (is_array($values) and is_array($anchors)) {
            foreach ($values as $key => $value) {
                if (is_numeric($value)) {
                    $statement->bindValue($anchors[$key],$value,PDO::PARAM_INT);
                } else {
                    $statement->bindValue($anchors[$key],$value,PDO::PARAM_STR);
                }
            }
        } else {
            $statement = false;
            echo "data or anchors not array";
        }
        return $statement;
    }
}