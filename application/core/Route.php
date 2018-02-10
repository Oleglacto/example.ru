<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 15:10
 */
namespace application\core;

use application\helpers\MyException;

class Route
{
    protected $controllerName = 'Site';
    protected $actionName = 'index';

    public function start()
    {
        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // получаем имя контроллера
        if (!empty($routes[1])) {
            $this->controllerName = ucfirst($routes[1]);

        }

        // получаем имя экшена
        if (!empty($routes[2])) {
            $this->actionName = $routes[2];
        }

        // добавляем префиксы
        $this->setPrefix($this->controllerName, $this->actionName);

        // подцепляем файл с классом контроллера
        $controllerPath = '../application/controllers/' . $this->controllerName . '.php';
        if (file_exists($controllerPath)) {
            require_once $controllerPath;
        } else {

        }

        // создаем контроллер
        $controllerName = '\\application\\controllers\\' . $this->controllerName;
        $controller = new $controllerName;
        $action = $this->actionName;

        if (method_exists($controller, $action)) {
            // вызываем действие контроллера
            $controller->$action();
        } else {

        }

    }

    protected function setPrefix($controller, $action = null)
    {
        $this->controllerName = 'Controller' . $controller;
        $this->actionName = 'action' . $action;
    }

}
