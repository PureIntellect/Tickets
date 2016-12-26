<?php namespace PureIntellect\Tickets\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
	protected $fillable = [
		'user_email', 'category', 'ticket_id', 'title', 'priority', 'message', 'status'
	];

	public function user()
	{
    	return $this->hasOne(\App\User::class, 'email','user_email');
	}
	public function category()
	{
    	return $this->hasOne(TicketCategory::class,'id','category');
	}
	public function comments()
	{
    	return $this->hasMany(TicketComment::class);
	}
	public function status()
	{
			return $this->hasOne(TicketStatus::class, 'id','status');
	}
	public function priority()
	{
			return $this->hasOne(TicketPriority::class, 'id','priority');
	}
}
