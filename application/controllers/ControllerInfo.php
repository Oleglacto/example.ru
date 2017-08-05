<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 19:32
 */
Class Controller_Info extends Controller{


    function actionIndex()
    {
        $this->view->generate('info_view.php','template_view.php');
        echo "action_index";
    }
    function actionFirst()
    {
        $this->view->generate('info_view.php','template_view.php');
        echo "action_first";
    }
}