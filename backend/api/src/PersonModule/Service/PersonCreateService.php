<?php

namespace App\PersonModule\Service;

use App\PersonModule\Document\Person;
use App\PersonModule\Repository\PersonRepository;
use App\PersonModule\Request\PersonCreateRequest;

class PersonCreateService
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
     * @param PersonCreateRequest $request
     * @return string
     * @throws \App\PersonModule\Exception\ValidationException
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function create(PersonCreateRequest $request) : string {

        $person = new Person();
        $person->setName($request->getName());
        $person->setEmail($request->getEmail());

        $this->personRepository->create($person);

        return $person->getId()??"";
    }

}