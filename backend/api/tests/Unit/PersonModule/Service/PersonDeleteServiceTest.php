<?php

namespace App\Tests\Unit\PersonModule\Service;

use App\PersonModule\Document\Person;
use App\PersonModule\Repository\PersonRepository;
use App\PersonModule\Request\PersonDeleteRequest;
use App\PersonModule\Service\PersonDeleteService;
use App\Tests\TestCase;

class PersonDeleteServiceTest extends TestCase
{

    /**
     * @param Person $person
     * @return PersonRepository
     */
    private function mockPersonRepository(Person $person, &$capturedPerson): PersonRepository
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

        $personRepository->expects($this->once())
            ->method("delete")
            ->with($this->captureArg($capturedPerson));

        return $personRepository;
    }

    private function getPerson(): Person
    {
        $person1 = new Person();
        $person1->setId("1");
        $person1->setName("jorge-delete");
        $person1->setEmail("jorge-delete@example.com");
        return $person1;
    }

    public function testDelete() {

        /**
         * @var Person $capturedPerson
         */
        $capturedPerson = null;
        $personRepository = $this->mockPersonRepository($this->getPerson(),$capturedPerson);

        $personDeleteService = new PersonDeleteService($personRepository);

        $personDeleteRequest = new PersonDeleteRequest("1");
        $personDeleteService->delete($personDeleteRequest);

        $this->assertEquals("1", $capturedPerson->getId());
        $this->assertEquals("jorge-delete", $capturedPerson->getName());
        $this->assertEquals("jorge-delete@example.com", $capturedPerson->getEmail());

    }
}