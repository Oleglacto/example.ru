<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 12.02.18
 * Time: 19:50
 */

namespace application;


use application\components\AuthorizationGuard;
use application\components\Request;
use application\core\Route;

class App
{
    protected static $instance = null;

    public $isAuth;

    private $route;

    public $guard;

    private function __construct()
    {
        $this->guard = AuthorizationGuard::getInstance();
        $this->route = new Route();
        $request = new Request();
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function run()
    {
        $this->isAuth = $this->guard->isAuthorized();

        $this->route->start();
    }

}