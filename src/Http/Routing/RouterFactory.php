<?php

declare(strict_types=1);

namespace Light\Http\Routing;

use Light\{App, Config\Config, Filesystem\Filesystem};

class RouterFactory
{
    public static function makeRouter() : Router
    {
        $filesystem = new Filesystem();
        $routes = require_once $filesystem->getPathInProject(
            Config::getInstance()->get('app', 'routesPath')
        );
        return new Router($routes);
    }
}