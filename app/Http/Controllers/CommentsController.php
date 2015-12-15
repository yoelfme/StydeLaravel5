<?php namespace TeachMe\Http\Controllers;

use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CommentsController extends Controller {

	public function submit(Request $request, $id)
    {
        $this->validate($request, [
            'comment' => 'required|max:250',
            'link' => 'url'
        ]);

        dd('Agregando comentario al ticket: '.$id);
    }

}
