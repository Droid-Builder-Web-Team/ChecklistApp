<?php

namespace App\Http\Controllers;

use App\Droid;
use Notification;
use Illuminate\Http\Request;
use App\Notifications\NewDroid;
use Illuminate\Notifications\Notifiable;

class NotifyController extends Controller
{
    public function index()
    {
        $user->notify(new NewDroid($droid));
    }
}
