<?php

require_once __DIR__ . '/vendor/autoload.php';

use Light\ {
    App,
    DependenciesLoader,
    Http\Routing\RouterFactory
};

(new App(RouterFactory::makeRouter(), new DependenciesLoader()))
    ->handleRequest();

