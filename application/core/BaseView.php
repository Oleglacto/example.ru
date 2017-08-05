<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 15:20
 */

class BaseView
{
    protected $templateView = "main_view.php"; // здесь можно указать общий вид по умолчанию.


    function render($contentView, $templateView, $data = null)
    {
        include __DIR__.'/../views/'.$templateView;
    }
}






/*
if(is_array($data)) {
    // преобразуем элементы массива в переменные
    extract($data);
}
*/