<?php

declare(strict_types=1);

namespace Light\Http\Routing;

use Light\Config\Config;

class RouterFactory
{
    public static function makeRouter() : Router
    {
        $routes = require_once PROJECT_PATH
            . Config::getInstance()->get('app', 'routesPath');
        return new Router($routes);
    }
}