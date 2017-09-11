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
     * Возвращает массив с заданными параметрами
     * @param array $parameters (example 'where $parameters')
     * @param string|null $columns (example 'id,name')
     * @return array|bool
     */
    public function getCakes($parameters, $columns = null)
    {
        $dataToExecute = $this->connection->getPreparedData($parameters);
        foreach ($dataToExecute['columns'] as $key => $value) {
            $columnAndAnchor[] = $value . ' = ' . $dataToExecute['anchors'][$key];
        }
        $columnAndAnchor = implode(' and ',$columnAndAnchor);
        if ($columns) {
            $sql = "SELECT $columns FROM $this->table WHERE $columnAndAnchor";
        } else {
            $sql = "SELECT * FROM $this->table WHERE $columnAndAnchor";
        }
        return $this->connection->makeSelect($sql,[$dataToExecute['values'],$dataToExecute['anchors']]);
    }
}