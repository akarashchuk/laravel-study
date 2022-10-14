<?php

namespace App\Services;

use App\Events\UserLoggedIn;
use App\Mail\EmailConfirm;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserService
{
    public function register(array $data): User
    {
        $user = new User($data);
        $user->save();

        Mail::to($user->email)->send(new EmailConfirm($user));

        return $user;
    }

    public function signIn(array $credentials, string $guard): ?User
    {
        $check = function ($user) {
            return $user->email_verified_at !== null;
        };

        if (Auth::guard($guard)->attemptWhen($credentials, $check)) {
            $user = auth($guard)->user();
            $event = new UserLoggedIn($user);
            event($event);

            return $user;
        }

        return null;
    }
}
