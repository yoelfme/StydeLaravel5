<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseSeeder extends Seeder
{
    protected static $pool;

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
        return $this->addToPool($this->getModel()->create($values));
    }

    protected function createFrom($seeder, array $customValues = array())
    {
        $seeder = new $seeder;
        return $seeder->create($customValues);
    }

    protected function getRandom($model)
    {
        if (! $this->collectionExist($model)) {
            throw new Exception("The $model collection does not exist");
            
        }

        return static::$pool[$model]->random();
    }

    public function addToPool($entity)
    {
        $reflection = new ReflectionClass($entity);
        $class = $reflection->getShortName();


        if (! $this->collectionExist($class)) {
            static::$pool[$class] = new Collection();
        }

        static::$pool[$class]->add($entity);

        return $entity;
    }

    public function collectionExist($class)
    {
        return isset(static::$pool[$class]);
    }

}