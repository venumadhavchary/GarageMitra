<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        config(['trustedproxies' => ['10.0.1.0/24']]);
        // Force HTTPS in production only
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
