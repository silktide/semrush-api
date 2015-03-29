<?php
/**
 * Copyright 2013-2015 Silktide Ltd. All Rights Reserved.
 */

namespace AndyWaite\SemRushApi\Test;

use AndyWaite\SemRushApi\Data\Column;
use AndyWaite\SemRushApi\Data\Database;
use AndyWaite\SemRushApi\Data\Type;
use AndyWaite\SemRushApi\Request;
use PHPUnit_Framework_TestCase;

class RequestTest extends PHPUnit_Framework_TestCase {

    protected $key = 'testkey';
    protected $domain = 'domain';

    public function testRequest()
    {
        $request = new Request(Type::TYPE_DOMAIN_RANKS, [
            'key' => $this->key,
            'domain' => $this->domain,
            'display_date' => '20150115',
            'database' => Database::DATABASE_GOOGLE_UK,
            'export_columns' => [
                Column::COLUMN_ADWORDS_BUDGET,
                Column::COLUMN_ADWORDS_KEYWORDS
            ]
        ]);
        $request->getUrl();
    }

    public function testRequestWithMissingOption()
    {
        $this->setExpectedException('AndyWaite\SemRushApi\Exception\InvalidOptionException');
        new Request(Type::TYPE_DOMAIN_RANKS, []);
    }

    public function testRequestWithInvalidColumnData()
    {
        $this->setExpectedException('AndyWaite\SemRushApi\Exception\InvalidOptionException');
        new Request(Type::TYPE_DOMAIN_RANKS, ['key' => $this->key, 'domain' => $this->domain, 'export_columns' => ['Blah', 'At']]);
    }

    public function testRequestWithInvalidColumnValue()
    {
        $this->setExpectedException('AndyWaite\SemRushApi\Exception\InvalidOptionException');
        new Request(Type::TYPE_DOMAIN_RANKS, ['key' => $this->key, 'domain' => $this->domain, 'export_columns' => 'blah']);
    }

    public function testRequestWithInvalidOption()
    {
        $this->setExpectedException('AndyWaite\SemRushApi\Exception\InvalidOptionException');
        new Request(Type::TYPE_DOMAIN_RANKS, ['something' => 'bad']);
    }

    /**
     * TODO: Make this validate proper dates
     */
    public function testRequestWithInvalidDate()
    {
        $this->setExpectedException('AndyWaite\SemRushApi\Exception\InvalidOptionException');
        new Request(Type::TYPE_DOMAIN_RANKS, ['key' => $this->key, 'domain' => $this->domain, 'display_date' => 22]);
    }

    public function testRequestWithInvalidDatabase()
    {
        $this->setExpectedException('AndyWaite\SemRushApi\Exception\InvalidOptionException');
        new Request(Type::TYPE_DOMAIN_RANKS, ['key' => $this->key, 'domain' => $this->domain, 'database' => 'rubbish']);
    }

    public function testRequestWithInvalidKey()
    {
        $this->setExpectedException('AndyWaite\SemRushApi\Exception\InvalidOptionException');
        new Request(Type::TYPE_DOMAIN_RANKS, ['key' => 12, 'domain' => $this->domain]);
    }

} 