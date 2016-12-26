<?php namespace PureIntellect\Tickets\Models;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
	protected $table = 'ticket_status';

	public function tickets()
	{
		return $this->hasMany(Ticket::class);
	}
}
