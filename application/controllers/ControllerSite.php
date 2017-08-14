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
        $rep = new repositories\CakeRepository();

        //$result = $rep->getAllCakes();
//        $rep->addCake(
//            ['name' => 'Рай',
//            'mass'=> '234',
//            'price' => '800',
//            'category_id' => 1]);
       // var_dump($result);
        echo '<pre>';
        var_dump($rep->getCakes([
            'category_id' => 1
        ]));
        $this->view->render('site_view.php', 'template_view.php');
    }
}