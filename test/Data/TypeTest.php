<?php


namespace Silktide\SemRushApi\Test\Data;

use Silktide\SemRushApi\Data\Type;
use PHPUnit\Framework\TestCase;

class TypeTest extends TestCase {

    /**
     * Test getting the types
     */
    public function testGetTypes()
    {
        $types = Type::getTypes();
        self::assertEquals(13, count($types));
        self::assertTrue(in_array("domain_ranks", $types));
        self::assertTrue(in_array("domain_rank", $types));
        self::assertTrue(in_array("domain_rank_history", $types));
        self::assertTrue(in_array("domain_organic", $types));
        self::assertTrue(in_array("domain_adwords", $types));
        self::assertTrue(in_array("domain_adwords_unique", $types));
        self::assertTrue(in_array("advertiser_publishers", $types));
        self::assertTrue(in_array("advertiser_text_ads", $types));
        self::assertTrue(in_array("advertiser_rank", $types));
    }
}
