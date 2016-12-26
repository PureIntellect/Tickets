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
	public function create()
	{
		$categories = TicketCategory::all();
		$priorities = TicketPriority::all();
		$statuses = TicketStatus::all();
		return view('tickets::create', compact('categories'));
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
			//Mail::to(Auth::user()->email)->send(new TicketStatus);
      //$mailer->sendTicketInformation(Auth::user(), $ticket);

			return response()->json([
				'status' => 'Success',
				'code'	 => 200,
				'message' => "A ticket with ID: #$ticket->ticket_id has been opened.",
				'ticket'	=> "$ticket->ticket_id"
			]);
	}

	public function index()
	{
		return Ticket::with('user','category','priority')->get();
	}

	public function show($ticket_id)
	{
    $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
		$category = $ticket->category;
		$comments = $ticket->comments;
		return view('tickets::show', compact('ticket', 'category','comments'));
	}

	public function admin()
	{
    	$tickets = \App\Ticket::paginate(10);
    	$categories = \App\TicketCategory::all();

    	return view('tickets::index', compact('tickets', 'categories'));
	}
	public function close($ticket_id, AppMailer $mailer)
	{
    	$ticket = \App\Ticket::where('ticket_id', $ticket_id)->firstOrFail();
    	$ticket->status = 'Closed';
    	$ticket->save();
    	$ticketOwner = $ticket->user;
    	$mailer->sendTicketStatusNotification($ticketOwner, $ticket);

    	return redirect()->back()->with("status", "The ticket has been closed.");
	}

	/* Support functions */
	public function getPriority(){
		return config('tickets.priority');
	}
}
