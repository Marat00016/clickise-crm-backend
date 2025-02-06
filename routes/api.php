<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;
use LaravelJsonApi\Laravel\Routing\ResourceRegistrar;
use LaravelJsonApi\Laravel\Routing\Relationships;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

JsonApiRoute::server('v1')->prefix('v1')->resources(function (ResourceRegistrar $server) {
    $server->resource('contacts', JsonApiController::class)
        ->readOnly()
        ->relationships(function (Relationships $relations) {
            $relations->hasOne('clients')->readOnly();
//            $relations->hasMany('comments')->readOnly();
//            $relations->hasMany('tags')->readOnly();
        });
    $server->resource('clients', JsonApiController::class)->readOnly();
});
