<?php
/**
 * Copyright 2013-2015 Silktide Ltd. All Rights Reserved.
 */

namespace AndyWaite\SemRushApi\Test\Connector;

use AndyWaite\SemRushApi\Connector\GuzzleConnector;
use PHPUnit_Framework_TestCase;

class GuzzleConnectorTest extends PHPUnit_Framework_TestCase {

    public function testGet()
    {
        $connector = new GuzzleConnector();
        $result = $connector->get("http://httpbin.org/user-agent");
        $data = json_decode($result, true);
        $this->assertTrue(isset($data['user-agent']));
    }
}