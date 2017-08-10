<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 15:49
 */
namespace application\controllers;

use application\core\BaseController;
use application\repositories;

class ControllerSite extends BaseController
{
    function actionIndex()
    {
        $rep = new repositories\CakeRepository();

        echo '<pre>';
        var_dump($rep->getCakes());
        //echo __METHOD__;
        $this->view->render('site_view.php', 'template_view.php');
    }
}