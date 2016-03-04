<?php

namespace PhilKershaw\PostcodesIO;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    protected $client;

    public function setUp()
    {
        $this->client = new Client();
    }

    public function testCanPerformPostcodeLookup()
    {
        $response = $this->client->postcodeLookup('OL14 8HR');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCanPerformBulkPostcodeLookup()
    {
        $response = $this->client->bulkPostcodeLookup([
            'M9 4WY', 'OL14 8HR'
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCanPerformLatLongLookup()
    {
        $location = [
            "longitude" => 0.629834723775309,
  	        "latitude"  => 51.7923246977375
        ];

        $response = $this->client->latLongLookup($location);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCanPerformBulkReverseGeocoding()
    {
        $response = $this->client->bulkLatLongLookup([
            [
                "longitude" => 0.629834723775309,
              	"latitude"  => 51.7923246977375
            ],
            [
                "longitude" => -2.49690382054704,
              	"latitude"  => 53.5351312861402,
              	"radius"    => 1000,
              	"limit"     => 5
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCanGetRandomPostcode()
    {
        $response = $this->client->getRandomPostcode();

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCanValidatePostcode()
    {
        $response = $this->client->validatePostcode('OL14 8HR');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCanAutocompletePostcode()
    {
        $response = $this->client->autocompletePostcode('OL14 8HR');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCanGetNearestPostcodes()
    {
        $response = $this->client->getNearestPostcodes('OL14 8HR');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCanPerformOutcodeLookup()
    {
        $response = $this->client->outcodeLookup('OL14');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCanGetNearestOutcodes()
    {
        $response = $this->client->getNearestOutcodes('OL14');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCanPerformOutcodeLatLongLookup()
    {
        $location = [
            "longitude" => 0.629834723775309,
  	        "latitude"  => 51.7923246977375
        ];

        $response = $this->client->outcodeLatLongLookup($location);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
