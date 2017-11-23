<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 15.08.17
 * Time: 10:24
 */
namespace application\models;

use application\core\BaseModel;
use application\repositories\UserRepository;


class User extends BaseModel
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    /**
     * А вот это как раз должно быть в модели юзера!
     * В репозитории только запросы. Это похоже на зарос? нет.
     * Это чето типо бизнес логики, ее часть. Хеширование паролей юзера.
     */
    protected function setPassword($password)
    {
        return password_hash($password,PASSWORD_DEFAULT);
    }
}
