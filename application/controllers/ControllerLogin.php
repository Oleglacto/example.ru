<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 19:32
 */
namespace application\controllers;

use application\core\BaseController;
use application\models\User;

Class ControllerLogin extends BaseController{


    public function actionIndex()
    {
        $this->view->render('login_view.php','template_view.php');
    }


    public function actionRegister()
    {
        $user = new User();
        if (!isset($_POST['submitted'])) {
            $error = require_once '../application/views/error_view.php';
        }
        $this->view->render('register_view.php','template_view.php',['error' => $error]);
        //$user->checkInput($_POST);
        //
    }

    public function actionFormRegister()
    {
        $this->view->render('register_view.php','template_view.php');
    }

}
