<?php

use App\Http\Routing\Route;

return [
    new Route(
        'test/{id}',
        App\Http\Controllers\TestController::class,
        Route::GET
    )
];
