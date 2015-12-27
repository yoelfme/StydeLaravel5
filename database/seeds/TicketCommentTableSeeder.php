<?php

use TeachMe\Entities\TicketComment;
use Styde\Seeder\Seeder;

class TicketCommentTableSeeder extends Seeder
{
    protected $total = 250;

    public function getModel()
    {
        return new TicketComment();
    }

    public function getDummyData(Faker\Generator $faker, array $customValues = array())
    {
        return [
            'user_id' => $this->random('User')->id,
            'ticket_id' => $this->random('Ticket')->id,
            'comment' => $faker->paragraph(),
            'link' => $faker->randomElement(['', '', $faker->url]),
        ];
    }
}
