<?php

use Light\Http\Routing\Route;

return [
    new Route(
        '',
        Light\Http\Controllers\TestController::class,
        [Route::GET]
    )
];
