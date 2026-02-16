<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ApexFetchService;

class ApexFetchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('apex-fetch', function ($app) {
            return new ApexFetchService();
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
