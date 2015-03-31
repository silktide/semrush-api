<?php
/**
 * Copyright 2013-2015 Silktide Ltd. All Rights Reserved.
 */

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

} 