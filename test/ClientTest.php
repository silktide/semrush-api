<?php


namespace Silktide\SemRushApi\Test;

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
     * Instantiate a client
     */
    public function doSetup($requestNumber)
    {
        $handler = new MockHandler([]);
        for ($i = 0; $i < $requestNumber; $i++) {
            $handler->append(new Response(200));
        }

        $guzzle = new GuzzleClient(["handler" => $handler]);

        $this->requestFactory = $this->createMock(RequestFactory::class);
        $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $this->requestFactory->expects($this->exactly($requestNumber))->method('create')->willReturn($this->request);

        $this->resultFactory = $this->getMockBuilder(ResultFactory::class)->disableOriginalConstructor()->getMock();
        $result = $this->getMockBuilder(Result::class)->disableOriginalConstructor()->getMock();
        $this->resultFactory->expects($this->exactly(1))->method('create')->willReturn($result);

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

}
