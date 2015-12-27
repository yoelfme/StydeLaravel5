<?php

use TeachMe\Entities\User;
use Styde\Seeder\Seeder;

/**
 * Seeder for model User.
 */
class UserTableSeeder extends Seeder
{
    public function getModel()
    {
        return new User();
    }

    public function getDummyData(Faker\Generator $faker, array $customValues = array())
    {
        return [
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => bcrypt('secret'),
        ];
    }

    public function run()
    {
        $this->createAdmin();
        $this->createMultiple(50);
    }

    private function createAdmin()
    {
        $this->create([
            'name' => 'Yoel Monzon',
            'email' => 'yoelfme@hotmail.com',
            'password' => bcrypt('admin'),
        ]);
    }
}
