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
     * таблица в бд
     * @var $table
     */
    protected $table;


    /**
     * уникальный идентификатор
     * @var $id
     */
    protected $id;

    /**
     * список полей, которые
     * были обновлены
     * @var array $fields;
     */
    protected $fields = [];

    /**
     * Получить имя таблицы бд
     * @return mixed
     * @throws Exception
     */
    public function getTable(){
        if(is_null($this->table)) throw new Exception('Задайте имя таблицы');
        return $this->table;
    }



}