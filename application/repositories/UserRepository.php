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


    protected function setPassword($password)
    {
        return password_hash($password,PASSWORD_DEFAULT);
    }
}