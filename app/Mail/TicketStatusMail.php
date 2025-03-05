<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketStatusMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $data = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket, $owner)
    {
        $this->subject("RE: $ticket->title (Ticket ID: $ticket->ticket_id)");
        $this->data = [
            'contactName' => $owner->name,
            'ticketId' => $ticket->ticket_id
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.ticket-status')->with($this->data);
    }
}
