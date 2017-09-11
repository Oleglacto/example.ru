<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 15:49
 */
namespace application\controllers;

use application\core\BaseController;
use application\repositories;


class ControllerSite extends BaseController
{
    function actionIndex()
    {
        /**
         * В use подклчюай классы, не очень гуд вот так по неймспейсу юзать. Опять же дублирование будет
         */
        $categories = new \application\repositories\CategoryRepository();
        $data = $categories->getAllRows();
        $this->view->render('site_view.php', 'template_view.php',['categories' => $data]);
    }
}