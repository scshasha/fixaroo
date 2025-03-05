<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketCreatedMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $data = [];
    protected $template = '';
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
            'uri' => sprintf('%s/%s/%s', env('APP_URL'), ($this->template === 'admin') ? 'admin/tickets' : 'tickets', $ticket->ticket_id),
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown(
            ($this->template === 'admin') ? 'emails.admin-new-ticket' : 'emails.user-new-ticket'
        )->with($this->data);
    }
}
