<?php

namespace App\Listeners;

use App\Events\UserPlacedAnOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderDetailsToAdmin
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
     * @param  UserPlacedAnOrder  $event
     * @return void
     */
    public function handle(UserPlacedAnOrder $event)
    {
        //
    }
}
