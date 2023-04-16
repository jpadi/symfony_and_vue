<?php

namespace App\PersonModule\Service;

use App\PersonModule\Document\Person;
use App\PersonModule\Exception\DocumentNotFoundException;
use App\PersonModule\Repository\PersonRepository;
use App\PersonModule\Request\PersonUpdateRequest;

class PersonUpdateService
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
     * @param PersonUpdateRequest $request
     * @return void
     * @throws DocumentNotFoundException
     * @throws \App\PersonModule\Exception\ValidationException
     * @throws \Doctrine\ODM\MongoDB\LockException
     * @throws \Doctrine\ODM\MongoDB\Mapping\MappingException
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function update(PersonUpdateRequest $request) {
        /**
         * @var Person $person
         */
        $person = $this->personRepository->find($request->getId());

        if (!$person) {
            throw new DocumentNotFoundException($request->getId(), Person::class);
        }

        $person->setName($request->getName());
        $person->setEmail($request->getEmail());

        $this->personRepository->update($person);

    }

}