<?php 
namespace TeachMe\Http\Controllers;

use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Guard;
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
        $tickets = Ticket::where('status', 'open')->orderBy('created_at', 'DESC')->paginate(20);
        return view('tickets.list', compact('tickets'));
    }

    public function closed()
    {
        $tickets = Ticket::where('status', 'closed')->orderBy('created_at', 'DESC')->paginate(20);
        return view('tickets.list', compact('tickets'));
    }

    public function detail($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tickets.details', compact('ticket'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request, Guard $auth)
    {
        $this->validate($request, [
            'title' => 'required|max:120'
        ]);

        $ticket = $auth->user()->tickets()->create([
            'title' => $request->get('title'),
            'status' => 'open'
        ]);

        return redirect()->route('tickets.detail', $ticket->id);
    }

}
