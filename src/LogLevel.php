<?php

namespace Mars\Logging;

/**
 * Describes log levels
 */
abstract class LogLevel
{
    const DEBUG = 'debug';
    const INFO = 'info';
    const NOTICE = 'notice';
    const WARNING = 'warning';
    const ERROR = 'error';
    const CRITICAL = 'critical';
    const ALERT = 'alert';
    const EMERGENCY = 'emergency';

    abstract protected function writeLog($level, $message, array $context = null);
}
