<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        // Example:
        // 'App\Events\PaymentUpdated' => [
        //     'App\Listeners\NotifyUserOfPayment',
        // ],
    ];

    public function boot(): void
    {
        parent::boot();
    }
}
