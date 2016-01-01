<?php

namespace TeachMe\Entities;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Entity
{

    protected $fillable = [
        'title',
        'link',
        'status'
    ];

    public function author()
    {
        return $this->belongsTo(User::getClass(), 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(TicketComment::getClass())->with('user');
    }

    public function voters()
    {
        return $this->belongsToMany(User::getClass(), 'ticket_votes')->withTimestamps();
    }

    public function getOpenAttribute()
    {
        return $this->status == 'open';
    }

    public function assignResource($comment)
    {
        if (is_numeric($comment)) {
            $comment = TicketComment::findOrFail($comment);
        }

        if (empty($comment->link) || $this->id != $comment->ticket_id) {
            abort(404);
        }

        $this->link = $comment->link;
        $this->status = 'closed';
        $this->save();

        $comment->selected = true;
        $comment->save();
    }
}
