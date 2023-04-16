<?php

namespace App\Tests\Feature\PersonModule\Controller;

use App\Tests\Fixture\PersonFixture;
use App\Tests\WebTestCase;

class PersonUpdateControllerTest extends WebTestCase
{
    private $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->loadMongoFixture(new PersonFixture());
    }

    public function testCreate() {

        $personArray = [
            "name" => "jorge-update-controller",
            "email" => "jorge-update-controller@example.com"
        ];

        $client = $this->client;
        $client->jsonRequest('PUT', '/api/v1/person/635981f6e40f61599e839ddb', $personArray);

        $response = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals("635981f6e40f61599e839ddb", $response["id"]);
        $this->assertEquals("jorge-update-controller", $response["name"]);
        $this->assertEquals("jorge-update-controller@example.com", $response["email"]);

    }
}