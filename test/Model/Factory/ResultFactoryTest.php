<?php


namespace Silktide\SemRushApi\Test\Model\Factory;

use Silktide\SemRushApi\Model\Result;
use Silktide\SemRushApi\Test\ResponseExample\ResponseExampleHelper;
use PHPUnit_Framework_TestCase;
use Silktide\SemRushApi\Model\Factory\ResultFactory;

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
        $rowFactory = $this->getMock('Silktide\SemRushApi\Model\Factory\RowFactory');
        $row = $this->getMockBuilder('Silktide\SemRushApi\Model\Row')->disableOriginalConstructor()->getMock();
        $rowFactory->expects($this->any())->method('create')->willReturn($row);
        $this->instance = new ResultFactory($rowFactory);
    }

    /**
     * Test that we can create a SemRush result
     */
    public function testCreate()
    {
        $columns = ["Db","Dn","Rk","Or","Ot","Oc","Ad","At","Ac"];
        $exampleResponse = ResponseExampleHelper::getResponseExample('domain_ranks_silktide');
        $result = $this->instance->create($columns, $exampleResponse);
        $this->assertTrue($result instanceof Result);
        $this->assertEquals(26, count($result));
    }

} 