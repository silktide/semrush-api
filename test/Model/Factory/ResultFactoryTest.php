<?php


namespace AndyWaite\SemRushApi\Test\Model\Factory;

use AndyWaite\SemRushApi\Model\Result;
use AndyWaite\SemRushApi\Test\ResponseExample\ResponseExampleHelper;
use PHPUnit_Framework_TestCase;
use AndyWaite\SemRushApi\Model\Factory\ResultFactory;

class ResultFactoryTest extends PHPUnit_Framework_TestCase {

    /**
     * @var ResultFactory
     */
    protected $instance;

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
        $exampleResponse = ResponseExampleHelper::getResponseExample('domain_ranks_default');
        $result = $this->instance->create($columns, $exampleResponse);
        $this->assertTrue($result instanceof Result);
        $this->assertEquals(2, count($result));
    }

} 