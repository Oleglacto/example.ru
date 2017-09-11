<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 08.08.17
 * Time: 19:16
 */
namespace application\repositories;

class CakeRepository extends BaseRepository {

    protected $table = 'cakes';


    /**
     * Не кажется, что такой же метод есть в другом репозитории? Может, сделать в баовом классе метод
     * а-ля selectAll() или all() ? :)
     * Да и к методу ниже тоже это относится. Типовые запросы одинаковые по сути. Запросы сложнее селекта и инсерта
     * будут отличаться, особенно запрсоы, затрагивающие не 1 таблицу
     */
    public function getCakes()
    {
        $query = "SELECT * FROM $this->table";
        $data = $this->connection->executeQuery($query);
        return $data;
    }

    public function addCake($data)
    {
        $dataToExecute = $this->connection->getPreparedData($data);
        $anchors = implode(',',$dataToExecute['anchors']);
        $columns = implode(',',$dataToExecute['columns']);
        $sql = "INSERT INTO $this->table (". $columns . ") VALUES (" . $anchors . ')';
        $this->runQuery($sql,$dataToExecute['values']);
    }


    public function editCake()
    {

    }
}