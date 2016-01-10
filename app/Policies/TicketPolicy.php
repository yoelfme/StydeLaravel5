<?php
namespace TeachMe\Policies;

use TeachMe\Entities\User;
use TeachMe\Entities\Ticket;

class TicketPolicy
{
    
    public function selectResource(User $user, Ticket $ticket)
    {

        return $user->isAuthor($ticket) && $ticket->status == 'open';
    }

}
