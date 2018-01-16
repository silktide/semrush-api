<?php

namespace Silktide\SemRushApi\Test\Model;

use PHPUnit\Framework\TestCase;
use Silktide\SemRushApi\Model\Exception\InvalidRowException;
use Silktide\SemRushApi\Model\Result;
use Silktide\SemRushApi\Model\Row;

class ResultTest extends TestCase {

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
            $this->createMock(Row::class),
            $this->createMock(Row::class),
            $this->createMock(Row::class)
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
        $this->expectException(InvalidRowException::class);
        $this->instance->setRows($rows);
    }

    /**
     * Check that setting rubbish throws an exception
     */
    public function testSetInvalidRowObjects()
    {
        $rows = ["rubbish"];
        $this->expectException(InvalidRowException::class);
        $this->instance->setRows($rows);
    }

    /**
     * Test that we can iterate over the result object
     */
    public function testIterator()
    {
        $rows = [
            $this->createMock(Row::class),
            $this->createMock(Row::class),
            $this->createMock(Row::class)
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
            $this->createMock(Row::class),
            $this->createMock(Row::class),
            $this->createMock(Row::class)
        ];

        foreach ($rows as $index => $row) {
            $this->instance[$index] = $row;
        }

        $this->assertTrue(isset($this->instance[0]));
        $this->assertFalse(isset($this->instance[9]));
        $this->assertEquals($rows[1], $this->instance[1]);
        unset($this->instance[1]);
        $this->assertEquals(2, count($this->instance));

        $result = $this->instance->toArray();
        $this->assertEquals(2, count($result));

    }

}