<?php

namespace App\Tests\Feature\PersonModule\Controller;

use App\Tests\Fixture\PersonFixture;
use App\Tests\WebTestCase;

class PersonGetControllerTest extends WebTestCase
{

    private $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->loadMongoFixture(new PersonFixture());
    }

    public function testGet()
    {
        $client = $this->client;
        $client->request('GET', '/api/v1/person/635981f6e40f61599e839ddb');

        $response = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals("635981f6e40f61599e839ddb", $response["id"]);
        $this->assertEquals("person 1", $response["name"]);
        $this->assertEquals("person1@example.com", $response["email"]);
    }

}