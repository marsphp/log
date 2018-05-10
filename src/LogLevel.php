<?php

namespace Mars\Logging;

/**
 * Describes log levels
 */
abstract class LogLevel
{
    CONST DEBUG = 'debug';
    CONST INFO = 'info';
    CONST NOTICE = 'notice';
    CONST WARNING = 'warning';
    CONST ERROR = 'error';
    CONST CRITICAL = 'critical';
    CONST ALERT = 'alert';
    CONST EMERGENCY = 'emergency';

    abstract protected function writeLog($level, $message, array $context = null);
}
