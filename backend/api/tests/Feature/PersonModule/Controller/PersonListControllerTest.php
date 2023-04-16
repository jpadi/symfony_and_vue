<?php

namespace App\Tests\Feature\PersonModule\Controller;

use App\Tests\Fixture\PersonFixture;
use App\Tests\WebTestCase;

class PersonListControllerTest extends WebTestCase
{

    private $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->loadMongoFixture(new PersonFixture());
    }

    public function testGetList()
    {
        $client = $this->client;
        $client->request('GET', '/api/v1/person');

        $response = json_decode($client->getResponse()->getContent(), true);

        $this->assertCount(1, $response["items"]);
        $this->assertEquals(1, $response["total"]);
        $this->assertEquals(100, $response["limit"]);
        $this->assertEquals(0, $response["offset"]);

        $this->assertEquals("635981f6e40f61599e839ddb", $response["items"][0]["id"]);
        $this->assertEquals("person 1", $response["items"][0]["name"]);
        $this->assertEquals("person1@example.com", $response["items"][0]["email"]);


    }

}