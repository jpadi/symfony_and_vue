<?php

namespace App\PersonModule\Service;

use App\PersonModule\Document\Person;
use App\PersonModule\Exception\DocumentNotFoundException;
use App\PersonModule\Repository\PersonRepository;
use App\PersonModule\Request\PersonDeleteRequest;

class PersonDeleteService
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
     * @param PersonDeleteRequest $request
     * @return void
     * @throws DocumentNotFoundException
     * @throws \Doctrine\ODM\MongoDB\LockException
     * @throws \Doctrine\ODM\MongoDB\Mapping\MappingException
     */
    public function Delete(PersonDeleteRequest $request) {
        /**
         * @var Person $person
         */
        $person = $this->personRepository->find($request->getId());

        if (!$person) {
            throw new DocumentNotFoundException($request->getId(), Person::class);
        }

        $this->personRepository->delete($person);
    }

}