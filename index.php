<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/ivandowhai/light-framework/src/Autoloader.php';


use Light\ {
    App,
    Autoloader,
    DependenciesLoader,
    Http\Routing\RouterFactory
};

spl_autoload_register(new Autoloader());

(new App(RouterFactory::makeRouter(), new DependenciesLoader()))
    ->handleRequest();

