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

    /**
     * ГДЕ ПХПДОКИ, ГДЕ КОММЕНТАРИИ, ЕДРИТЬ КОЛОТИТЬ?!
     */

    public function actionIndex()
    {
        $this->view->render('login_view.php','template_view.php');
    }


    public function actionRegister()
    {
        $user = new User();
        if (!isset($_POST['submitted'])) {
            // вот это можно сделать методом в базовом классе.
            // сделать протектед свойство с путем к фалй ошибки
            // чтоб можно было в каждом контроллере переопределять
            // и сделать вспомогательную функицю
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
