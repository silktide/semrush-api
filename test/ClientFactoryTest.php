<?php


namespace Silktide\SemRushApi\Test;

use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;
use Silktide\SemRushApi\ClientFactory;
use Silktide\SemRushApi\Client;

class ClientFactoryTest extends TestCase {

    /**
     * Test that the factory creates a client
     * which contains the correct key
     */
    public function testFactory()
    {
        $key = "testkey";
        $client = ClientFactory::create($key);
        self::assertTrue($client instanceof Client);
        self::assertEquals($key, $client->getApiKey());
    }

    /**
     * Test that the factory creates a client
     * which contains the correct key and sets
     * up the cache
     */
    public function testFactoryWithCache()
    {
        $key = "testkey";
        $cache = $this->createMock(CacheInterface::class);

        $client = ClientFactory::create($key, $cache);
        self::assertTrue($client instanceof Client);
        self::assertEquals($key, $client->getApiKey());
    }

} 