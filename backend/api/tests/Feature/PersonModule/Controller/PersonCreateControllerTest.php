<?php

namespace App\Tests\Feature\PersonModule\Controller;

use App\Tests\Fixture\PersonFixture;
use App\Tests\WebTestCase;

class PersonCreateControllerTest extends WebTestCase
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
            "name" => "jorge-create-controller",
            "email" => "jorge-create-controller@example.com"
        ];

        $client = $this->client;
        $client->jsonRequest('POST', '/api/v1/person', $personArray);

        $response = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals("jorge-create-controller", $response["name"]);
        $this->assertEquals("jorge-create-controller@example.com", $response["email"]);

    }
}