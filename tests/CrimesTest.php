<?php

use PHPUnit\Framework\TestCase;

class CrimesTest extends TestCase
{
    private GuzzleHttp\Client $client;

    public function setUp(): void
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => TEST_BASE_URI,
            'timeout' => 2.0,
        ]);
    }

    public function testGetAllCrimes() {
        $res = $this->client->request('GET', 'crimes');
        $resBody = $res->getBody();

        $this->assertEquals(200, $res->getStatusCode());
        $this->assertNotEmpty($resBody);

        $resJson = json_decode($resBody, true);
        $this->assertIsArray($resJson);
        $this->assertGreaterThan(0, count($resJson['data']));

        // Traverse
        foreach ($resJson['data'] as $item) {
            $this->assertArrayHasKey('crime_code', $item);
            $this->assertArrayHasKey('crime_desc', $item);
        }
    }

    public function testGetCrimeById() {
        $res = $this->client->request('GET', 'crimes/210');
        $resBody = $res->getBody();

        $this->assertEquals(200, $res->getStatusCode());
        $this->assertNotEmpty($resBody);

        $resJson = json_decode($resBody, true);
        $this->assertIsArray($resJson);

        $this->assertEquals(210, $resJson['crime_code']);
        $this->assertEquals('Robbery', $resJson['crime_desc']);
    }
}
