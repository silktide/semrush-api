<?php


namespace Silktide\SemRushApi\Test\Data;

use Silktide\SemRushApi\Data\Type;
use PHPUnit_Framework_TestCase;

class FunctionTest extends PHPUnit_Framework_TestCase {

    /**
     * Test getting the types
     */
    public function testGetTypes()
    {
        $types = Type::getTypes();
        $this->assertEquals(2, count($types));
    }
} 