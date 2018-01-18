<?php


namespace Silktide\SemRushApi\Test\Data;

use Silktide\SemRushApi\Data\TypeAPIVersionMap;
use PHPUnit\Framework\TestCase;

class TypeAPIVersionMapTest extends TestCase {

    /**
     * Test getting API version
     */
    public function testgetAPIVersion()
    {
        $this->assertEquals(1, TypeAPIVersionMap::getAPIVersion("domain_ranks"));
        $this->assertEquals(2, TypeAPIVersionMap::getAPIVersion("advertiser_publishers"));
    }
}