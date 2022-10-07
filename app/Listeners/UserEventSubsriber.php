<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Queue\InteractsWithQueue;

class UserEventSubsriber
{
    public function handleUserLoggedIn($event)
    {

    }

    public function handleRegistered($event)
    {

    }

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            UserLoggedIn::class,
            [UserEventSubsriber::class, 'handleUserLoggedIn']
        );

        $events->listen(
            Registered::class,
            [UserEventSubsriber::class, 'handleRegistered']
        );
    }
}
