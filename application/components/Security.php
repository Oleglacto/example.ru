<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 05.01.18
 * Time: 17:45
 */

namespace application\components;

use application\contracts\PasswordEncoder;

class Security implements PasswordEncoder
{
    /**
     * Хэширофание пароля
     * @param string $password
     * @return string
     */
    public function encode(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function checkPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}