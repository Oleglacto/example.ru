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

    protected $errorMessage = [];

    public function actionIndex()
    {
        $this->view->render('login_view.php','template_view.php');
    }


    public function actionRegister()
    {
        if (!isset($_POST['submitted'])) {
            $this->checkInputs($_POST);
//            $error = require_once '../application/views/error_view.php';
        }
        $this->view->render('register_view.php','template_view.php');
        var_dump($_POST);
        foreach ($_POST as $input) {
            $input = $this->clean($input);
            if($this->checkLength($input, 3,20)) {
                echo ' good ';
            } else {
                $this->errorMessage = 'Неверный ввод ';
            }
        }
    }

    public function actionFormRegister()
    {
        $this->view->render('register_view.php','template_view.php');
    }

    /**
     * Проверка пользовательского ввода
     *
     */
    public function checkInputs($inputs)
    {
        if (!isset($input['submitted'])) {

        }

        return true;
    }

    /**
     * Модель - это информационная модель. В ней не должно быть действий!
     * Действие, в данном случае регистрация, это область ответственности
     * контроллеров!
     */
    public function register($data)
    {
        var_dump($data);
//        if (!is_null($data)) {
//            if ($data['password'] === $data['password_check']) {
//                array_pop($data);
//                $this->repository->add($data);
//            }
//        }
    }

    /**
     * Функция для проверки длины input'а
     * @param string $value - input field
     * @param $min
     * @param $max
     * @return bool
     */
    protected function checkLength($value = "", $min, $max) {
        echo $value . " ";
        $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
        echo $result . " ";
        return !$result;
    }

    /**
     * Отчиста данных от html и php тегов
     * @param string $value
     * @return string
     */
    protected function clean($value = "") {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        return $value;
    }


}
