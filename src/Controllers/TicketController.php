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

			case "users":
				return \App\User::all();

			default: return response()->json([]);
		}
	}

	public function store(Request $request)
	{
    	$this->validate($request, [
				'user'				=> 'required',
				'title'				=> 'required',
				'category'  	=> 'required',
				'priority'  	=> 'required',
				'message'   	=> 'required'
      ]);

			$ticket = new Ticket();
			$ticket->user = $request->input('user');
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

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'user'				=> 'required',
			'title'				=> 'required',
			'category'  	=> 'required',
			'priority'  	=> 'required',
			'message'   	=> 'required'
		]);

		$ticket = Ticket::findOrFail($id);
		$ticket->user = $request->input('user');
		$ticket->title = $request->input('title');
		$ticket->priority = $request->input('priority');
		$ticket->message = $request->input('message');
		$ticket->category = $request->input('category');
		$ticket->status = $request->input('status');

		$ticket->save();
		return response()->json([
			'status' => 'Update Successful',
			'code'	 => 200,
			'message' => ": #$ticket->ticket_id has been updated.",
			'ticket'	=> "$ticket->ticket_id"
		]);
	}

	public function destroy($id)
	{
			$ticket = Ticket::findOrFail($id);
			$ticket->delete();

			return response()->json([
				'status' => 'Success',
				'code'	 => 200,
				'message' => "Ticket: #$ticket->ticket_id has been deleted.",
				'ticket'	=> "$ticket->ticket_id"
			]);
	}
}
