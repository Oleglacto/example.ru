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

    /**
     * Классное оформление кода. Приятные отступы (нет)
     * п.с. общий вид, ну скажи по номральному - шаблон :)
     */
    protected $templateView = "template_view.php"; // здесь можно указать общий вид по умолчанию.

    function render($contentView, $templateView, $data = null)
    {
        if(is_array($data)) {
            extract($data);
        }

        /**
         * А почему не реквайр?
         */
        include __DIR__.'/../views/'.$templateView;
    }
}
