<?php


namespace AndyWaite\SemRushApi\Test;

use AndyWaite\SemRushApi\Client;
use AndyWaite\SemRushApi\Data\Column;
use AndyWaite\SemRushApi\Data\Database;
use AndyWaite\SemRushApi\Model\Result;
use AndyWaite\SemRushApi\Test\ResponseExample\ResponseExampleHelper;
use PHPUnit_Framework_TestCase;
use AndyWaite\SemRushApi\Connector\ConnectorInterface;

class ClientTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Client
     */
    protected $instance;

    /**
     * @var ConnectorInterface
     */
    protected $connector;

    /**
     * Set up instance of client
     */
    public function setup()
    {
        $apiKey = "testkey";
        $this->connector = $this->getMock('AndyWaite\SemRushApi\Connector\ConnectorInterface');
        $resultFactory = $this->getMock('AndyWaite\SemRushApi\Model\Factory\ResultFactory');
        $resultFactory->method('create')->willReturn(new Result());
        $this->instance = new Client($apiKey, $this->connector, $resultFactory);
    }

    public function testGetDomainRanks()
    {
        $domain = "test.com";
        $result = $this->instance->getDomainRanks($domain);
        $this->assertTrue($result instanceof Result);
    }

    public function testGetDomainRanksForSpecificDatabase()
    {
        $domain = "test.com";
        $result = $this->instance->getDomainRanks($domain, Database::DATABASE_GOOGLE_UK);
        $this->assertTrue($result instanceof Result);
    }

    public function testGetDomainRanksWithSpecificColumns()
    {
        $domain = "test.com";
        $result = $this->instance->getDomainRanks($domain, null, [Column::COLUMN_ADWORDS_BUDGET, Column::COLUMN_ADWORDS_TRAFFIC]);
        $this->assertTrue($result instanceof Result);
    }


} 