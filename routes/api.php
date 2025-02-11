<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;
use LaravelJsonApi\Laravel\Routing\ResourceRegistrar;
use LaravelJsonApi\Laravel\Routing\Relationships;

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
    $server->resource('clients', JsonApiController::class)
        ->relationships(function (Relationships $relations) {
            $relations->hasMany('contacts');
        });
    $server->resource('contacts', JsonApiController::class)
        ->relationships(function (Relationships $relations) {
            $relations->hasMany('dialogs');
            $relations->hasOne('messages');
            $relations->hasOne('clients');
            $relations->hasOne('sales-statuses');
            $relations->hasOne('support-statuses');
        });
    $server->resource('dialogs', JsonApiController::class)
        ->relationships(function (Relationships $relations) {
            $relations->hasMany('users');
            $relations->hasMany('contacts');
            $relations->hasMany('messages');
            $relations->hasOne('bots');
        });
    $server->resource('messages', JsonApiController::class)
        ->relationships(function (Relationships $relations) {
            $relations->hasOne('dialogs');
            $relations->hasOne('contacts');
        });
    $server->resource('roles', JsonApiController::class)
        ->relationships(function (Relationships $relations) {
            $relations->hasMany('users');
        });
    $server->resource('sales-statuses', JsonApiController::class)
        ->relationships(function (Relationships $relations) {
            $relations->hasMany('contacts');
        });
    $server->resource('support-statuses', JsonApiController::class)
        ->relationships(function (Relationships $relations) {
            $relations->hasMany('contacts');
        });
    $server->resource('spaces', JsonApiController::class)
        ->relationships(function (Relationships $relations) {
            $relations->hasMany('bots');
        });
    $server->resource('bots', JsonApiController::class)
        ->relationships(function (Relationships $relations) {
            $relations->hasOne('spaces');
            $relations->hasMany('dialogs');
        });
});
