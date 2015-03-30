<?php

namespace AndyWaite\SemRushApi\Test\Model\Factory;

use AndyWaite\SemRushApi\Model\Request;
use AndyWaite\SemRushApi\Model\Factory\RequestFactory;
use PHPUnit_Framework_TestCase;
use AndyWaite\SemRushApi\Data\Type;

class RequestFactoryTest extends PHPUnit_Framework_TestCase {

    /**
     * @var RequestFactory
     */
    protected $instance;

    /**
     * Instantiate a client
     */
    public function setup()
    {
        $this->instance = new RequestFactory();
    }

    public function testCreate()
    {
        $this->instance->create(Type::TYPE_DOMAIN_RANKS, ['key' => 'a key', 'domain' => 'domain.com']);
    }


} 