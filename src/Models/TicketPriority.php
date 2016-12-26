<?php namespace PureIntellect\Tickets\Models;

use Illuminate\Database\Eloquent\Model;

class TicketPriority extends Model
{
	protected $table = 'ticket_priority';

	public function tickets()
	{
		return $this->hasMany(Ticket::class);
	}
}
