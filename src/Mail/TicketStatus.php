<?php namespace PureIntellect\Tickets\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketStatus extends Mailable
{
  use Queueable, SerializesModels

  public $ticket;

  public function __construct(Ticket $ticket)
  {
    $this->ticket = $ticket;
  }

  public function build()
  {
    return $this->view('mail/ticket_status');
  }
}
