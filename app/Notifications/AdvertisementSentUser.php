<?php

namespace App\Notifications;

use App\Models\advertisement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdvertisementSentUser extends Notification
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
                        ->subject('Hirdetés ellenőrzése')
                        ->line('Értesítünk, hogy az adminisztrátorokhoz befutott a hirdetésed és elkeződött a bejegyzésed vizsgálata.' . ' ('.$this->advertisement->title .')')
                        ->line('Ez általában néhány percet vesz igénybe, de egyes esetekben akár több óráig is eltarthat. Értesítünk, amint befejeztük az ellenőrzéseket.')
                        ->action('Az elfogadott hirdetéseidet megtekintheted itt', url('/website/sajatHirdetesek'))
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
