<?php namespace TeachMe\Http\Controllers;

use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;

use Illuminate\Http\Request;

use TeachMe\Entities\Ticket;

class VotesController extends Controller {

	public function submit($id)
    {
        $ticket = Ticket::findOrFail($id);

        currentUser()->vote($ticket);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);

        currentUser()->unvote($ticket);

        return redirect()->back();
    }

}
