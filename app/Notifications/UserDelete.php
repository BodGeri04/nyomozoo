<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserDelete extends Notification
{
    use Queueable;
    private $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user=$user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Felhasználói fiók törlése')
                    ->line('Kérésedre töröltük fiókodat. A továbbiakban nem lesz lehetőséged belépni az oldalra, valamint számos funkció használata válik elérhetetlenné.')
                    ->line("\r")
                    ->line('Hálásak lennénk, ha megosztanád velünk miért hagytad el az oldalt.')
                    ->line("\r")
                    ->line('Amennyiben nem te kérted, hogy töröljük fiókodat, vedd fel velünk a kapcsolatot az info@nyomozoo.hu címen.')
                    ->line("\r")
                    ->line('Köszönjük, hogy a Nyomozoo.hu-t választottad.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
