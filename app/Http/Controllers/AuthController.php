<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\SignInRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function signInForm()
    {
        return view('sign-in');
    }

    public function signIn(SignInRequest $request)
    {
        $credentials = $request->validated();

        $user = $this->userService->signIn($credentials, 'web');
        if ($user) {
            session()->flash('success', 'Signed In');

            return redirect()->route('main');
        }

        session()->flash('error', 'The provided credentials are incorrect');

        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
