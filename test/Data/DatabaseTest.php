<?php


namespace Silktide\SemRushApi\Test\Data;

use Silktide\SemRushApi\Data\Database;
use PHPUnit_Framework_TestCase;

class DatabaseTest extends PHPUnit_Framework_TestCase {

    public function testGetDatabases()
    {
        $databases = Database::getDatabases();
        $this->assertEquals(26, count($databases));
        $this->assertTrue(isset($databases['DATABASE_GOOGLE_US']));
        $this->assertTrue(isset($databases['DATABASE_GOOGLE_UK']));
    }

} 