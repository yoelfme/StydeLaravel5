<?php

use Illuminate\Database\Seeder;
use TeachMe\Entities\User;

/**
* Seeder for model User
*/
class UserTableSeeder extends Seeder
{
    
    public function run()
    {
        $this->createAdmin();
    }

    private function createAdmin()
    {
        User::create([
            'name' => 'Yoel Monzon',
            'email' => 'yoelfme@hotmail.com',
            'password' => bcrypt('admin')
        ]);
    }

}