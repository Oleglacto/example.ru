<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 15:49
 */

class Controller_Main extends Controller
{
    function actionIndex()
    {
        $this->view->generate('main_view.php', 'template_view.php');
    }
}