<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailFromAdminPage extends Mailable
{
    use Queueable, SerializesModels;

    public $dataFromAdmin;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataContacts)
    {
        $this->dataFromAdmin= $dataContacts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->dataFromAdmin['subject'])->view('emailFromAdminPage');
    }
}
