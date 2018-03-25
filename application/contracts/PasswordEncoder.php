<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 30.12.17
 * Time: 0:20
 */

namespace application\contracts;


interface PasswordEncoder
{
    public function encode(string $password): string;

    public function checkPassword(string $password, string $hash): bool;

}