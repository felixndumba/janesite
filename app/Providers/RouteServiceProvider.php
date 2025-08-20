<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        parent::boot(); // make sure parent boot is called

        $this->routes(function () {
            // Load API routes
            Route::prefix('api')            // automatically adds /api to all routes in api.php
                ->middleware('api')        // applies api middleware group
                ->group(base_path('routes/api.php'));

            // Load Web routes
            Route::middleware('web')       // applies web middleware group
                ->group(base_path('routes/web.php'));
        });
    }
}
    