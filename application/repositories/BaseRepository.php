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

    public function deleteById($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        if(!$this->connection->executeQuery($sql,[':id'],$id))
        {
            echo "Ошибка при удалении в $this->table";
        }
    }

    protected function runQuery($sql,$values = null)
    {
            if(!$this->connection->executeQuery($sql,$values))
            {
                echo '<pre>';
               var_dump($this->connection->getError());
            }
    }

}