<?php namespace Pureintellect\Tickets\Models;

use Illuminate\Database\Eloquent\Model;

class TicketComment extends Model
{
	protected $table = 'ticket_comments';
	protected $fillable = ['ticket_id', 'user_email', 'comment'];

	public function ticket()
	{
		return $this->belongsTo(Ticket::class);
	}

	public function user()
	{
    		return $this->belongsTo(User::class,'email', 'user_email');
	}
}

