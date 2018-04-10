<?php


namespace Silktide\SemRushApi\Test\Data;

use Silktide\SemRushApi\Data\Column;
use PHPUnit\Framework\TestCase;

class ColumnTest extends TestCase {

    public function testGetColumns()
    {
        $columns = Column::getColumns();
        $this->assertEquals(58, count($columns));
    }

    public function testIsValidColumn()
    {
        $this->assertTrue(Column::isValidColumn("At"));
        $this->assertFalse(Column::isValidColumn("Invalid"));
    }

}
