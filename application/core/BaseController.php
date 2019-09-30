<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 15:20
 */
namespace application\core;

use application\components\Validator;

class BaseController {

    /**
     * ХДЕ ПХПДОК КОММЕНТАРИИ??!!!!
     */

    protected $view;


    function __construct()
    {
        $this->view = new BaseView();
    }

    function actionIndex()
    {
    }

    protected function validate()
    {
        $validate = new Validator();
    }
}