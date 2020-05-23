<?php

namespace Silktide\SemRushApi\Test\Model;

use PHPUnit\Framework\TestCase;
use Silktide\SemRushApi\Model\Exception\InvalidDataException;
use Silktide\SemRushApi\Model\Exception\InvalidFieldException;
use Silktide\SemRushApi\Model\Row;

class RowTest extends TestCase {

    /**
     * @var Row
     */
    private $instance;

    /**
     * Set up an instance of row
     */
    public function setup() : void
    {
        $this->instance = new Row();
    }

    /**
     * Check we can set and get data
     *
     * @throws \Silktide\SemRushApi\Model\Exception\InvalidDataException
     */
    public function testSetAndGetData()
    {
        $values = [
            'At' => 'top',
            'Ac' => '560',
            'Ad' => 'biscuits, cookies, hobnobs'
        ];
        $this->instance->setData($values);
        self::assertEquals($values, $this->instance->getData());
    }

    /**
     * Make sure an exception is thrown with invalid data
     *
     * @throws \Silktide\SemRushApi\Model\Exception\InvalidDataException
     */
    public function testSetInvalidData()
    {
        $this->expectException(InvalidDataException::class);
        $this->instance->setData("boot");
    }

    /**
     * Make sure an exception is thrown with invalid field name
     *
     * @throws \Silktide\SemRushApi\Model\Exception\InvalidFieldException
     */
    public function testSetInvalidField()
    {
        $values = [
            'At' => 'top',
            'Ac' => '560',
            'something' => 'biscuits, cookies, hobnobs'
        ];
        $this->expectException(InvalidFieldException::class);
        $this->instance->setData($values);
    }

    /**
     * Make sure getting a value returns the correct value
     * 
     * @throws \Silktide\SemRushApi\Model\Exception\InvalidDataException
     */
    public function testGetValue()
    {
        $values = [
            'At' => 'top',
            'Ac' => '560',
            'Ad' => 'biscuits, cookies, hobnobs'
        ];
        $this->instance->setData($values);

        foreach ($values as $key => $value) {
            self::assertEquals($value, $this->instance->getValue($key));
        }
    }

    /**
     * Make sure getting a value returns the correct value
     *
     * @throws \Silktide\SemRushApi\Model\Exception\InvalidDataException
     */
    public function testGetUnsetValue()
    {
        $this->expectException(InvalidFieldException::class);
        $values = [
            'At' => 'top',
            'Ac' => '560',
            'Ad' => 'biscuits, cookies, hobnobs'
        ];
        $this->instance->setData($values);
        $this->instance->getValue('Am');
    }

}