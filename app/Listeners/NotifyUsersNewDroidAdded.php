<?php

namespace App\Listeners;

use App\Events\NewDroidAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyUsersNewDroidAdded
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
     * @param  NewDroidAdded  $event
     * @return void
     */
    public function handle(NewDroidAdded $event)
    {
        $droid = $event->droid; // We just saved it above!
        // Send a notification and whatever here
    }
}
