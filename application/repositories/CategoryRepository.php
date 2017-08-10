<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 08.08.17
 * Time: 16:26
 */
namespace application\repositories;



class CategoryRepository extends BaseRepository{

    protected $table = 'categories';

    public function getCategories()
    {
        $query = "SELECT * FROM $this->table";
        $data = $this->connection->executeQuery($query);
        return $data;
    }

    public function addCategory($name)
    {

    }

    public function deleteCategory($name)
    {

    }

}