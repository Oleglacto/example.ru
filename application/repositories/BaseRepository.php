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
     * @var Database
     */
    protected $connection;

    public function __construct()
    {
        $this->connection = new Database();
    }
}