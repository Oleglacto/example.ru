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

    public function deleteById($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $this->runQuery($sql);
    }

    protected function runQuery($sql,$values = null)
    {
            if(!$this->connection->executeQuery($sql,$values)) {
               var_dump($this->connection->getError());
            }
    }

}