<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 15:49
 */

class ControllerMain extends BaseController
{
    function actionIndex()
    {
        $this->view->render('main_view.php', 'template_view.php');
    }
}