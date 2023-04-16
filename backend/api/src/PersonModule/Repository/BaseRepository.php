<?php

namespace App\PersonModule\Repository;


use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;


abstract class BaseRepository  extends ServiceDocumentRepository
{

    public function __construct(ManagerRegistry $registry, string $documentClass)
    {
        parent::__construct($registry, $documentClass);
    }

    /**
     * @param $filterMap
     * @return int
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function total($filterMap): int {

        $qb = $this->createQueryBuilder();

        foreach($filterMap as $field => $value) {
            $qb->field($field)->equals($value);
        }

        return $qb->count()->getQuery()->execute();
    }


}