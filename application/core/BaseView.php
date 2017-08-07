<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 15:20
 */
namespace application\core;
class BaseView
{
    protected $templateView = "template_view.php"; // здесь можно указать общий вид по умолчанию.
    protected $categories;
    protected $cakes;
    function render($contentView, $templateView, $data = null)
    {
        include __DIR__.'/../views/'.$templateView;
    }
}
