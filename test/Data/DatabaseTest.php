<?php


namespace Silktide\SemRushApi\Test\Data;

use Silktide\SemRushApi\Data\Database;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase {

    public function testGetDatabases()
    {
        $databases = Database::getDatabases();
        $this->assertEquals(119, count($databases));
        $this->assertTrue(isset($databases['DATABASE_GOOGLE_US']));
        $this->assertTrue(isset($databases['DATABASE_GOOGLE_UK']));
    }

} 