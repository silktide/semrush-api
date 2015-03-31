<?php


namespace Silktide\SemRushApi\Test;

use Silktide\SemRushApi\Client;
use Silktide\SemRushApi\Model\Result;
use PHPUnit_Framework_TestCase;
use Guzzle\Plugin\Mock\MockPlugin;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Client as GuzzleClient;


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
     * Instantiate a client
     */
    public function setup()
    {

        $plugin = new MockPlugin();
        $plugin->addResponse(new Response(200));
        $guzzle = new GuzzleClient();
        $guzzle->addSubscriber($plugin);

        $requestFactory = $this->getMock('Silktide\SemRushApi\Model\Factory\RequestFactory');
        $request = $this->getMockBuilder('Silktide\SemRushApi\Model\Request')->disableOriginalConstructor()->getMock();
        $requestFactory->expects($this->any())->method('create')->willReturn($request);

        $resultFactory = $this->getMockBuilder('Silktide\SemRushApi\Model\Factory\ResultFactory')->disableOriginalConstructor()->getMock();
        $result = $this->getMockBuilder('Silktide\SemRushApi\Model\Result')->disableOriginalConstructor()->getMock();
        $resultFactory->expects($this->any())->method('create')->willReturn($result);

        $this->instance = new Client($this->key, $requestFactory, $resultFactory, $guzzle);
    }

    public function testGetDomainRank()
    {
        $result = $this->instance->getDomainRank('domain.com', []);
        $this->assertTrue($result instanceof Result);
    }

    public function testGetDomainRanks()
    {
        $result = $this->instance->getDomainRanks('domain.com', []);
        $this->assertTrue($result instanceof Result);
    }

    public function testGetDomainRankHistory()
    {
        $result = $this->instance->getDomainRankHistory('domain.com', []);
        $this->assertTrue($result instanceof Result);
    }

    public function testGetApiKey()
    {
        $this->assertEquals($this->key, $this->instance->getApiKey());
    }



} 