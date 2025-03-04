<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountCreatedMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $data = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $password = null, $debug = false)
    {
        $this->subject("Your account registration has been successful.");

        $this->data = [
            'contactName' => $name,
            'loginUsername' => $email,
            'contactEmail' => $email,
            'loginPassword' => ($debug) ? $password : "************",
            'loginUri' => sprintf('%/login', env('APP_URL')),
            'loginUrlText' => "Visit website"
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.account-created')->with($this->data);
    }
}
