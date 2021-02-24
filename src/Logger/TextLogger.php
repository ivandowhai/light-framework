<?php

declare(strict_types=1);

namespace Light\Logger;

use Light\Filesystem\Filesystem;
use Psr\Log\LoggerInterface;

class TextLogger implements LoggerInterface
{
    public function log($level, $message, array $context = array())
    {
        $filesystem = new Filesystem();
        $filesystem->writeToFile(
            $filesystem->getPathInProject('log/' . $level . '-' . date('Y-m-d') . '.log'),
            $message
        );
    }

    public function emergency($message, array $context = array())
    {
        $this->log('emergency', $message, $context);
    }

    public function alert($message, array $context = array())
    {
        $this->log('alert', $message, $context);
    }

    public function critical($message, array $context = array())
    {
        $this->log('critical', $message, $context);
    }

    public function error($message, array $context = array())
    {
        $this->log('error', $message, $context);
    }

    public function warning($message, array $context = array())
    {
        $this->log('warning', $message, $context);
    }

    public function notice($message, array $context = array())
    {
        $this->log('notice', $message, $context);
    }

    public function info($message, array $context = array())
    {
        $this->log('info', $message, $context);
    }

    public function debug($message, array $context = array())
    {
        $this->log('debug', $message, $context);
    }
}
