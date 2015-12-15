<?php namespace TeachMe\Http\Controllers;

use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;

use TeachMe\Entities\TicketComment;
use TeachMe\Entities\Ticket;

use Illuminate\Http\Request;
use Illuminate\Auth\Guard;

class CommentsController extends Controller {

	public function submit(Request $request, Guard $auth, $id)
    {
        $this->validate($request, [
            'comment' => 'required|max:250',
            'link' => 'url'
        ]);

        $comment = new TicketComment($request->all());
        $comment->user_id = $auth->id();

        $ticket = Ticket::findOrFail($id);
        $ticket->comments()->save($comment);

        session()->flash('success', 'Tu comentario fue guardado exitosamente');
        return redirect()->back();
    }

}
