<?php


namespace AndyWaite\SemRushApi\Test;

use AndyWaite\SemRushApi\Model\Result;
use AndyWaite\SemRushApi\Test\ResponseExample\ResponseExampleHelper;
use PHPUnit_Framework_TestCase;
use AndyWaite\SemRushApi\ResultFactory;

class ResultFactoryTest extends PHPUnit_Framework_TestCase {

    /**
     * @var ResultFactory
     */
    protected $instance;

    /**
     * @var ResponseExampleHelper
     */
    protected $responseExampleHelper;

    /**
     * Instantiate our response example helper
     *
     * This is done in constructor as one is fine for all tests
     */
    public function __construct()
    {
        $this->responseExampleHelper = new ResponseExampleHelper();
    }

    /**
     * Create an instance
     *
     * This is done in setup as we need a new one for each test
     */
    public function setup()
    {
        $this->instance = new ResultFactory();
    }

    /**
     * Test that we can create a SemRush result
     */
    public function testCreate()
    {
        $columns = ["Db","Dn","Rk","Or","Ot","Oc","Ad","At","Ac"];
        $exampleResponse = $this->responseExampleHelper->getResponseExample('domain_ranks');
        $result = $this->instance->create($columns, $exampleResponse);
        $this->assertTrue($result instanceof Result);
        $this->assertEquals(1, count($result));
    }

} 