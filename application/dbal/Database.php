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
     * ссылка на подключение к БД
     * @var PDO
     */
    protected $pdo;

    protected $error;


    public function __construct()
    {
        $this->pdo = $this->getDB();
    }


    public function getPreparedData($data)
    {
        $columns = [];
        $values = [];
        $anchors = [];
        foreach ($data as $key => $value)
        {
            $columns[] = $key;
            $values[] = $value;
            $anchors[] = ":".$key;
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
        if(is_null($this->pdo))
        {
            $database = require_once '../application/config/database.php';
            $this->pdo = new PDO('mysql:host='.$database['host'].';dbname='.
                $database['database'].';charset=utf8;' ,$database['user'],$database['password']);

        }
        return $this->pdo;
    }

    public function getError()
    {
        return $this->error;
    }
    /**
     * @param $sql запрос
     * @param $data полученные данные
     * @return result
     * @internal param null $anchors
     */
    public function executeQuery($sql, $data = null)
    {
        if(!$data)
        {
            $result = $this->ifNotData($sql);
        }
        else
        {
            $anchors = $this->getAnchors($sql);
            if(!$statement = $this->pdo->prepare($sql))
            {
                $this->error = $statement->errorInfo();
            }
            if(is_array($data) and is_array($anchors)) {
                foreach ($data as $key => $value)
                {
                    if(is_int($value))
                    {
                        $statement->bindValue($anchors[$key],$value,PDO::PARAM_INT);
                    }
                    else
                    {
                        $statement->bindValue($anchors[$key],$value,PDO::PARAM_STR);
                    }
                }
                if($statement->execute())
                {
                    $result = $this->getResult($statement);
                }
                else
                {
                    $this->error = $statement->errorInfo();
                }

            }
            else
            {
                echo "data or anchors not array";
            }

        }
        return $result;

    }

    protected function ifNotData($sql)
    {
        $statement = $this->pdo->prepare($sql);
        if($statement->execute())
        {
            $result = $this->getResult($statement);
        }
        else
        {
            $this->error = $statement->errorInfo();
        }
        return $result;
    }

    protected function getResult($statement)
    {
        if(!is_array($result = $statement->fetchAll()))
        {
            $result = $statement;
        }

        return $result;
    }


    protected function getAnchors($sql)
    {
        preg_match_all("<:[a-z]+_[a-z]+|:[a-z]+>",$sql,$array);
        foreach($array[0] as $value)
        {
            $result[] = $value;
        }
        return $result;
    }


}