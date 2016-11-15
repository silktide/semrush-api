<?php


namespace Silktide\SemRushApi\Test\Data;

use Silktide\SemRushApi\Data\TypeAPIVersionMap;
use PHPUnit_Framework_TestCase;

class TypeAPIVersionMapTest extends PHPUnit_Framework_TestCase {

    /**
     * Test getting API version
     */
    public function testgetAPIVersion()
    {
        $this->assertEquals(1, TypeAPIVersionMap::getAPIVersion("domain_ranks"));
        $this->assertEquals(2, TypeAPIVersionMap::getAPIVersion("advertiser_publishers"));
    }
}