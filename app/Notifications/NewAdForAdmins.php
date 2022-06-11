<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\advertisement;
class NewAdForAdmins extends Notification
{
    use Queueable;
    private $advertisement;
    /**
     * Create a new notification instance.
     *@param advertisement $advertisement
     * 
     * @return void
     */
    public function __construct(advertisement $advertisement)
    {
        $this->advertisement=$advertisement;
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
                    ->subject('Új hirdetés jóváhagyása')
                    ->line('Kedves Adminisztrátorok!')
                    ->line('Egy új hirdetést regisztráltak az oldalra. Ahhoz, hogy ez publikus legyen, jóvá kell hagynia egy Adminnak.')
                    ->line('A hirdetés címe: ' . $this->advertisement->title) ->line('Az állat neve: ' . $this->advertisement->name)
                    ->line('Az eltűnés dátuma: ' . $this->advertisement->disappeared)
                    ->action('Itt tudja jóváhagyni a hirdetést', url('/website/advertisement'))
                    ->line('Köszönöm.');
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
