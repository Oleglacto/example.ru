<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 15:49
 */
namespace application\controllers;

use application\core\BaseController;

class ControllerSite extends BaseController
{
    function actionIndex()
    {
        //echo __METHOD__;
        $this->view->render('site_view.php', 'template_view.php');
    }
}