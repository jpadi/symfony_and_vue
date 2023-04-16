<?php

namespace App\Tests\Feature\PersonModule\Controller;

use App\Tests\Fixture\PersonFixture;
use App\Tests\WebTestCase;

class PersonDeleteControllerTest extends WebTestCase
{

    private $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->loadMongoFixture(new PersonFixture());
    }

    public function testDelete()
    {
        $client = $this->client;
        $client->request('DELETE', '/api/v1/person/635981f6e40f61599e839ddb');

        $responseDelete = $client->getResponse()->getContent();
        $this->assertEquals("", $responseDelete);


        $client->request('GET', '/api/v1/person/635981f6e40f61599e839ddb');
        $responseGet = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals("Person \"635981f6e40f61599e839ddb\" not found", $responseGet["error"]);

    }

}