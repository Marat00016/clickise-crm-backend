<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;
use LaravelJsonApi\Laravel\Routing\ResourceRegistrar;
use LaravelJsonApi\Laravel\Routing\Relationships;

Route::get('/user', function (Request $request) {
    return $request->user();
//})->middleware('auth:sanctum');
})->middleware('auth:api');

JsonApiRoute::server('v1')->prefix('v1')->resources(function (ResourceRegistrar $server) {
    Route::prefix('auth')->group(function () {
        Route::post('/login', [\App\Http\Controllers\Api\V1\AuthController::class, 'login']);
        Route::middleware(['auth:api'])->group(function () {
            Route::get('/me', [\App\Http\Controllers\Api\V1\AuthController::class, 'me']);
            Route::get('/logout', [\App\Http\Controllers\Api\V1\AuthController::class, 'logout']);
            Route::get('/refresh', [\App\Http\Controllers\Api\V1\AuthController::class, 'refresh']);
        });
    });

    $server->resource('users', JsonApiController::class);
    $server->resource('contacts', JsonApiController::class);
    $server->resource('clients', JsonApiController::class);
});
