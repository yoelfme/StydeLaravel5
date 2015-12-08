<?php 
namespace TeachMe\Http\Controllers;

use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TeachMe\Entities\Ticket;
use TeachMe\Entities\TicketComment;

class TicketsController extends Controller {

	public function latest()
    {
        $tickets = Ticket::orderBy('created_at', 'DESC')->paginate(20);
        return view('tickets.list', compact('tickets'));
    }

    public function popular()
    {
        return view('tickets.list');
    }

    public function open()
    {
        return view('tickets.list');
    }

    public function closed()
    {
        return view('tickets.list');
    }

    public function detail($id)
    {
        $ticket = Ticket::findOrFail($id);
        $comments = TicketComment::select('ticket_comments.*', 'users.name')
            ->join('users', 'ticket_comments.user_id', '=', 'users.id')
            ->where('ticket_id', $id)
            ->get();

        return view('tickets.details', compact('ticket', 'comments'));
    }

}
