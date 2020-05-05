<?php

namespace Silktide\SemRushApi\Test\Model\Factory;

use Silktide\SemRushApi\Model\Factory\RequestFactory;
use PHPUnit\Framework\TestCase;
use Silktide\SemRushApi\Data\Type;

class RequestFactoryTest extends TestCase {

    /**
     * @var RequestFactory
     */
    protected $instance;

    /**
     * Instantiate a client
     */
    public function setup() : void
    {
        $this->instance = new RequestFactory();
    }

    public function testCreate()
    {
        $this->instance->create(Type::TYPE_DOMAIN_RANKS, ['key' => 'a key', 'domain' => 'domain.com']);
        self::assertTrue(true);
    }


} 