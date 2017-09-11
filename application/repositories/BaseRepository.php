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
     * ФОРМАТИРОВАНИЕ КОДА ААААААААААААААААААААААААААААААААААААА БОООООООООООООЛЬ
     */

    /**
     * @var Database $connection
     */
    protected $connection;

    /**
     * имя таблицы с которым работает репозиторий
     * @var $table
     *
     *
     *
     * А вот табличку-то лучше из модельки доставть, ты ведь там храгишь свойство table.
     * Одна модель - один репозиторий. Лучше добавлять сюда модельку, и тянуть из нее всю инфу.
     * А так у тебя дублирование получается.
     *
     * Либо хранитаблицу тут, а не в модели. Как решишь. Обычно ее хранят в модельке, но можно сделать
     * в рамках этого проекта и по-другому
     */
    protected $table;

    public function __construct()
    {
        $this->connection = new Database();
    }

    /**
     * Возвращает все торты из бд
     * @param $data
     * @return array|bool
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

    public function add($data)
    {
        $dataToExecute = $this->connection->getPreparedData($data);
        $anchors = implode(',',$dataToExecute['anchors']);
        $columns = implode(',',$dataToExecute['columns']);
        $sql = "INSERT INTO $this->table (". $columns . ") VALUES (" . $anchors . ')';
        $this->runQuery($sql, [$dataToExecute['values'], $dataToExecute['anchors']]);
    }

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