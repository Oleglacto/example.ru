<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 08.08.17
 * Time: 16:20
 */
namespace application\repositories;

use application\dbal\Database;

abstract class BaseRepository
{
    /**
     * @var Database $connection
     */
    protected $connection;

    /**
     * имя таблицы с которым работает репозиторий
     * @var $table
     */
    protected $table;

    public function __construct()
    {
        $this->connection = Database::getInstance();
    }

    /**
     * Возвращает массив с заданными параметрами
     * @param array $parameters (example 'where $parameters')
     * @param string|null $columns (example 'id,name')
     * @return array
     */
    public function get(array $parameters, $columns = null)
    {
        $dataToExecute = $this->connection->getPreparedData($parameters);
        foreach ($dataToExecute['columns'] as $key => $value) {
            $columnAndAnchor[] = $value . ' = ' . $dataToExecute['anchors'][$key];
        }
        $columnAndAnchor = implode(' and ', $columnAndAnchor);
        if ($columns) {
            $sql = "SELECT $columns FROM $this->table WHERE $columnAndAnchor";
        } else {
            $sql = "SELECT * FROM $this->table WHERE $columnAndAnchor";
        }

        if($result = $this->connection->makeSelect($sql,[$dataToExecute['values'],$dataToExecute['anchors']])) {
            return $result;
        }
        return [];
    }

    /**
     * Изменение записи в бд
     * @param $id
     * @param $data
     */
    public function edit($id, $data)
    {
        $columnAndAnchor = [];
        $dataToExecute = $this->connection->getPreparedData($data);
        foreach ($dataToExecute['columns'] as $key => $value) {
            $columnAndAnchor[] = $value . ' = ' . $dataToExecute['anchors'][$key];
        }
        $dataToExecute['anchors'][] = ":id";
        $dataToExecute['values'][] = $id;
        $columnAndAnchor = implode(',',$columnAndAnchor);
        $sql = "UPDATE $this->table SET " . $columnAndAnchor . " WHERE id = :id";
        $this->runQuery($sql,[$dataToExecute['values'], $dataToExecute['anchors']]);
    }

    /**
     * Добавление записи в таблицу
     * @param $data
     * @return bool
     */
    public function add($data)
    {
        $dataToExecute = $this->connection->getPreparedData($data);
        $anchors = implode(',', $dataToExecute['anchors']);
        $columns = implode(',', $dataToExecute['columns']);
        $sql = "INSERT INTO $this->table (". $columns . ") VALUES (" . $anchors . ')';
        $result = $this->runQuery($sql, [$dataToExecute['values'], $dataToExecute['anchors']]);
        return $result;
    }

    /**
     * Все записи из таблицы $table
     * @return array|bool
     */
    public function getAllRows()
    {
        $sql = "SELECT * FROM $this->table";
        $data = $this->connection->makeSelect($sql);
        return $data;
    }

    /**
     * Удаление из таблицы элемента по id
     * @param $id
     */
    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $this->runQuery($sql,[[$id], [':id']]);
    }

    public function getError()
    {
        return $this->connection->getError();
    }

    /**
     * Проверка на выполнение запроса
     * Если запрос неудачный, показывает ошибку
     * @param $sql
     * @param null|array $values
     * @return bool
     */
    protected function runQuery($sql, $values = null)
    {
            if(!$this->connection->executeQuery($sql, $values)) {
               //var_dump($this->connection->getError());
               return false;
            }
            return true;
    }


}