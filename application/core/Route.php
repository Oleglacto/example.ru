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
            //self::ErrorPage404();
        }

        // создаем контроллер
        $controllerName = '\\application\\controllers\\' . $this->controllerName;
        $controller = new $controllerName;
        $action = $this->actionName;

        if (method_exists($controller, $action)) {
            // вызываем действие контроллера
            $controller->$action();
        } else {
//            echo(\Exception()::getCode);
        }

    }

    protected function setPrefix($controller, $action = null)
    {
        $this->controllerName = 'Controller' . $controller;
        $this->actionName = 'action' . $action;
    }


    private function ErrorPage404()
    {

        /**
         * При ошибке должны выбрасываться исключения. Особенно в core.
         * Это ЯДРО. Это не сайт. на ядре может базироваться много твоих сайтов.
         * Отнсаледуйся от базового класса exception, сделай свое исключение, если нет
         * нужного из коробки, и брсоай его. В к оде ПРИЛОЖЕНИЯ, а не ядра, можно ловить
         * исклчение и как надо его обрабатывать
         */
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}
