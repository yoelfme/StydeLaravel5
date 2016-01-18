<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PopularTicketsTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_see_popular_tickets()
    {
        $popularTicket = seed('Ticket', ['title' => 'Muy popular']);
        $ticket = seed('Ticket', ['title' => 'No popular']);

        seed('TicketVote', 10, ['ticket_id' => $popularTicket->id]);
        seed('TicketVote', 2, ['ticket_id' => $ticket->id]);

        $this->visit('/')
            ->click('Populares')
            ->seeInElement('h1', 'Solicitudes Populares')
            ->see($popularTicket->title)
            ->see('10 votos')
            ->dontSee($ticket->title)
            ->dontSee('2 votos');
    }
}
