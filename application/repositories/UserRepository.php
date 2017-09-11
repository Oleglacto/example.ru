<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 14.08.17
 * Time: 13:56
 */
namespace application\repositories;

class UserRepository extends BaseRepository
{
    protected $table = 'users';

    public function add($data)
    {
        $data['password'] = $this->setPassword($data['password']);
        parent::add($data);
    }


    public function editPassword()
    {

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