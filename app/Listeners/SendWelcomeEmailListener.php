<?php

namespace App\Listeners;

use Illuminate\Auth\Events\UserVerifiedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\WelcomeEmail;
use App\User;
use Illuminate\Support\Facades\Mail;

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
        Mail::to($event->user)->send(new WelcomeEmail());
    }
}
