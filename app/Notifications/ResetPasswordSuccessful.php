<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class ResetPasswordSuccessful extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->afterCommit()->onQueue('high');
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
        return (new MailMessage)
        ->subject(Lang::get('Password Reset Successful'))
        ->greeting('Hello ' . Str::of($user->full_name)->before(' ') . '.')
        ->line(Lang::get('You have successfully reset your ' . config('app.name') . ' password. You can now log in to your dashboard using your new password by clicking the link below.'))
        ->line(Lang::get(
            'If you did not request a password reset, then your account has been compromised. ' .
            'You should change the password to this your email account immediately! Gaining access to your email account is the only way someone else could have reset your password successfully.'
        ))
        ->line(Lang::get('After you have changed your email password to a more secure password, you can proceed to secure your ' . config('app.name') . ' account immediately by requesting another pasword reset.'))
        ->action(Lang::get('Access Dashboard'), route('auth.login'))
        ->line(new HtmlString('If you require any further assistance, please send us an email at <a href="mailto:' . config('app.email') . '" target="_blank">' . config('app.email') . '</a>.'))
        ->with('Best regards,')
        ->salutation(config('app.name'));
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
}
