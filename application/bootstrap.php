<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 01.08.17
 * Time: 15:09
 */
namespace application;

use \application\core\Route;



require_once 'core/BaseModel.php';
require_once 'core/BaseView.php';
require_once 'core/BaseController.php';
require_once 'core/Route.php';


Route::start(); // запускаем маршрутизатор