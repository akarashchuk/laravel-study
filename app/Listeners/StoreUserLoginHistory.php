<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use App\Models\LoginHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreUserLoginHistory
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
         $entry = new LoginHistory();
         $entry->name = $event->user->name;
         $entry->email = $event->user->email;
         $entry->created_at = new \DateTime();

         $entry->save();
    }
}
