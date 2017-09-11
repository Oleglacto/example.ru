<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 15:10
 */
namespace application\core;

/**
 * А может еще больше пробелов? :)
 */



class Route
{
    /**
     * А для чего свойства статичные? Я вообще не вижу чтоб ты где-то еще их юзал.
     * Без надобности не надо статик совать.
     * А, статичные потому что у тебя мтеоды статичные. А зачем стаитичные методы?)
     * Статика - это ПЛОХО в 90% случаев.
     * Ну-ка напиши мне, зачем тут все статик
     *
     * И еще, почему приватные? А если я захочу, допустим, отнаследоваться и переопределить?
     * Может же быть такой юзкейс
     */

    // контроллер и действие по умолчанию

    /**
     * А зачем тут модель? Роутер должен работать только с
     * контроллерами и экшенами. Про модели он не должен ничего знать.
     * Контроллер может работать не только с 1 моделью
     */
    private static $modelName = 'model';
    private static $controllerName = 'Site';
    private static $actionName = 'index';


    public static function start()
    {

        /**
         * А ты проверял, что будет если придут разыне урлы?
         * ну там если localhost.loc/ напрмиер, т.е. Запрос к корню сайта?
         * Надо бы затетсить, если не тестил
         */
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
            //self::ErrorPage404();
        }

        // создаем контроллер
        $controllerName = '\\application\\controllers\\'.self::$controllerName;
        $controller = new $controllerName;

        /**
         * Найс мув. Сначала запихнули значение в статки свойство, чтобы потом
         * из статик свойства запихнуть в обычную переменную. Зачем? :)
         */
        $action = self::$actionName;

        if (method_exists($controller, $action)) {
            // вызываем действие контроллера
            $controller->$action();
        } else {
            //self::ErrorPage404();
        }

    }

    private function setPrefix($controller, $action = null)
    {
        /**
         * А зачем тут модель? Роутер должен работать только с
         * контроллерами и экшенами. Про модели он не должен ничего знать.
         * Контроллер может работать не только с 1 моделью
         */
        self::$modelName = $controller;
        self::$controllerName = 'Controller'.$controller;
        self::$actionName = 'action'.$action;
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
