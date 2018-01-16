<?php

namespace Silktide\SemRushApi\Test\Helper;

use Silktide\SemRushApi\Helper\UrlBuilder;
use PHPUnit\Framework\TestCase;

class UrlBuilderTest extends TestCase  {

    /**
     * @var UrlBuilder
     */
    protected $urlBuilder;

    /**
     * Instantiate a URL builder
     */
    public function setup()
    {
        $this->urlBuilder = new UrlBuilder();
    }

    /**
     * Test the URL builder
     */
    public function testUrlBuilder()
    {
        $request = $this->getMockBuilder('Silktide\SemRushApi\Model\Request')->disableOriginalConstructor()->getMock();
        $request->method('getUrlParameters')->willReturn(["a" => "b", "c" => "d", 'export_columns' => ['a', 'b']]);
        $request->method('getEndpoint')->willReturn("http://endpoint.com");
        $url = $this->urlBuilder->build($request);
        $this->assertEquals("http://endpoint.com?a=b&c=d&export_columns=".urlencode("a,b"), $url);
    }


} 