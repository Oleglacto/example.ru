<?php

ini_set('display_errors', 1);


function errorHandler($exception){
    $log = new \application\helpers\Log();
    $log->writeLog($exception->getMessage());
}
function my_autoload($className)
{
    $className = str_replace('\\',DIRECTORY_SEPARATOR, $className);
    $file = __DIR__.'/..'.DIRECTORY_SEPARATOR . $className . '.php';
    if(file_exists($file)){
        require_once $file;
    }
}


// автозагрузка классов
spl_autoload_register('my_autoload');
//обработчик ошибок
set_exception_handler('errorHandler');
require_once '../application/bootstrap.php';





?>

