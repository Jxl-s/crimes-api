<?php

use PHPUnit\Framework\TestCase;

class ReportsTest extends TestCase
{
    private GuzzleHttp\Client $client;

    public function setUp(): void
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => TEST_BASE_URI,
            'timeout' => 2.0,
        ]);
    }

    public function testGetAllReports()
    {
        $res = $this->client->request('GET', 'reports');
        $resStatus = $res->getStatusCode();
        $resBody = $res->getBody();

        // Assertions
        $this->assertEquals(200, $resStatus);
        $this->assertNotEmpty($resBody);

        $resJson = json_decode($resBody, true);
        $this->assertIsArray($resJson);
        $this->assertGreaterThan(0, count($resJson['data']));
    }

    public function testGetReportsWithLastUpdateFilters()
    {
        $res = $this->client->request('GET', 'reports?from_last_update=2020-01-01&to_last_update=2020-03-01');
        $resStatus = $res->getStatusCode();
        $resBody = $res->getBody();

        // Assertions
        $this->assertEquals(200, $resStatus);
        $this->assertNotEmpty($resBody);

        $resJson = json_decode($resBody, true);
        $this->assertIsArray($resJson);
        $this->assertGreaterThan(0, count($resJson['data']));

        foreach ($resJson['data'] as $item) {
            $item_update = new DateTime($item['last_update']);

            $this->assertGreaterThanOrEqual(new DateTime('2020-01-01'), $item_update);
            $this->assertLessThanOrEqual(new DateTime('2020-03-01'), $item_update);
        }
    }

    public function testGetReportsWithCountFilters()
    {
        $res = $this->client->request('GET', 'reports?fatalities=0&criminal_count=1&victim_count=1');
        $resStatus = $res->getStatusCode();
        $resBody = $res->getBody();

        // Assertions
        $this->assertEquals(200, $resStatus);
        $this->assertNotEmpty($resBody);

        $resJson = json_decode($resBody, true);
        $this->assertIsArray($resJson);
        $this->assertGreaterThan(0, count($resJson['data']));

        foreach ($resJson['data'] as $item) {
            $this->assertEquals(0, $item['fatalities']);
            $this->assertEquals(1, count($item['criminal_ids']));
            $this->assertEquals(1, count($item['victim_ids']));
        }
    }

    public function testGetReportsWithCodeFilters()
    {
        $res = $this->client->request('GET', 'reports?crime_code=624&modus_code=1822&premise=walk');
        $resStatus = $res->getStatusCode();
        $resBody = $res->getBody();

        // Assertions
        $this->assertEquals(200, $resStatus);
        $this->assertNotEmpty($resBody);

        $resJson = json_decode($resBody, true);
        $this->assertIsArray($resJson);
        $this->assertGreaterThan(0, count($resJson['data']));

        foreach ($resJson['data'] as $item) {
            $this->assertContains(624, $item['crime_codes']);
            $this->assertContains('1822', $item['modus_codes']);
            $this->assertStringContainsString('walk', strtolower($item['premise']));
        }
    }
}
