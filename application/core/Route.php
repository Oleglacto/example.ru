<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 15:10
 */
namespace application\core;



use application\controllers\ControllerMain;

class Route
{
    static function start()
    {
        // контроллер и действие по умолчанию
        $controllerName = 'Main';
        $actionName = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // получаем имя контроллера
        if ( !empty($routes[1]) )
        {
            $controllerName = ucfirst($routes[1]);

        }

        // получаем имя экшена
        if ( !empty($routes[2]) )
        {
            $actionName = $routes[2];
        }

        // добавляем префиксы
        $modelName = 'Model_'.$controllerName;
        $controllerName = 'Controller'.$controllerName;
        $actionName = 'action'.$actionName;

        // подцепляем файл с классом модели (файла модели может и не быть)

        $modelFile = strtolower($modelName).'.php';
        $modelPath = "/application/models/".$modelFile;
        if(file_exists($modelPath))
        {
            include "/application/models/".$modelFile;
        }

        // подцепляем файл с классом контроллера
        $controllerPath = '../application/controllers/'.$controllerName.'.php';
        if(file_exists($controllerPath))
        {
            require $controllerPath;
        }
        else
        {
            /*
            правильно было бы кинуть здесь исключение,
            но для упрощения сразу сделаем редирект на страницу 404
            */
            Route::ErrorPage404();
        }

        // создаем контроллер
        var_dump('ControllerMain' == $controllerName);
        $controller = new $controllerName();
        $action = $actionName;

        if(method_exists($controller, $action))
        {
            // вызываем действие контроллера
            $controller->$action();
        }
        else
        {
            // здесь также разумнее было бы кинуть исключение
            Route::ErrorPage404();
        }

    }


    function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}
