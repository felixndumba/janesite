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
    public function boot()
    {
        // Force HTTPS when on production or ngrok tunnel
         $appUrl = config('app.url');

        // Force HTTPS when in production OR when using ngrok (secure tunnels)
        if (config('app.env') === 'production' || str_starts_with($appUrl, 'https://') || str_contains(request()->getHost(), 'ngrok')) {
            \URL::forceScheme('https');
        }
    }
}
