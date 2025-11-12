<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('payment.{checkoutRequestId}', function ($user = null, $checkoutRequestId) {
    // You can add authorization here, e.g., check if $user owns this payment
    // For now, return true to allow listening
    return true;
});
