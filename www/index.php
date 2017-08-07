<?php

ini_set('display_errors', 1);
require_once '../application/bootstrap.php';
function my_autoload($className)
{
    $className = str_replace('\\',DIRECTORY_SEPARATOR,$className);
    require_once __DIR__.DIRECTORY_SEPARATOR. $className . '.php';
}


// автозагрузка классов
spl_autoload_register('my_autoload');



?>

