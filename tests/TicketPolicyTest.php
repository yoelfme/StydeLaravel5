<?php

use TeachMe\Policies\TicketPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TicketPolicyTest extends TestCase
{

    use DatabaseTransactions;

    public function test_author_can_select_resource()
    {
        $user = seed('User');
        $ticket = seed('Ticket', [
            'user_id' => $user->id
        ]);

        $policy = new TicketPolicy();

        $this->assertTrue($policy->selectResource($user, $ticket));
    }

    public function test_other_users_cannot_select_resource()
    {
        $user = seed('User');
        $ticket = seed('Ticket', [
            'user_id' => $user->id
        ]);

        $otherUser = seed('User');

        $policy = new TicketPolicy();

        $this->assertFalse($policy->selectResource($otherUser, $ticket));
    }

    public function test_administrators_can_select_resource()
    {
        $user = seed('User');
        $ticket = seed('Ticket', [
            'user_id' => $user->id
        ]);

        $admin = seed('User', [
            'role' => 'admin'
        ]);

        $policy = new TicketPolicy();

        $this->assertTrue($admin->can('selectResource', $ticket));
        // $this->assertTrue(Gate::forUser($admin)->allows('selectResource', $ticket));
    }

}
