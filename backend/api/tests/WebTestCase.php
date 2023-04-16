<?php

namespace App\Tests;


use App\Tests\Utils\GetRepositoryTrait;
use App\Tests\Utils\LoadMongoFixturesTrait;

class WebTestCase extends \Symfony\Bundle\FrameworkBundle\Test\WebTestCase
{
    use LoadMongoFixturesTrait;
    use GetRepositoryTrait;

    public function setUp(): void
    {
        parent::setUp();
    }

}