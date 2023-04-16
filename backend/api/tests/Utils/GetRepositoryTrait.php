<?php

namespace App\Tests\Utils;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

trait GetRepositoryTrait
{

    public function getRepository(string $documentClass): DocumentRepository
    {

        $container = static::getContainer();

        /**
         * @var DocumentManager $entityManager
         */
        $entityManager = $container->get('doctrine_mongodb')
            ->getManager();

        return $entityManager->getRepository($documentClass);
    }
}