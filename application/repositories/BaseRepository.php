<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 08.08.17
 * Time: 16:20
 */
namespace application\repositories;

use application\dbal\Database;
abstract class BaseRepository{

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
        $this->connection = new Database();
    }

    /**
     * Возвращает все торты из бд
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
    public function deleteById($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $this->runQuery($sql,[[$id], [':id']]);
    }

    /**
     * Проверка на выполнение запроса
     * Если запрос неудачный, показывает ошибку
     * @param $sql
     * @param null|array $values
     */
    protected function runQuery($sql, $values = null)
    {
            if(!$this->connection->executeQuery($sql, $values)) {
               var_dump($this->connection->getError());
            }
    }

}