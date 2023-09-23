<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailRegistrationNotificationController extends Controller
{
    /**
     * Send a new email registration notification.
     */
    public function store(User $user): RedirectResponse
    {

//        if ($request->user()->hasVerifiedEmail()) {
//            return redirect()->intended(RouteServiceProvider::HOME);
//        }

        $user->notify(new \App\Notifications\SendEmailRegistrationNotification());

        return back()->with('status', 'registration-link-sent');
    }
}
