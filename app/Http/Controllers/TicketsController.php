<?php 
namespace TeachMe\Http\Controllers;

use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TeachMe\Entities\Ticket;

class TicketsController extends Controller {

	public function latest()
    {
        $tickets = Ticket::orderBy('created_at', 'DESC')->get();
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
        return view('tickets.details', compact('ticket'));
    }

}
