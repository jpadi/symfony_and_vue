<?php

namespace App\PersonModule\Repository;

use App\PersonModule\Document\Person;
use App\PersonModule\Exception\ValidationException;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;


class PersonRepository extends BaseRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Person::class);
    }

    /**
     * @param Person $person
     * @return void
     * @throws ValidationException
     */
    private function validate(Person $person) {
        if (!$person->getName()) {
            throw new ValidationException("Person field \"name\" should not be empty");
        }

        if (!$person->getEmail()) {
            throw new ValidationException("Person field \"email\" should not be empty");
        }

        if (!str_contains($person->getEmail(), "@")) {
            throw new ValidationException("Person field \"email\" should be a valid email");
        }
    }

    /**
     * @param Person $person
     * @return void
     * @throws ValidationException
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    private function store(Person $person) {
        $this->validate($person);
        $dm = $this->getDocumentManager();
        $dm->persist($person);
        $dm->flush();
    }

    /**
     * @param Person $person
     * @return void
     * @throws ValidationException
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function create(Person $person) {
        $this->store($person);
    }

    /**
     * @param Person $person
     * @return void
     * @throws ValidationException
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function update(Person $person) {
        $this->store($person);
    }

    public function delete(Person $person) {
        $dm = $this->getDocumentManager();
        $dm->remove($person);
        $dm->flush();
    }

}