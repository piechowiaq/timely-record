<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Validation\Rules;

class RegisterUserController extends Controller
{
    public function create(Request $request): Response
    {
        $user = User::where('email',$request->email)->first();

        $user->markEmailAsVerified();

            return Inertia::render('Auth/RegisterUser', [
                'email' => $request->email,
                'token' => $request->route('token'),
                'name'  => $user->name
            ]);
    }

    public function send($id)
    {

        dd($id);

        $user = User::where('id', $id)->first();

        $token = app('auth.password.broker')->createToken($user);

        $url = route('user.register', ['token' => $token, 'email' => $user->email]);

        $user->notify(new \App\Notifications\RegisterUser($url,  $user->name));

        return back()->with('status', 'verification-link-sent');
    }
}
