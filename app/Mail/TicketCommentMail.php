<?php

namespace App\Mail;

use App\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketCommentMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $data = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, Ticket $ticket, $comment)
    {
        $this->subject("RE: $ticket->tile (Ticket ID: $ticket->ticket_id)");

        $this->data = [
            'replyBy' => $user->name,
            'ticketComment' => $comment->comment,
            'ticketStatus' => $ticket->status,
            'ticketUrlText' => 'view ticket online',
            'ticketUri'   => sprintf('%s/tickets/%s', env('APP_URL'), $ticket->ticket_id),
            'ticketTitle' => $ticket->title
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.ticket-comment')->with($this->data);
    }
}
