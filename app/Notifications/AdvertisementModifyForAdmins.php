<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\advertisement;
class AdvertisementModifyForAdmins extends Notification
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
                    ->subject('Módosított hirdetés jóváhagyása')
                    ->line('Kedves Adminisztrátorok!')
                    ->line('Egy meglévő hirdetést módosítottak. Ahhoz, hogy ez újra publikus legyen, jóvá kell hagynia egy moderátornak.')
                    ->line('A hirdetés címe: ' . $this->advertisement->title) ->line('Az állat neve: ' . $this->advertisement->name)
                    ->line('Az eltűnés dátuma: ' . $this->advertisement->disappeared)
                    ->action('Itt tudod jóváhagyni a hirdetést', url('/website/advertisement/'.$this->advertisement->id,'edit'))
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
