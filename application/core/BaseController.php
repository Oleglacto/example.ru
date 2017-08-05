<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 15:20
 */

class BaseController {

    protected $model;
    protected $view;

    function __construct()
    {
        $this->view = new BaseView();
    }

    function actionIndex()
    {
    }
}