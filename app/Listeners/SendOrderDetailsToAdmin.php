<?php

namespace App\Listeners;

use App\Events\UserPlacedAnOrder;
use App\Mail\NewOrders;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

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
        Mail::to('admin@marktimbol.com')->send(new NewOrders($event->user, $event->order));
        
        // Mail::send('emails.admin.new-order', [$event->user, $event->order], function($mail) {
        //     $mail->to('admin@marktimbol.com');
        //     $mail->subject('New Order');
        // });
    }
}
