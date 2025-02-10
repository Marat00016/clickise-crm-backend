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
        });
    $server->resource('contacts', JsonApiController::class)
        ->relationships(function (Relationships $relations) {
            $relations->hasMany('dialogs');
        });
    $server->resource('clients', JsonApiController::class);
    $server->resource('dialogs', JsonApiController::class)
        ->relationships(function (Relationships $relations) {
            $relations->hasMany('users');
            $relations->hasMany('contacts');
        });

    Route::get('/dialogs-users', function (Request $request) {
        $dialog = \App\Models\Dialog::find("9e2d6ffe-b345-4ae8-b943-c718e0683fae");
        $user = \App\Models\User::find(1);

        $dialog->users()->attach($user->id);
//        $dialog->users()->detach($user->id);

        $dialog = \App\Models\Dialog::find("9e2d6ffe-b345-4ae8-b943-c718e0683fae");
        return $dialog->users;
    });
});
