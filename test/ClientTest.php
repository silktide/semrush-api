<?php


namespace Silktide\SemRushApi\Test;

use Silktide\SemRushApi\Client;
use Silktide\SemRushApi\Helper\Exception\EmptyResponseException;
use Silktide\SemRushApi\Model\Result;
use PHPUnit_Framework_TestCase;
use Guzzle\Plugin\Mock\MockPlugin;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Client as GuzzleClient;
use Silktide\SemRushApi\Model\Factory\ResultFactory;
use Silktide\SemRushApi\Helper\ResponseParser;


class ClientTest extends PHPUnit_Framework_TestCase {

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

        $plugin = new MockPlugin();
        for ($i = 0; $i < $requestNumber; $i++) {
            $plugin->addResponse(new Response(200));
        }
        $guzzle = new GuzzleClient();
        $guzzle->addSubscriber($plugin);

        $this->requestFactory = $this->getMock('Silktide\SemRushApi\Model\Factory\RequestFactory');
        $this->request = $this->getMockBuilder('Silktide\SemRushApi\Model\Request')->disableOriginalConstructor()->getMock();
        $this->requestFactory->expects($this->exactly($requestNumber))->method('create')->willReturn($this->request);

        $this->resultFactory = $this->getMockBuilder('Silktide\SemRushApi\Model\Factory\ResultFactory')->disableOriginalConstructor()->getMock();
        $result = $this->getMockBuilder('Silktide\SemRushApi\Model\Result')->disableOriginalConstructor()->getMock();
        $this->resultFactory->expects($this->exactly(1))->method('create')->willReturn($result);

        $this->responseParser = $this->getMock('Silktide\SemRushApi\Helper\ResponseParser');
        $urlBuilder = $this->getMock('Silktide\SemRushApi\Helper\UrlBuilder');

        $this->instance = new Client($this->key, $this->requestFactory, $this->resultFactory, $this->responseParser, $urlBuilder, $guzzle);
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
        $this->doSetup(2);

        $result = $this->getMockBuilder('Silktide\SemRushApi\Model\Result')->disableOriginalConstructor()->getMock();

        $cache = $this->getMock('Silktide\SemRushApi\Cache\CacheInterface');
        $cache->expects($this->exactly(2))->method('cache');
        $cache->expects($this->exactly(2))->method('fetch')->willReturnOnConsecutiveCalls(null, $result);
        $this->resultFactory->expects($this->exactly(1))->method('create')->willReturn($result);

        $this->instance->setCache($cache);
        $resultOne = $this->instance->getDomainAdwordsUnique('domain.com', []);
        $resultTwo = $this->instance->getDomainAdwordsUnique('domain.com', []);

        $this->assertEquals($resultOne, $resultTwo);
    }


} 