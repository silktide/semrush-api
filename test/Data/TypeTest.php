<?php


namespace Silktide\SemRushApi\Test\Data;

use Silktide\SemRushApi\Data\Type;
use PHPUnit_Framework_TestCase;

class TypeTest extends PHPUnit_Framework_TestCase {

    /**
     * Test getting the types
     */
    public function testGetTypes()
    {
        $types = Type::getTypes();
        $this->assertEquals(3, count($types));
    }
} 