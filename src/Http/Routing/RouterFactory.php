<?php

declare(strict_types=1);

namespace Light\Http\Routing;

use Light\ {
    App,
    Config\Config
};

class RouterFactory
{
    public static function makeRouter() : Router
    {
        $routes = require_once App::PROJECT_PATH
            . Config::getInstance()->get('app', 'routesPath');
        return new Router($routes);
    }
}