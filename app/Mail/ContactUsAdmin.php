<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $dataFromContactUs;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datacontactUs)
    {
        $this->dataFromContactUs= $datacontactUs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("-Nyomozoo.hu- Kapcsolatfelvétel")->view('emailContactUs');
    }
}
