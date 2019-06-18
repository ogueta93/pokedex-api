<?php
// tests/PokeApiServiceTest.php
namespace App\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PokeApiService extends WebTestCase
{
    public function testSimple()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertInternalType('string', $client->getResponse()->getContent());

        $decodedData = \json_decode($client->getResponse()->getContent());
        $this->assertEquals(50, (int) $decodedData->count);
    }

    public function testWithPageNumberValue()
    {
        $value = 17;
        
        $client = static::createClient();
        $client->request('GET', '/' . $value);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertInternalType('string', $client->getResponse()->getContent());

        $decodedData = \json_decode($client->getResponse()->getContent());
        $this->assertLessThanOrEqual(50, (int) $decodedData->count);
    }
}
