<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 15:49
 */
namespace application\controllers;

use application\App;
use application\components\AuthorizationGuard;
use application\core\BaseController;
use application\repositories\CategoryRepository;

class ControllerSite extends BaseController
{
    function actionIndex()
    {
        $categories = new CategoryRepository();
        $data = $categories->getAllRows();
        $this->view->render('site_view.php', ['categories' => $data]);
    }
}