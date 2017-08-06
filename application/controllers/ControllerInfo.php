<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 19:32
 */

Class ControllerInfo extends BaseController{


    function actionIndex()
    {
        $this->view->render('info_view.php','template_view.php');
        echo "action_index";
    }
    function actionFirst()
    {
        $this->view->render('info_view.php','template_view.php');
        echo "action_first";
    }
}