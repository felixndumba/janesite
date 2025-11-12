<?php
namespace App\Events;

use App\Models\Payment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow; 
use Illuminate\Queue\SerializesModels;

class PaymentUpdated implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function broadcastOn()
    {
        return new PrivateChannel("payment.{$this->payment->checkout_request_id}"); // private channel
    }

    public function broadcastAs()
    {
        return 'payment.update';
    }
}
