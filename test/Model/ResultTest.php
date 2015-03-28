<?php

namespace AndyWaite\SemRushApi\Test\Model;

use PHPUnit_Framework_TestCase;
use AndyWaite\SemRushApi\Model\Result;

class ResultTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Result
     */
    private $instance;

    /**
     * Instantiate a result for testing against
     */
    public function setup()
    {
        $this->instance = new Result();
    }

    /**
     * Test that we can set some rows and get them back
     */
    public function testSetAndGetRows()
    {
        $rows = [
            $this->getMock('AndyWaite\SemRushApi\Model\Row'),
            $this->getMock('AndyWaite\SemRushApi\Model\Row'),
            $this->getMock('AndyWaite\SemRushApi\Model\Row')
        ];
        $this->instance->setRows($rows);
        $this->assertEquals($rows, $this->instance->getRows());
    }

    /**
     * Check that setting rubbish throws an exception
     */
    public function testSetInvalidRowData()
    {
        $rows = "rubbish";
        $this->setExpectedException('AndyWaite\SemRushApi\Model\Exception\InvalidRowException');
        $this->instance->setRows($rows);
    }

    /**
     * Test that setting invalid rows results in exception
     */
    public function testSetInvalidRows()
    {
        $rows = [
            "rubbish"
        ];
        $this->instance->setRows($rows);
    }


}