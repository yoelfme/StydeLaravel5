<?php
namespace TeachMe\Repositories;

use TeachMe\Entities\Ticket;

class TicketRepository extends BaseRepository
{

    public function getModel()
    {
        return new Ticket();
    }

    public function getCountTicketCommentsQuery()
    {
        return '(SELECT COUNT(ticket_comments.id) FROM ticket_comments ticket_comments WHERE ticket_comments.ticket_id = tickets.id)';
    }

    public function getCountTicketVotesQuery()
    {
        return '(SELECT COUNT(ticket_votes.id) FROM ticket_votes ticket_votes WHERE ticket_votes.ticket_id = tickets.id)';
    }

    protected function selectTicketList()
    {
        return $this->newQuery()->selectRaw(
            'tickets.* ,'
            . $this->getCountTicketVotesQuery() . ' as num_votes,'
            . $this->getCountTicketCommentsQuery() . ' as num_comments'
        )->with('author');
    }

    public function paginateLatest()
    {
        return $this->selectTicketList()
            ->orderBy('created_at', 'DESC')
            ->paginate(20);
    }

    public function paginatePopular()
    {
        return $this->selectTicketList()
            ->whereRaw($this->getCountTicketVotesQuery() . '>= 10')
            ->orderBy('num_votes', 'DESC')
            ->paginate(20);
    }

    public function paginateOpen()
    {
        return $this->selectTicketList()
            ->where('status', 'open')
            ->orderBy('created_at', 'DESC')
            ->paginate(20);
    }

    public function paginateClose()
    {
        return $this->selectTicketList()
            ->where('status', 'closed')
            ->orderBy('created_at', 'DESC')
            ->paginate(20);
    }

    public function openNew($user, $title, $link = '')
    {
        return $user->tickets()->create([
            'title' => $title,
            'link' => $link,
            'status' => !empty($link) ? 'closed' : 'open'
        ]);
    }
}
