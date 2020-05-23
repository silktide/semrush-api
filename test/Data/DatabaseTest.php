<?php


namespace Silktide\SemRushApi\Test\Data;

use Silktide\SemRushApi\Data\Database;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase {

    public function testGetDatabases()
    {
        $databases = Database::getDatabases();
        self::assertEquals(136, count($databases));
        self::assertTrue(isset($databases['DATABASE_GOOGLE_US']));
        self::assertTrue(isset($databases['DATABASE_GOOGLE_UK']));
    }

} 