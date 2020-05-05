<?php


namespace Silktide\SemRushApi\Test\Data;

use Silktide\SemRushApi\Data\Column;
use PHPUnit\Framework\TestCase;

class ColumnTest extends TestCase {

    public function testGetColumns()
    {
        $columns = Column::getColumns();
        self::assertEquals(41, count($columns));
    }

    public function testIsValidColumn()
    {
        self::assertTrue(Column::isValidColumn("At"));
        self::assertFalse(Column::isValidColumn("Invalid"));
    }

}
