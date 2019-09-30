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
use application\components\Security;

class User extends BaseModel
{
    protected $table = 'users';

    protected $id;

    protected $email;

    protected $isAdmin = false;

    protected $age;


    public function getByEmail($email)
    {
        $repository = new UserRepository();
        $data = $repository->get(['email' => $email]);
        if(!empty($data)) {
            $this->setData($data[0]);
            return true;
        }

        return false;
    }

    protected function setData(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this,$key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


}
