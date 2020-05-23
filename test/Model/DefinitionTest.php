<?php


namespace Silktide\SemRushApi\Test\Model;

use Silktide\SemRushApi\Data\Type;
use Silktide\SemRushApi\Model\Definition;
use PHPUnit\Framework\TestCase;
use Silktide\SemRushApi\Model\Exception\InvalidTypeException;

class DefinitionTest extends TestCase {

    /**
     * @var Definition
     */
    protected $instance;

    /**
     * Setup an instance of definition
     */
    public function setup() : void
    {
        $this->instance = new Definition(Type::TYPE_DOMAIN_RANKS);
    }

    /**
     * Expect an exception when an invalid type is requested
     */
    public function testInvalidType()
    {
        $this->expectException(InvalidTypeException::class);
        new Definition("invalid");
    }

    public function testGetRequiredFields()
    {
        self::assertEquals([
            "type" => "type",
            "key" => "string",
            "domain" => "domain"
        ], $this->instance->getRequiredFields());
    }

    public function testGetOptionalFields()
    {
        self::assertEquals([
            "database" => "database",
            "display_date" => "date",
            "export_columns" => "columns",
            "export_escape" => "boolean"
        ], $this->instance->getOptionalFields());
    }

    public function testGetAvailableFields()
    {
        self::assertEquals([
            "type" => "type",
            "key" => "string",
            "domain" => "domain",
            "database" => "database",
            "display_date" => "date",
            "export_columns" => "columns",
            "export_escape" => "boolean"
        ], $this->instance->getAvailableFields());
    }

    public function testGetPresetFields()
    {
        self::assertEquals([
            "export_escape" => "1"
        ], $this->instance->getPresetFields());
    }

    public function testGetDefaultColumns()
    {
        self::assertEquals([
            "Db",
            "Dn",
            "Rk",
            "Or",
            "Ot",
            "Oc",
            "Ad",
            "At",
            "Ac"
        ], $this->instance->getDefaultColumns());
    }

    public function testGetValidColumns()
    {
        self::assertEquals([
            "Db",
            "Dn",
            "Rk",
            "Or",
            "Ot",
            "Oc",
            "Ad",
            "At",
            "Ac"
        ], $this->instance->getValidColumns());
    }
} 