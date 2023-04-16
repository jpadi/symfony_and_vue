<?php

namespace App\Tests\Unit\PersonModule\Service;

use App\PersonModule\Document\Person;
use App\PersonModule\Repository\PersonRepository;
use App\PersonModule\Service\PersonGetService;
use App\Tests\TestCase;

class PersonGetServiceTest extends TestCase
{

    /**
     * @param Person $person
     * @return PersonRepository
     */
    private function mockPersonRepository(Person $person): PersonRepository
    {

        $personRepository = $this->getMockBuilder(PersonRepository::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();

        /** @var TYPE_NAME $this */
        $personRepository->expects($this->once())
            ->method("find")
            ->with($person->getId())
            ->willReturn($person);

        return $personRepository;
    }

    private function getPerson(): Person
    {
        $person1 = new Person();
        $person1->setId("1");
        $person1->setName("jorge");
        $person1->setEmail("jorge@example.com");
        return $person1;
    }

    public function testGet() {

        $person = $this->getPerson();
        $personRepository = $this->mockPersonRepository($person);

        $personGetService = new PersonGetService($personRepository);

        $result = $personGetService->get($person->getId());

        $this->assertEquals("1", $result->getId());
        $this->assertEquals("jorge", $result->getName());
        $this->assertEquals("jorge@example.com", $result->getEmail());
    }
}