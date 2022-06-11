<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\advertisement;
class UserRestoredAd extends Notification
{
    use Queueable;
    private $advertisement;
    /**
     * Create a new notification instance.
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
                    ->subject('Hirdetésedet visszaállítottuk')
                    ->line('Tájékoztatunk, hogy kérésedre a(z) '. $this->advertisement->id . '. hirdetésedet újraaktiváltuk.')
                    ->line('Ahhoz, hogy ismét láthatóvá váljon, frissítened kell a megfelelő hirdetésed adatait.')
                    ->action('Itt frissítheted', url('/website/advertisement/'. $this->advertisement->id .'/edit'))
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
