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
		return view('tickets::create', compact('categories'));
	}

	public function store(Request $request, AppMailer $mailer)
	{
    	$this->validate($request, [
				'title'     => 'required',
				'category'  => 'required',
				'priority'  => 'required',
				'message'   => 'required'
      ]);

      $ticket = new Ticket([
				'title' 				=> $request->input('title'),
				'user_email'	 	=> Auth::user()->email,
        'ticket_id' 		=> strtoupper(str_random(10)),
        'category_id'  	=> $request->input('category'),
      	'priority'  		=> $request->input('priority'),
        'message'   		=> $request->input('message'),
      	'status'    		=> "Open",
      ]);

      $ticket->save();
			//Mail::to(Auth::user()->email)->send(new TicketStatus);
      $mailer->sendTicketInformation(Auth::user(), $ticket);

      return redirect()->back()->with("status", "A ticket with ID: #$ticket->ticket_id has been opened.");
	}

	public function index()
	{
		$tickets = Ticket::where('user_email', Auth::user()->email)->paginate(25);
		$categories = TicketCategory::all();
		return view('tickets::user', compact('tickets', 'categories'));
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
}
