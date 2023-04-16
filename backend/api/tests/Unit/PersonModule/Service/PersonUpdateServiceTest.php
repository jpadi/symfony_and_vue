<?php

namespace App\Tests\Unit\PersonModule\Service;

use App\PersonModule\Document\Person;
use App\PersonModule\Repository\PersonRepository;
use App\PersonModule\Request\PersonUpdateRequest;
use App\PersonModule\Service\PersonUpdateService;
use App\Tests\TestCase;

class PersonUpdateServiceTest extends TestCase
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
            ->method("update")
            ->with($this->captureArg($capturedPerson));

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

    public function testUpdate() {

        /**
         * @var Person $capturedPerson
         */
        $capturedPerson = null;
        $personRepository = $this->mockPersonRepository($this->getPerson(),$capturedPerson);

        $personUpdateService = new PersonUpdateService($personRepository);

        $personUpdateRequest = new PersonUpdateRequest("1", "jorge-updated", "jorge-updated@example.com");
        $personUpdateService->update($personUpdateRequest);

        $this->assertEquals("1", $capturedPerson->getId());
        $this->assertEquals("jorge-updated", $capturedPerson->getName());
        $this->assertEquals("jorge-updated@example.com", $capturedPerson->getEmail());

    }

}