<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;


class EmailRegistrationNotificationController extends Controller
{
    /**
     * Send a new email registration notification.
     */
    public function store(User $user): RedirectResponse
    {
        $user->notify(new \App\Notifications\SendEmailRegistrationNotification());

        return Redirect::route('users.index')->with('success', 'Registration email sent.');
    }
}
