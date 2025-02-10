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

    $server->resource('users', JsonApiController::class)
        ->relationships(function (Relationships $relations) {
            $relations->hasMany('dialogs');
            $relations->hasOne('roles');
        });
    $server->resource('clients', JsonApiController::class);
    $server->resource('contacts', JsonApiController::class)
        ->relationships(function (Relationships $relations) {
            $relations->hasMany('dialogs');
        });
    $server->resource('dialogs', JsonApiController::class)
        ->relationships(function (Relationships $relations) {
            $relations->hasMany('users');
            $relations->hasMany('contacts');
            $relations->hasMany('messages');
        });
    $server->resource('messages', JsonApiController::class)
        ->relationships(function (Relationships $relations) {
            $relations->hasOne('dialogs');
        });
    $server->resource('roles', JsonApiController::class)
        ->relationships(function (Relationships $relations) {
            $relations->hasMany('users');
        });
    $server->resource('sales-statuses', JsonApiController::class);
    $server->resource('support-statuses', JsonApiController::class);
});
