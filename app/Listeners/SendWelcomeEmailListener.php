<?php

namespace App\Listeners;

use App\Events\UserVerifiedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class SendWelcomeEmailListener
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
     * @param  UserVerifiedEvent  $event
     * @return void
     */
    public function handle(UserVerifiedEvent $event)
    {
        Mail::to($event->user)->send(new WelcomeEmail($event->user));
    }
}
