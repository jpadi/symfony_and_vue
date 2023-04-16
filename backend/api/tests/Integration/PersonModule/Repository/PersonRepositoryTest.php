<?php

namespace App\Tests\Integration\PersonModule\Repository;


use App\PersonModule\Document\Person;
use App\PersonModule\Repository\PersonRepository;
use App\Tests\Fixture\PersonFixture;
use App\Tests\WebTestCase;


class PersonRepositoryTest extends WebTestCase
{

    public function setUp(): void
    {
        parent::setUp();
        $this->loadMongoFixture(new PersonFixture());
    }

    public function testTotal()
    {
        /**
         * @var PersonRepository $personRepository
         */
        $personRepository = $this->getRepository(Person::class);
        $total = $personRepository->total([]);
        $this->assertEquals(1, $total);
    }

    public function testFindBy()
    {

        /**
         * @var PersonRepository $personRepository
         */
        $personRepository = $this->getRepository(Person::class);

        $personList = $personRepository->findBy([]);

        $this->assertCount(1, $personList);
        $this->assertEquals("635981f6e40f61599e839ddb", $personList[0]->getId());
        $this->assertEquals("person 1", $personList[0]->getName());
        $this->assertEquals("person1@example.com", $personList[0]->getEmail());

    }

    public function testCreate() {
        /**
         * @var PersonRepository $personRepository
         */
        $personRepository = $this->getRepository(Person::class);

        $person = new Person();
        $person->setName("jorge-create-1");
        $person->setEmail("jorge-create-1@example.com");

        $personRepository->create($person);

        /**
         * @var Person[] $result
         */
        $result = $personRepository->findBy(["name" =>  "jorge-create-1"]);

        $this->assertCount(1, $result);
        $this->assertEquals("jorge-create-1" , $result[0]->getName());
        $this->assertEquals("jorge-create-1@example.com" , $result[0]->getEmail());

    }

    public function testUpdate() {
        /**
         * @var PersonRepository $personRepository
         */
        $personRepository = $this->getRepository(Person::class);

        /**
         * @var Person[] $person
         */
        $personList = $personRepository->findBy(["id" =>  "635981f6e40f61599e839ddb"]);
        $personList[0]->setName("jorge-updated-1");

        $personRepository->update($personList[0]);


        /**
         * @var Person[] $result
         */
        $result = $personRepository->findBy(["id" =>  "635981f6e40f61599e839ddb"]);

        $this->assertEquals("jorge-updated-1" , $result[0]->getName());
        $this->assertEquals("person1@example.com" , $result[0]->getEmail());

    }

    public function testDelete() {
        /**
         * @var PersonRepository $personRepository
         */
        $personRepository = $this->getRepository(Person::class);

        /**
         * @var Person[0] $person
         */
        $personList = $personRepository->findBy(["id" =>  "635981f6e40f61599e839ddb"]);

        $personRepository->delete($personList[0]);

        /**
         * @var Person $result
         */
        $result = $personRepository->findBy(["id" =>  "635981f6e40f61599e839ddb"]);

        $this->assertCount(0,$result);
    }

}