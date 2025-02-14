<?php

namespace App\Providers;

use App\Services\TelegramBotService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class TelegramBotServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(TelegramBotService::class, function (Application $app) {
            return new TelegramBotService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
