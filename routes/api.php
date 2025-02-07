<?php

use App\Http\Controllers\AuthController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

JsonApiRoute::server('v1')->prefix('v1')->resources(function (ResourceRegistrar $server) {
    $server->resource('contacts', JsonApiController::class);
    $server->resource('clients', JsonApiController::class);
});
