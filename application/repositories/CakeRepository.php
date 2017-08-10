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