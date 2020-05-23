<?php


namespace Silktide\SemRushApi\Test\Model\Factory;

use Silktide\SemRushApi\Model\Result;
use Silktide\SemRushApi\Model\Row;
use Silktide\SemRushApi\Test\ResponseExample\ResponseExampleHelper;
use PHPUnit\Framework\TestCase;
use Silktide\SemRushApi\Model\Factory\ResultFactory;

class ResultFactoryTest extends TestCase {

    /**
     * @var ResultFactory
     */
    protected $instance;

    /**
     * Create an instance
     *
     * This is done in setup as we need a new one for each test
     */
    public function setup() : void
    {
        $rowFactory = $this->createMock('Silktide\SemRushApi\Model\Factory\RowFactory');
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
        $values = "us;seobook.com;29062;3214;33696;193957;0;0;0";
        $data = array_combine($columns, explode(";",$values));
        $result = $this->instance->create([$data,$data]);
        self::assertTrue($result instanceof Result);
        self::assertEquals(2, count($result));
        foreach ($result as $row)
        {
            self::assertTrue($row instanceof Row);
        }
    }

} 