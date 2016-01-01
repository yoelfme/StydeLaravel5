<?php 
namespace TeachMe\Http\Controllers;

use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Guard;
use TeachMe\Entities\Ticket;
use TeachMe\Entities\TicketComment;
use TeachMe\Repositories\TicketRepository;

class TicketsController extends Controller
{

    protected $ticketRepository = null;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

	public function latest()
    {
        $tickets = $this->ticketRepository->paginateLatest();
        return view('tickets.list', compact('tickets'));
    }

    public function popular()
    {
        return view('tickets.list');
    }

    public function open()
    {
        $tickets = $this->ticketRepository->paginateOpen();
        return view('tickets.list', compact('tickets'));
    }

    public function closed()
    {
        $tickets = $this->ticketRepository->paginateClose();
        return view('tickets.list', compact('tickets'));
    }

    public function detail($id)
    {
        $ticket = $this->ticketRepository->findOrFail($id);
        return view('tickets.details', compact('ticket'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request, Guard $auth)
    {
        $this->validate($request, [
            'title' => 'required|max:120',
            'link' => 'url'
        ]);

        $ticket = $this->ticketRepository->openNew(
            currentUser(),
            $request->get('title'),
            $request->get('link')
        );

        return redirect()->route('tickets.detail', $ticket->id);
    }

    public function select($ticketId, $commentId)
    {
        $ticket = $this->ticketRepository->findOrFail($ticketId);

        $ticket->assignResource($commentId);

        return redirect()->back();
    }

}
