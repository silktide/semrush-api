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
     * Test that we can iterate over the result object
     */
    public function testIterator()
    {
        $rows = [
            $this->getMock('AndyWaite\SemRushApi\Model\Row'),
            $this->getMock('AndyWaite\SemRushApi\Model\Row'),
            $this->getMock('AndyWaite\SemRushApi\Model\Row')
        ];

        $this->instance->setRows($rows);
        foreach ($this->instance as $id => $row) {
            $this->assertEquals($rows[$id], $row);
        }
    }

    /**
     *  Test array access to result object
     */
    public function testArrayAccess()
    {
        $rows = [
            $this->getMock('AndyWaite\SemRushApi\Model\Row'),
            $this->getMock('AndyWaite\SemRushApi\Model\Row'),
            $this->getMock('AndyWaite\SemRushApi\Model\Row')
        ];

        foreach ($rows as $index => $row) {
            $this->instance[$index] = $row;
        }

        $this->assertTrue(isset($this->instance[0]));
        $this->assertFalse(isset($this->instance[9]));
        $this->assertEquals($rows[1], $this->instance[1]);
        unset($this->instance[1]);
        $this->assertEquals(2, count($this->instance));
        
    }

}