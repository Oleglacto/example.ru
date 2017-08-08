<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 15:20
 */
namespace application\core;

class BaseController {

    protected $view;

    function __construct()
    {
        $this->view = new BaseView();
    }

    function actionIndex()
    {
    }
}