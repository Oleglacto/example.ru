<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 08.08.17
 * Time: 16:26
 */
namespace application\repositories;



class CategoryRepository extends BaseRepository{


    public function getCategories()
    {
        $query = "SELECT * FROM `categories`";
        $data = $this->connection->getDataFromDB($query);
        return $data;
    }

    public function addCategory($name)
    {

    }

    public function deleteCategory($name)
    {

    }

}