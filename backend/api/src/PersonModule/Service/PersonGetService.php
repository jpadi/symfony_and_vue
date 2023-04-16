<?php

namespace App\PersonModule\Service;

use App\PersonModule\Document\Person;
use App\PersonModule\Exception\DocumentNotFoundException;
use App\PersonModule\Repository\PersonRepository;
use App\PersonModule\Response\PersonGetResponse;

class PersonGetService
{
    private PersonRepository $personRepository;

    /**
     * @param PersonRepository $personRepository
     */
    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    /**
     * @param string $id
     * @return void
     * @throws DocumentNotFoundException
     * @throws \Doctrine\ODM\MongoDB\LockException
     * @throws \Doctrine\ODM\MongoDB\Mapping\MappingException
     */
    public function get(string $id): PersonGetResponse {
        /**
         * @var Person $person
         */
        $person = $this->personRepository->find($id);

        if (!$person) {
            throw new DocumentNotFoundException($id, Person::class);
        }

        return new PersonGetResponse($person->getId(), $person->getName(), $person->getEmail());
    }
}