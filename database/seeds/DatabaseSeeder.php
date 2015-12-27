<?php

use Illuminate\Database\Eloquent\Model;
use Styde\Seeder\BaseSeeder;

class DatabaseSeeder extends BaseSeeder
{

    protected $truncate = [
        'users',
        'password_resets',
        'tickets',
        'ticket_votes',
        'ticket_comments',
    ];

    protected $seeders = [
       'User',
       'Ticket',
       'TicketVote',
       'TicketComment',
    ];

}
