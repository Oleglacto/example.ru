<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 15:20
 */

class Controller {

    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    function actionIndex()
    {
    }
}