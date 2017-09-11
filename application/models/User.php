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

    public function checkInput($input)
    {
        if (!isset($input['submitted'])) {
            return false;
        }

        return true;
    }

    public function register($data)
    {
        var_dump($data);
        if (!is_null($data)) {
            if ($data['password'] === $data['password_check']) {
                array_pop($data);
                $this->repository->add($data);
            }
        }
    }
}
