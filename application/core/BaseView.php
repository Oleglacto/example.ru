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
     * Шаблон используемый по умолчанию
     * @var $templateView
     */
    protected $templateView = "template_view.php";

    /**
     * @param $contentView контент
     * @param $templateView шаблон
     * @param $data массив с данными передаваемые в шаблон
     */
    function render($contentView, $data = null, $templateView = null)
    {
        if (is_array($data)) {
            extract($data);
        }

        if (!is_null($templateView)) {
            $this->templateView = $templateView;
        }


        require_once __DIR__.'/../views/layout/' . $this->templateView;
    }
}
