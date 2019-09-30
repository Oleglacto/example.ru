<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 15:20
 */
namespace application\core;


use Exception;


class BaseModel
{
    /**
     * @var $repository экземпляр класса репозитория
     */
    protected $table;

    public function getTable()
    {
        if (is_null($this->table)) {
            throw new Exception('Задайте имя таблицы');
        }
        return $this->table;
    }



}