<?php

namespace Martians\Log;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class Log
{

    CONST LOG_LEVELS = [
        'debug' => Logger::DEBUG,
        'info' => Logger::INFO,
        'notice' => Logger::NOTICE,
        'warning' => Logger::WARNING,
        'error' => Logger::ERROR,
        'critical' => Logger::CRITICAL,
        'alert' => Logger::ALERT,
        'emergency' => Logger::EMERGENCY,
    ];

    protected $logger;

    protected $path = 'path/log';

    protected $name = 'MARS';

    protected $type = 'debug';


    public function __construct($path = null, $type = null, $name = null)
    {
        if ($path !== null)
            $this->path = $path;

        if ($type !== null)
            $this->type = $type;

        if ($name !== null)
            $this->name = $name;
    }

    public function writeLog($content = null, array $data = [])
    {
        $this->logger =  new Logger($this->name);

        $this->logger->pushHandler(new StreamHandler(__DIR__.'/'.$this->path, self::LOG_LEVELS[$this->type]));
        $this->logger->pushHandler(new FirePHPHandler());

        $this->run($content, $data);
    }

    public function run($content, $data)
    {
        return $this->logger->{$this->type}($content, $data);
    }
}