<?php

use Illuminate\Database\Seeder;
use TeachMe\Entities\User;
use Faker\Factory as Faker;

/**
* Seeder for model User
*/
class UserTableSeeder extends Seeder
{
    
    public function run()
    {
        $this->createAdmin();

        $this->createUsers(50);
    }

    private function createAdmin()
    {
        User::create([
            'name' => 'Yoel Monzon',
            'email' => 'yoelfme@hotmail.com',
            'password' => bcrypt('admin')
        ]);
    }

    private function createUsers($total = 20)
    {
        $faker = Faker::create();

        for ($i=0; $i <$total; $i++) { 
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('secret')
            ]);
        }
    }

}