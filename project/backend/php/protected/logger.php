<?php

date_default_timezone_set('Asia/Tokyo');

class Logger
{
    private static $path = '/var/tmp/error_test.log';

    public static function logPrint($message)
    {
        $logMessages =  date("m/d H:i:s") . " : " . $message;
        error_log($logMessages . "\n", 3, Logger::$path);
    }

    public static function debug($message)
    {
        Logger::logPrint("[debug]" . $message);
    }

    public static function info($message)
    {
        Logger::logPrint("[info]" . $message);
    }

    public static function error($message)
    {
        Logger::logPrint("[error]" . $message);
    }
};
