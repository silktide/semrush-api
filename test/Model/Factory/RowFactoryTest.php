<?php

namespace Silktide\SemRushApi\Test\Model\Factory;

use Silktide\SemRushApi\Model\Row;
use Silktide\SemRushApi\Test\ResponseExample\ResponseExampleHelper;
use PHPUnit_Framework_TestCase;
use Silktide\SemRushApi\Model\Factory\RowFactory;

class RowFactoryTest extends PHPUnit_Framework_TestCase {

    /**
     * @var RowFactory
     */
    protected $instance;

    /**
     * Create an instance
     *
     * This is done in setup as we need a new one for each test
     */
    public function setup()
    {
        $this->instance = new RowFactory();
    }

    /**
     * Test that we can create a SemRush result
     */
    public function testCreate()
    {
        $columns = ["Db","Dn","Rk","Or","Ot","Oc","Ad","At","Ac"];
        $values = "us;seobook.com;29062;3214;33696;193957;0;0;0";
        $data = array_combine($columns, explode(";",$values));
        $row = $this->instance->create($data);
        $this->assertTrue($row instanceof Row);
        $this->assertEquals($data['Db'], $row->getValue('Db'));
    }

} 