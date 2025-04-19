<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $emailDetails;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        if (is_array($data)) {
            $this->emailDetails = $data;
        } else {
            $this->user = $data;
        }
    }

    /**
     * Build the message.
     */
    public function build()
    {
        if ($this->emailDetails) {
            $email = $this->subject($this->emailDetails['subject'])
                          ->markdown('emails.send_mail', ['message' => $this->emailDetails['message']]);

            if (!empty($this->emailDetails['document'])) {
                $email->attach(storage_path('app/' . $this->emailDetails['document']));
            }

            return $email;
        } else {
            $email = $this->subject($this->user->send_subject)
                          ->markdown('emails.send_mail', ['user' => $this->user]);

            if ($this->user->document) {
                $email->attach(storage_path('app/' . $this->user->document));
            }

            return $email;
        }
    }
}
