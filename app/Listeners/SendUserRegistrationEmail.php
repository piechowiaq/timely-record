<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Mail\UserRegistration;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendUserRegistrationEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        Mail::to($event->user->email)->send(new UserRegistration($event->uri));
    }
}
