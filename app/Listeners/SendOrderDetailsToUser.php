<?php

namespace App\Listeners;

use App\Events\UserPlacedAnOrder;
use App\Mail\OrderDetails;
use App\Notifications\YourOrderDetails;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderDetailsToUser
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
        Mail::to($event->user)->send(new OrderDetails($event->order));
        
        // Mail::send('emails.order-details-of-user', [$event->user, $event->order], function($mail) {
        //     $mail->to('mark.timbol@hotmail.com');
        //     $mail->subject('Your order details');
        // });
    }
}
