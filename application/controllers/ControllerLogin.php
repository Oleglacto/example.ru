<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 19:32
 */
namespace application\controllers;

use application\components\AuthorizationGuard;
use application\core\BaseController;
use application\components\Validator;

Class ControllerLogin extends BaseController{

    protected $guard;

    public function actionIndex()
    {
        $this->view->render('login_view.php','template_view.php');
    }

    /**
     * ControllerLogin constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->guard = AuthorizationGuard::getInstance();
    }

    public function actionRegister()
    {
        if (!isset($_POST['registerForm'])) {
            $this->view->render('register_view.php');
            throw new InvalidInputDataException();
            return false;
        }
        $data = $_POST['registerForm'];
        $rules = [
            'name' => 'string|required',
            'phone' => 'string|phone|unique',
            'email' => 'string|required|email|unique',
            'password' => 'string|required|password',
            'password_check' => 'string|required'
        ];

        // Валидация
        $validation = new Validator();
        $formIsValid = $validation->validate($data, $rules);
        if($formIsValid) {
            if ($this->guard->registerUser($data)) {
                $this->view->render('register_view.php', ['success' => 'Регистрация прошла успешно :)']);
                return true;
            }

            $this->view->render('register_view.php', ['errors' => 'Что-то пошло не так... Попробуйте позже :)']);
        } else {
            $this->view->render('register_view.php', $validation->getErrors());
        }
    }

    /**
     *
     */
    public function actionLogin(){

        if (!isset($_POST['loginForm'])) {
            echo "error";
        }

//        var_dump($_POST['loginForm']['email']);
        $validation = new Validator();
        $rules = [
            'email' => 'string|required|email',
            'password' => 'string|required|password'
        ];
        $formIsValid = $validation->validate($_POST['loginForm'], $rules);
        if ($formIsValid) {
            if ($this->guard->authUser($_POST['loginForm'])) {
                echo "good";
            }
        }


    }

    public function actionFormRegister()
    {
        $this->view->render('register_view.php','template_view.php');
    }

}
