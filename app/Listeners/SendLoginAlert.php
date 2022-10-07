<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use App\Mail\LoginAlert;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendLoginAlert
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

    public function handle(UserLoggedIn $event): void
    {
        Mail::to($event->user->email)->send(new LoginAlert());
    }
}
