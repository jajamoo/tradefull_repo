<?php

namespace App\Listeners;

use App\Events\CheckInStateOrdersEvent;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteOrdersListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CheckInStateOrdersEvent  $event
     * @return void
     */
    public function handle(CheckInStateOrdersEvent $event)
    {
        if($event->order->state != 'OH') {
            Order::where(['id' => $event->order->id])->delete();
        }
    }
}
