<?php


namespace AndyWaite\SemRushApi\Test\Data;

use AndyWaite\SemRushApi\Data\Field;
use PHPUnit_Framework_TestCase;

class ColumnTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Field
     */
    protected $instance;

    public function setup()
    {
        $this->instance = new Field();
    }

    /**
     * Check getting field descriptions
     */
    public function testGetFieldDescription()
    {
        foreach ($this->getValidFieldList() as $field) {
            $description = $this->instance->getFieldDescription($field);
            $this->assertTrue(is_string($description));
            $this->assertGreaterThan(4, strlen($description));
        }
    }

    /**
     * Get an invalid field description
     */
    public function testGetInvalidFieldDescription()
    {
        $nonsenseField = "bah";
        $this->setExpectedException('AndyWaite\SemRushApi\Data\Exception\InvalidFieldException');
        $this->instance->getFieldDescription($nonsenseField);
    }

    /**
     * Check isValidField function
     */
    public function testIsValidField()
    {
        foreach ($this->getValidFieldList() as $field) {
            $this->assertTrue($this->instance->isValidField($field));
        }
        $nonsenseField = "bah";
        $this->assertFalse($this->instance->isValidField($nonsenseField));
    }

    /**
     * Valid fields to test against
     *
     * @return array
     */
    protected function getValidFieldList()
    {
        return [
            "Ab",
            "Ac",
            "Ad",
            "Am",
            "At",
            "Bm",
            "Cm",
            "Co",
            "Cp",
            "Cr",
            "Cv",
            "Db",
            "Dn",
            "Ds",
            "Dt",
            "Hs",
            "Ip",
            "Lc",
            "Li",
            "Np",
            "Nq",
            "Nr",
            "Oc",
            "Of",
            "Om",
            "Or",
            "Ot",
            "P0",
            "P1",
            "P2",
            "P3",
            "P4",
            "Pc",
            "Pd",
            "Ph",
            "Po",
            "Pp",
            "Pt",
            "Qu",
            "Rh",
            "Rk",
            "Rt",
            "Tc",
            "Td",
            "Tm",
            "Tr",
            "Ts",
            "Tt",
            "Um",
            "Ur",
            "Vu",
            "ads_count",
            "ads_overall",
            "advertisers_count",
            "advertisers_overall",
            "anchor",
            "avg_positions",
            "domain",
            "external_num",
            "first_seen",
            "image_alt",
            "image_url",
            "internal_num",
            "last_seen",
            "media_ads_count",
            "media_ads_overall",
            "media_type",
            "publishers_count",
            "publishers_overall",
            "redirect_url",
            "response_code",
            "source_title",
            "source_size",
            "source_url",
            "target_title",
            "target_url",
            "target_url",
            "text",
            "text_ads_count",
            "text_ads_overall",
            "times_seen",
            "title",
            "type",
            "visible_url"
        ];
    }

} 