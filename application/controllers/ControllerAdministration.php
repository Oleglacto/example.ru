<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 19.03.18
 * Time: 22:46
 */

namespace application\controllers;


use application\core\BaseController;

class ControllerAdministration extends BaseController
{
    function actionIndex()
    {
        $this->view->render('administration_view.php');
    }

}