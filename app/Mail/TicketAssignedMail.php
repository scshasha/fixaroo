<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketAssignedMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $data = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $ticket)
    {
        $this->subject($data['email_subject']);
        $this->template = $data['email_template'];
        $this->data = [
            'uri' => sprintf('%s/tickets/%s', env('APP_URL'), $ticket->ticket_id),
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.agent-assigned-ticket')->with($this->data);
    }
}
