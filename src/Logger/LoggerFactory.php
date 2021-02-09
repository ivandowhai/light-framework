<?php

declare(strict_types=1);

namespace Light\Logger;

use Light\Logger\TextLogger;
use Light\Config\Config;
use Psr\Log\LoggerInterface;

class LoggerFactory
{
    public static function getDefaultLogger() : LoggerInterface
    {
        switch (Config::getInstance()->get('app', 'defaultLogger')) {
            case 'text':
                return new TextLogger();

            default:
                return new TextLogger();
        }
    }
}
