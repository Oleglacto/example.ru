<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 31.01.18
 * Time: 23:16
 */

namespace application\components;


use application\models\User;
use application\repositories\UserRepository;

class AuthorizationGuard
{
    protected static $instance = null;

    /*
     * Текущий пользователь
     */
    protected $currentUser;

    protected $errors = [];

    /*
     * Экземпляр класса Security
     */
    protected $security;

    /*
     * Экземпляр класса UserRepository
     */
    protected $userRepository;

    // это называется инъекция зависимостей.
    // оч плозо делать new Class Где-то там внутри
    // а так все зависимости видны в сигнатуре конструктора
    // есть такая штуа как контейнер внедреня зависимостей,
    // он модет сам подставлять зависимости
    //  у нас такого нет, так что будешь делать new Class внутри констркутора


    private function __construct()
    {
        // так делать нельзя, но допускается
        // в рамках данного проекта.
        $this->security = new Security();
        $this->userRepository = new UserRepository();
    }

    // вот через этот метод мы будем получать инстанс
    // если класс не был инстанцирован, делаем это
    // если был, пропускаем этот шаш и сразу возвращаем инстанс
    // итого: у нас всегда будет один и тот же экзмепляр этого класса
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    // простой геттер
    public function getCurrentUser()
    {
        return $this->currentUser;
    }

    // простой сеттер
    public function setCurrentUser(User $user)
    {
        return $this->currentUser = $user;
    }

    // регистрация
    public function registerUser(array $data)
    {
        $data['password'] = $this->security->encode($data['password']);
        unset($data['password_check']);
        if ($this->userRepository->add($data)) {
            return true;
        } else {
            $this->errors[] = $this->userRepository->getError();
            return false;
        }

    }

    // авторизация
    public function authUser(array $data)
    {
        $user = new User();
        if (isset($_COOKIE['isAuth'])) {
            $result = $this->userRepository->get(['cookie' => $_COOKIE['isAuth']]);
            if (!empty($result)) {
                $user->getByEmail($result[0]['email']);
                $this->setCurrentUser($user);
                return true;
            }
            setcookie('isAuth', '', strtotime( '-1 days' ));
            return false;

        }
        $passwordHash = $this->userRepository->get(['email' => $data['email']], 'password');
        $success = $this->security->checkPassword($data['password'], $passwordHash[0]['password']);
        if (!$success) {
            return false;
        }
        $user->getByEmail($data['email']);
        $cookie = $this->security->encode($data['email'] . $passwordHash[0]['password']);
        setcookie('isAuth', $cookie, strtotime('+30 days'));
        $this->userRepository->edit($user->getId(), ['cookie' => $cookie]);
        $this->setCurrentUser($user);


        // как-то там ищем бзера, возможно используя репозиторий
        // используем секьюрити компонет чтобы сравнивать пароли
        // как итог мы нашли модельку юзера который логинится
        //$user = someMagic(...);

        // и дальше в коде мы где угодно через этот компонеит
        // можем изи получать модель залогиненного юзера
        //$this->setCurrenUser($user);

        return true;  //smth|bool|User|че там надо;
      }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}