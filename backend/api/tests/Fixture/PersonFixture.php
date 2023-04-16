<?php

namespace App\Tests\Fixture;

use App\PersonModule\Document\Person;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PersonFixture implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $person1 = new Person();
        $person1->setId("635981f6e40f61599e839ddb");
        $person1->setName("person 1");
        $person1->setEmail("person1@example.com");
        $manager->persist($person1);

        $manager->flush();
    }

}