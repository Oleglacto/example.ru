<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 15:10
 */
namespace application\core;





class Route
{
    // контроллер и действие по умолчанию
    private static $modelName = 'model';
    private static $controllerName = 'Site';
    private static $actionName = 'index';


    public static function start()
    {

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // получаем имя контроллера
        if (!empty($routes[1])) {
            self::$controllerName = ucfirst($routes[1]);

        }

        // получаем имя экшена
        if (!empty($routes[2])) {
            self::$actionName = $routes[2];
        }

        // добавляем префиксы
        self::setPrefix(self::$controllerName,self::$actionName);

        // подцепляем файл с классом модели (файла модели может и не быть)
        $modelFile = self::$modelName.'.php';
        $modelPath = "../application/models/".$modelFile;

        if (file_exists($modelPath)) {
            require $modelPath;
        }

        // подцепляем файл с классом контроллера
        $controllerPath = '../application/controllers/'.self::$controllerName.'.php';
        if (file_exists($controllerPath)) {
            require $controllerPath;
        } else {
            self::ErrorPage404();
        }

        // создаем контроллер
        $controllerName = '\\application\\controllers\\'.self::$controllerName;
        $controller = new $controllerName;
        $action = self::$actionName;

        if (method_exists($controller, $action)) {
            // вызываем действие контроллера
            $controller->$action();
        } else {
            self::ErrorPage404();
        }

    }

    private function setPrefix($controller, $action = null)
    {
        self::$modelName = $controller;
        self::$controllerName = 'Controller'.$controller;
        self::$actionName = 'action'.$action;
    }


    private function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}
