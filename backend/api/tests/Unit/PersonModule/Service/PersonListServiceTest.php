<?php

namespace App\Tests\Unit\PersonModule\Service;

use App\PersonModule\Document\Person;
use App\PersonModule\Repository\PersonRepository;
use App\PersonModule\Request\PersonListRequest;
use App\PersonModule\Service\PersonListService;
use App\Tests\TestCase;


class PersonListServiceTest extends TestCase
{

    /**
     * @param Person[] $personList
     * @return PersonRepository
     */
    private function mockPersonRepository(array $personList): PersonRepository
    {

        $personRepository = $this->getMockBuilder(PersonRepository::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();

        /** @var TYPE_NAME $this */
        $personRepository->expects($this->once())
            ->method("findBy")
            ->withAnyParameters()
            ->willReturn(
                $personList
            );

        $personRepository->expects($this->once())
            ->method("total")
            ->withAnyParameters()
            ->willReturn(
                1
            );

        return $personRepository;
    }

    private function getPersonList(): array
    {

        $person1 = new Person();
        $person1->setId("1");
        $person1->setName("jorge");
        $person1->setEmail("jorge@example.com");

        $result = [];
        $result[] = $person1;

        return $result;
    }

    public function testGetList()
    {

        $personRepository = $this->mockPersonRepository($this->getPersonList());
        $personListService = new PersonListService($personRepository);
        $personListRequest = new PersonListRequest("name_asc", 100, 0);
        $personListResponse = $personListService->getList($personListRequest);

        $this->assertEquals(1, $personListResponse->getTotal());
        $this->assertEquals(100, $personListResponse->getLimit());
        $this->assertEquals(0, $personListResponse->getOffset());
        $this->assertCount(1, $personListResponse->getItems());

        $this->assertEquals("1", $personListResponse->getItems()[0]->getId());
        $this->assertEquals("jorge", $personListResponse->getItems()[0]->getName());
        $this->assertEquals("jorge@example.com", $personListResponse->getItems()[0]->getEmail());


    }

}