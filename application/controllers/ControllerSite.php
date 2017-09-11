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
         * Не надо так, use каталог, и потмо классы с частю неймспейса задавать
         * use отдельно каждый класс, поверь моему жизненному опыту)
         */
        $rep = new repositories\CakeRepository();

        //echo '<pre>';
        //var_dump($rep->getCakes());
        //echo __METHOD__;
        $this->view->render('site_view.php', 'template_view.php');
    }
}