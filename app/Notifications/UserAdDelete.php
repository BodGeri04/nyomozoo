<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\advertisement;

class UserAdDelete extends Notification
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
                    ->subject('Hirdetésed automatikus törlése')
                    ->line('A(z) '. $this->advertisement->id . ' azonosítójú, '. $this->advertisement->title . ' nevezetű hirdetésedet archiváltuk.')
                    ->action('A még aktív feltöltéseidet megtekintheted itt', url('/website/sajatHirdetesek'))
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
