<?php namespace PureIntellect\Tickets\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PureIntellect\Tickets\Models\Ticket;
use PureIntellect\Tickets\Models\TicketCategory;
use PureIntellect\Tickets\Models\TicketPriority;
use PureIntellect\Tickets\Models\TicketStatus;

class TicketController extends Controller
{
	public function all()
	{
		return Ticket::with('user','category','priority','status')->get();
	}
	public function get($type){
		switch($type){
			case "category":
			case "categories":
			 	return TicketCategory::all();

			case "priority":
			case "priorities":
				return TicketPriority::all();

			case "status":
			case "statuses":
				return TicketStatus::all();

			default: return response()->json([]);
		}
	}

	public function store(Request $request)
	{
    	$this->validate($request, [
				'user_email'	=> 'required|email',
				'title'				=> 'required',
				'category'  	=> 'required',
				'priority'  	=> 'required',
				'message'   	=> 'required'
      ]);

			$ticket = new Ticket();
			$ticket->user_email = $request->input('user_email');
			$ticket->title = $request->input('title');
			$ticket->priority = $request->input('priority');
			$ticket->message = $request->input('message');
			$ticket->category = $request->input('category');
			$ticket->status = $request->input('status');
			$ticket->ticket_id = strtoupper(str_random(10));

      $ticket->save();

			return response()->json([
				'status' => 'Success',
				'code'	 => 200,
				'message' => "A ticket with ID: #$ticket->ticket_id has been opened.",
				'ticket'	=> "$ticket->ticket_id"
			]);
	}
}
