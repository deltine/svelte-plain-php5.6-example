<?php

class Logger
{
    private $path = '/var/tmp/error_test.log';
    // private $currentdate = date("m/d H:i:s");

    public function logPrint($message)
    {
        $currentdate = date("m/d H:i:s");
        $logmessages = $this->currentdate . " : " . $message;
        error_log($logmessages . "\n", 3, $this->path);
    }

    public function debug($message)
    {
        $this->logPrint("[debug]" . $message);
    }

    public function info($message)
    {
        $this->logPrint("[info]" . $message);
    }

    public function error($message)
    {
        $this->logPrint("[error]" . $message);
    }
};
