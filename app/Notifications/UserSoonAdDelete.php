<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\advertisement;

class UserSoonAdDelete extends Notification
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
                    ->subject('Hirdetésedet hamarosan töröljük')
                    ->line('Szeretnénk tájékoztatni, hogy inaktivítás miatt, a(z) '.  $this->advertisement->id . ' azonosítójú, '.  $this->advertisement->title  . ' nevezetű hirdetésedet 5 nap múlva törölni fogjuk.')
                    ->action('Erre a gombra kattintva tekintheted meg az elavult hirdetésedet', url('/website/advertisement/'.$this->advertisement->id.'/edit'))
                    ->line('Amennyiben nem szeretnéd a törlését, kérjük frissíts a megfelelő hirdetéseden.')
                    ->line("\r")
                    ->line('Köszönjük, hogy a Nyomozoo.hu-t választottad.')
                    ->line("\r");
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
