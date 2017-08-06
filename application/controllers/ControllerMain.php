<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 15:49
 */
namespace application\controllers;

use \application\core\BaseController;

class ControllerMain extends BaseController
{
    function actionIndex()
    {
        $this->view->render('main_view.php', 'template_view.php');
    }
}