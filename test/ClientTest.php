<?php


namespace AndyWaite\SemRushApi\Test;

use AndyWaite\SemRushApi\Client;
use PHPUnit_Framework_TestCase;

class ClientTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Client
     */
    protected $instance;

    /**
     * Set up instance of client
     */
    public function setup()
    {
        $apiKey = "testkey";
        //$this->instance = new Client($apiKey);
    }

    public function testGetDomainRanks()
    {
        $domain = "test.com";
        $databases = [];
        //$this->instance->getDomainRanks($domain, $database);
    }

} 