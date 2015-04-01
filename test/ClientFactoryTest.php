<?php


namespace Silktide\SemRushApi\Test;

use PHPUnit_Framework_TestCase;
use Silktide\SemRushApi\ClientFactory;
use Silktide\SemRushApi\Client;

class ClientFactoryTest extends PHPUnit_Framework_TestCase {

    /**
     * Test that the factory creates a client
     * which contains the correct key
     */
    public function testFactory()
    {
        $key = "testkey";
        $client = ClientFactory::create($key);
        $this->assertTrue($client instanceof Client);
        $this->assertEquals($key, $client->getApiKey());
    }

    /**
     * Test that the factory creates a client
     * which contains the correct key and sets
     * up the cache
     */
    public function testFactoryWithCache()
    {
        $key = "testkey";
        $cache = $this->getMock('Silktide\SemRushApi\Cache\CacheInterface');

        $client = ClientFactory::create($key, $cache);
        $this->assertTrue($client instanceof Client);
        $this->assertEquals($key, $client->getApiKey());
    }

} 