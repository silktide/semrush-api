<?php


namespace Silktide\SemRushApi\Test;

use Cache\Adapter\PHPArray\ArrayCachePool;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Psr\SimpleCache\CacheInterface;
use Silktide\SemRushApi\Client;
use Silktide\SemRushApi\Helper\Exception\EmptyResponseException;
use Silktide\SemRushApi\Helper\UrlBuilder;
use Silktide\SemRushApi\Model\Factory\RequestFactory;
use Silktide\SemRushApi\Model\Request;
use Silktide\SemRushApi\Model\Result;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client as GuzzleClient;
use Silktide\SemRushApi\Model\Factory\ResultFactory;
use Silktide\SemRushApi\Helper\ResponseParser;


class ClientTest extends TestCase {

    /**
     * @var Client
     */
    protected $instance;

    /**
     * @var string
     */
    protected $key = 'sampleKey';

    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * @var RequestFactory
     */
    protected $requestFactory;

    /**
     * @var ResponseParser
     */
    protected $responseParser;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param $requestNumber
     * @param array $httpQueue
     */
    public function doSetup($requestNumber, array $httpQueue = [])
    {
        for ($i = 0; $i < $requestNumber; $i++) {
            $httpQueue[] = new Response(200, [], '{ "domain": "somedomain.com" }');
        }
        $guzzle = new GuzzleClient(["handler" => MockHandler::createWithMiddleware($httpQueue)]);

        $this->requestFactory = $this->createMock(RequestFactory::class);
        $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $this->requestFactory->method('create')->willReturn($this->request);

        $this->resultFactory = $this->getMockBuilder(ResultFactory::class)->disableOriginalConstructor()->getMock();
        $result = $this->getMockBuilder(Result::class)->disableOriginalConstructor()->getMock();
        $this->resultFactory->method('create')->willReturn($result);

        $this->responseParser = $this->createMock(ResponseParser::class);
        $urlBuilder = $this->createMock(UrlBuilder::class);

        $this->instance = new Client($this->key, $this->requestFactory,  $this->responseParser, $this->resultFactory, $urlBuilder, $guzzle);
    }

    public function testGetApiKey()
    {
        $this->doSetup(1);
        $this->instance->getDomainRank('domain.com', []);
        $this->assertEquals($this->key, $this->instance->getApiKey());
    }

    public function testGetDomainRank()
    {
        $this->doSetup(1);
        $result = $this->instance->getDomainRank('domain.com', []);
        $this->assertTrue($result instanceof Result);
    }

    public function testGetDomainRanks()
    {
        $this->doSetup(1);
        $result = $this->instance->getDomainRanks('domain.com', []);
        $this->assertTrue($result instanceof Result);
    }

    public function testGetDomainRankHistory()
    {
        $this->doSetup(1);
        $result = $this->instance->getDomainRankHistory('domain.com', []);
        $this->assertTrue($result instanceof Result);
    }

    public function testGetDomainOrganic()
    {
        $this->doSetup(1);
        $result = $this->instance->getDomainOrganic('domain.com', []);
        $this->assertTrue($result instanceof Result);
    }

    public function testGetDomainAdwords()
    {
        $this->doSetup(1);
        $result = $this->instance->getDomainAdwords('domain.com', []);
        $this->assertTrue($result instanceof Result);
    }

    public function testGetDomainAdwordsUnique()
    {
        $this->doSetup(1);
        $result = $this->instance->getDomainAdwordsUnique('domain.com', []);
        $this->assertTrue($result instanceof Result);
    }

    public function testCache()
    {
        $exampleResponse = '{"Website":"facebook.com"}';
        $this->doSetup(0, [
            new Response(200, [], $exampleResponse),
            new Response(500, [], "The server failed")
        ]);

        $this->instance->setCache(new ArrayCachePool());
        $this->instance->getDomainRank("facebook.com");
        $this->instance->getDomainRank("facebook.com");
        $this->assertTrue(true);
    }
}
