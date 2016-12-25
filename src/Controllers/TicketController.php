<?php namespace PureIntellect\Tickets\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PureIntellect\Tickets\Models\Ticket;
use PureIntellect\Tickets\Models\TicketCategory;

use App\Mailers\AppMailer;

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

      $ticket = new Ticket([
				'user_email'	 	=> $request->input('user_email'),
				'title'					=> $request->input('title'),
        'ticket_id' 		=> strtoupper(str_random(10)),
        'category'   		=> $request->input('category'),
      	'priority'  		=> $request->input('priority'),
        'message'   		=> $request->input('message'),
      	'status'    		=> $request->input('status') ? $request->input('status') : 1,
      ]);

      $ticket->save();
			//Mail::to(Auth::user()->email)->send(new TicketStatus);
      //$mailer->sendTicketInformation(Auth::user(), $ticket);

      return redirect()->back()->with("status", "A ticket with ID: #$ticket->ticket_id has been opened.");
	}

	public function index()
	{
		//$tickets = Ticket::where('user_email', Auth::user()->email)->paginate(25);
		//$categories = TicketCategory::all();
		//return view('tickets::user', compact('tickets', 'categories'));
		return Ticket::all();
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
