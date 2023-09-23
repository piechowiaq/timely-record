<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class SendEmailRegistrationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(User $user): MailMessage
    {
        $registrationUrl = $this->registrationUrl($user);

        return $this->buildMailMessage($registrationUrl, Str::ucfirst($user->name));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    /**
     * Get the verify email notification mail message for the given URL.
     *
     * @param string $url
     * @return MailMessage
     */
    protected function buildMailMessage(string $url, string $name): MailMessage
    {
        return (new MailMessage)
            ->greeting(Lang::get('Hello '.$name.'!'))
            ->line(Lang::get('Please click the link below to finalize user registration process.'))
            ->action(Lang::get('Register'), $url)
            ->line(Lang::get('Thank you for using our application!'));
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param User $user
     * @return string
     */

    protected function registrationUrl(User $user): string
    {
        $token = Password::createToken($user);

        return route('user.register', ['token' => $token, 'email' => $user->getEmailForVerification()]);
    }

}
