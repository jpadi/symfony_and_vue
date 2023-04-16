<?php

namespace App\Tests\Unit\PersonModule\Service;

use App\PersonModule\Document\Person;
use App\PersonModule\Repository\PersonRepository;
use App\PersonModule\Request\PersonCreateRequest;
use App\PersonModule\Service\PersonCreateService;
use App\Tests\TestCase;

class PersonCreateServiceTest extends TestCase
{

    /**
     * @param Person[] $personList
     * @return PersonRepository
     */
    private function mockPersonRepository(&$person): PersonRepository
    {

        $personRepository = $this->getMockBuilder(PersonRepository::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();

        /** @var TYPE_NAME $this */
        $personRepository->expects($this->once())
            ->method("create")
            ->with($this->captureArg($person));

        return $personRepository;
    }

    public function testCreate() {

        /**
         * @var Person $capturedPerson
         */
        $capturedPerson = null;
        $personRepository = $this->mockPersonRepository($capturedPerson);

        $personCreateService = new PersonCreateService($personRepository);

        $personCreateRequest = new PersonCreateRequest("jorge-create", "jorge-create@example.com");
        $personCreateService->create($personCreateRequest);

        $this->assertEquals("jorge-create", $capturedPerson->getName());
        $this->assertEquals("jorge-create@example.com", $capturedPerson->getEmail());

    }

}