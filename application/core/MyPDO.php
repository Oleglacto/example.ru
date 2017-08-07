<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 07.08.17
 * Time: 11:17
 */
namespace application\core;

use PDO;
use \application\dbal\DataBaseCon;
class MyPDO{
    /**
     * ссылка на подключение к БД
     * @var $pdo
     */
    protected $pdo;

    public static function getData($column,$table){
        $pdo = DataBaseCon::getInstance()->getDB();
        $sql = 'SELECT ' . $column . ' from ' . $table;
        $query = $pdo->query($sql) or die('failed!');
        while ($result = $query->fetch(PDO::FETCH_ASSOC)){
            $data[] = $result;
        }
        return $data;
    }


}