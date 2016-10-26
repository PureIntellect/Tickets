<?php namespace PureIntellect\Tickets\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
	protected $fillable = [
		'user_email', 'category_id', 'ticket_id', 'title', 'priority', 'message', 'status'
	];

	public function user()
	{
    	return $this->belongsTo(User::class, 'user_email','email');
	}
	public function category()
	{
    	return $this->belongsTo(TicketCategory::class);
	}
	public function comments()
	{
    	return $this->hasMany(TicketComment::class);
	}
}
