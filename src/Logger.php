<?php

namespace Mars\Logging;

use Monolog\Formatter\LineFormatter;
use Monolog\Logger as MonoLogger;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;

class Logger extends LogLevel implements LoggerInterface
{
    /**
     * Variable to instance Monolog
     * @var Logger
     */
    protected $logger;

    /**
     * Default log path
     * @var null|string
     */
    protected $path = 'path/log';

    /**
     * Default log name
     * @var null|string
     */
    protected $name = 'MarsLogger';

    /**
     * Default level
     * @var string
     */
    protected $defaultLevel = self::DEBUG;

    /**
     * Logger constructor
     *
     * @param null $path
     */
    public function __construct($path = null)
    {
        if ($path !== null)
            $this->path = $path;

        $this->logger = new MonoLogger($this->name);
    }

    /**
     * Logger Debug
     *
     * @param string $message
     * @param array $context
     */
    public function debug($message, array $context = array())
    {
        $this->writeLog(self::DEBUG, $message, $context);
    }

    /**
     * Logger Debug
     *
     * @param string $message
     * @param array $context
     */
    public function critical($message, array $context = array())
    {
        $this->writeLog(self::CRITICAL, $message, $context);
    }

    /**
     * Logger Debug
     *
     * @param string $message
     * @param array $context
     */
    public function alert($message, array $context = array())
    {
        $this->writeLog(self::ALERT, $message, $context);
    }

    /**
     * Logger Debug
     *
     * @param string $message
     * @param array $context
     */
    public function warning($message, array $context = array())
    {
        $this->writeLog(self::WARNING, $message, $context);
    }

    /**
     * Logger Debug
     *
     * @param string $message
     * @param array $context
     */
    public function error($message, array $context = array())
    {
        $this->writeLog(self::ERROR, $message, $context);
    }

    /**
     * Logger Debug
     *
     * @param string $message
     * @param array $context
     */
    public function info($message, array $context = array())
    {
        $this->writeLog(self::INFO, $message, $context);
    }

    /**
     * Logger Debug
     *
     * @param string $message
     * @param array $context
     */
    public function emergency($message, array $context = array())
    {
        $this->writeLog(self::EMERGENCY, $message, $context);
    }

    /**
     * Logger Debug
     *
     * @param string $level
     * @param string $message
     * @param array $context
     */
    public function log($level, $message, array $context = array())
    {
        $this->writeLog($level, $message, $context);
    }

    /**
     * Logger Debug
     *
     * @param string $message
     * @param array $context
     */
    public function notice($message, array $context = array())
    {
        $this->writeLog(self::NOTICE, $message, $context);
    }

    /**
     * Write log files
     * @param $level
     * @param $message
     * @param array|null $context
     * @return string
     */
    protected function writeLog($level, $message, array $context = null)
    {
        try {
            $dateFormat = "Y-m-j H:m:s";
            $output = (!$context) ? "%datetime% - %level_name%: %message%\n" :
                "%datetime% - %level_name%: %message% %context% %extra%\n";

            $formatter = new LineFormatter($output, $dateFormat);
            $stream = new StreamHandler(__DIR__ . '/' . $this->path, $level);
            $stream->setFormatter($formatter);
            $this->logger->pushHandler($stream);

            if ($this->logger->{$level}($message)) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
