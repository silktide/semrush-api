<?php

namespace Silktide\SemRushApi\Test\Cache;

use Silktide\SemRushApi\Cache\MemoryCache;
use PHPUnit_Framework_TestCase;
use Silktide\SemRushApi\Model\Result;

class MemoryCacheTest extends PHPUnit_Framework_TestCase {

    /**
     * @var RequestCache
     */
    protected $requestCache;

    public function setup()
    {
        $this->requestCache = new MemoryCache();
    }

    public function testCacheRequest()
    {
        $request = $this->getMockBuilder('Silktide\SemRushApi\Model\Request')->disableOriginalConstructor()->getMock();
        $request->method('getUrlParameters')->willReturn(["a" => "b", "c" => "d", 'export_columns' => ['a', 'b']]);

        $result = $this->requestCache->fetch($request);
        $this->assertNull($result);

        $result = $this->getMockBuilder('Silktide\SemRushApi\Model\Result')->disableOriginalConstructor()->getMock();

        $this->requestCache->cache($request, $result);

        $request = $this->getMockBuilder('Silktide\SemRushApi\Model\Request')->disableOriginalConstructor()->getMock();
        $request->method('getUrlParameters')->willReturn(["c" => "d", 'export_columns' => ['a', 'b'], "a" => "b"]);
        $cachedResult = $this->requestCache->fetch($request);

        $this->assertEquals($result, $cachedResult);
    }

} 