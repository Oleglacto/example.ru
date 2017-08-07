<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 15:49
 */
namespace application\controllers;

use \application\core\BaseController;
use application\models\Site;

class ControllerSite extends BaseController
{
    function actionIndex()
    {
        $this->model = new Site();
        $categoriesName = $this->model->getCategories();
        $cakesName = $this->model->getCakes();
        $data['categories'] = $categoriesName;
        $data['cakes'] = $cakesName;
        $this->view->render('site_view.php', 'template_view.php',$data);
    }
}