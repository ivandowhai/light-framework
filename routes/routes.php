<?php

use Light\Http\Routing\Route;

return [
    new Route(
        'test',
        Light\Http\Controllers\TestController::class,
        Route::GET
    )
];
