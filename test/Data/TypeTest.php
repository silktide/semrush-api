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
        $this->assertEquals(16, count($types));
        $this->assertTrue(in_array("domain_ranks", $types));
        $this->assertTrue(in_array("domain_rank", $types));
        $this->assertTrue(in_array("domain_rank_history", $types));
        $this->assertTrue(in_array("domain_organic", $types));
        $this->assertTrue(in_array("domain_adwords", $types));
        $this->assertTrue(in_array("domain_adwords_unique", $types));
        $this->assertTrue(in_array("advertiser_publishers", $types));
        $this->assertTrue(in_array("advertiser_text_ads", $types));
        $this->assertTrue(in_array("advertiser_rank", $types));
    }
}
