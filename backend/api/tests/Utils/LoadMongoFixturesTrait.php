<?php

namespace App\Tests\Utils;

use Doctrine\Common\DataFixtures\Executor\MongoDBExecutor;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\MongoDBPurger;

trait LoadMongoFixturesTrait
{
    public function loadMongoFixture(FixtureInterface ...$fixtureList)
    {

        $container = static::getContainer();

        $entityManager = $container->get('doctrine_mongodb')
            ->getManager();

        $loader = new Loader();
        foreach ($fixtureList as $fixture) {
            $loader->addFixture($fixture);
        }
        $executor = new MongoDBExecutor($entityManager, new MongoDBPurger());
        $executor->execute($loader->getFixtures());
    }
}