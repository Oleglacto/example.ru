<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 08.08.17
 * Time: 19:16
 */
namespace application\repositories;

class CakeRepository{

    public function getCakes()
    {
        $query = "SELECT * FROM `categories`";
        $data = $this->connection->getDataFromDB($query);
        return $data;
    }

    public function addCake($name,$price,$category)
    {

    }

    public function deleteCake($name)
    {

    }

    public function editCake()
    {

    }
}