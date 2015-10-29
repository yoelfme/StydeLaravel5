<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

abstract class BaseSeeder extends Seeder
{
    abstract public function getModel();
    abstract public function getDummyData($faker, array $customValues = array());

    protected function createMultiple($total, array $customValues = array())
    {
        $faker = Faker::create();

        for ($i=0; $i <$total; $i++) {
            $this->create();
        }
    }

    protected function create(array $customValues = array())
    {
        $values = $this->getDummyData(Faker::create(), $customValues);
        $values = array_merge($values, $customValues);
        return $this->getModel()->create($values);
    }

    protected function createFrom($seeder, array $customValues = array())
    {
        $seeder = new $seeder;
        return $seeder->create($customValues);
    }

    

}