<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 23.11.17
 * Time: 22:46
 */

namespace application\helpers;


class Log
{
    /**
     * расположение файла error.log
     * @var $file
     */
    protected $file = __DIR__ . '/../../logs/error.log';

    /**
     * Сообщение ошибки
     * @var $message
     */
    protected $message;

    /**
     * Время ошибки
     * @var $time
     */
    protected $time;

    public function writeLog($message)
    {
        $this->time = date("H:i:s");
        $this->message = $this->time . " ";
        $this->message .= $message . PHP_EOL;
        file_put_contents($this->file, $this->message, FILE_APPEND | LOCK_EX);
    }
}