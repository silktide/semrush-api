<?php

namespace Silktide\SemRushApi\Test\Helper;

use Silktide\SemRushApi\Helper\SerialiseRequest;
use PHPUnit\Framework\TestCase;
use Silktide\SemRushApi\Model\Result;

class SerialiseRequestTest extends TestCase {

    protected function getRequest($requestParams)
    {
        $request = $this->getMockBuilder('Silktide\SemRushApi\Model\Request')->disableOriginalConstructor()->getMock();
        $request->method('getUrlParameters')->willReturn($requestParams);
        return $request;
    }

    public function testSerialise()
    {
        $serialiser = $this->getMockForTrait('Silktide\SemRushApi\Helper\SerialiseRequest');

        $firstResult = $serialiser->serialise($this->getRequest(["a" => "b", "c" => "d", 'export_columns' => ['a', 'b']]));

        self::assertTrue(is_string($firstResult));
        self::assertGreaterThanOrEqual(15, strlen($firstResult));

        $secondResult = $serialiser->serialise($this->getRequest(["a" => "b", 'export_columns' => ['a', 'b'],  "c" => "d"]));
        $thirdResult = $serialiser->serialise($this->getRequest(["q" => "r", "c" => "d", 'export_columns' => ['a', 'b']]));
        $fourthResult = $serialiser->serialise($this->getRequest(["q" => "r", "c" => "d", 'export_columns' => ['b', 'a']]));

        self::assertEquals($firstResult, $secondResult);
        self::assertNotEquals($secondResult, $thirdResult);
        self::assertNotEquals($thirdResult, $fourthResult);
    }
} 