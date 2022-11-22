<?php


namespace Silktide\SemRushApi\Test;

use Cache\Adapter\PHPArray\ArrayCachePool;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Silktide\SemRushApi\Client;
use Silktide\SemRushApi\Data\Type;
use Silktide\SemRushApi\Helper\UrlBuilder;
use Silktide\SemRushApi\Model\Factory\RequestFactory;
use Silktide\SemRushApi\Model\Request;
use Silktide\SemRushApi\Model\Result;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client as GuzzleClient;
use Silktide\SemRushApi\Model\Factory\ResultFactory;
use Silktide\SemRushApi\Helper\ResponseParser;


class ClientTest extends TestCase
{
    protected Client $instance;
    protected string $key = 'sampleKey';

    protected ResultFactory $resultFactory;
    protected RequestFactory $requestFactory;
    protected ResponseParser $responseParser;
    protected Request $request;

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
        $this->request->method('buildOptionsArray')->willReturn(['type' => '', 'options' => []]);
        $this->request->method('getEndpoint')->willReturn('test-endpoint');

        $this->requestFactory->method('create')->willReturn($this->request);

        $this->resultFactory = $this->getMockBuilder(ResultFactory::class)->disableOriginalConstructor()->getMock();
        $result = $this->getMockBuilder(Result::class)->disableOriginalConstructor()->getMock();
        $this->resultFactory->method('create')->willReturn($result);

        $this->responseParser = $this->createMock(ResponseParser::class);
        $urlBuilder = $this->createMock(UrlBuilder::class);

        $urlBuilder->expects($this->any())->method('build')->with($this->request)->willReturn('https://sausages.com');

        $this->instance = new Client($this->key, $this->requestFactory,  $this->responseParser, $this->resultFactory, $urlBuilder, $guzzle);
    }

    public function testGetApiKey()
    {
        $this->doSetup(1);
        $this->instance->getDomainRank('domain.com', []);
        self::assertEquals($this->key, $this->instance->getApiKey());
    }

    public function testGetDomainRank()
    {
        $this->doSetup(1);
        $result = $this->instance->getDomainRank('domain.com', []);
        self::assertTrue($result instanceof Result);
    }

    public function testGetDomainRanks()
    {
        $this->doSetup(1);
        $result = $this->instance->getDomainRanks('domain.com', []);
        self::assertTrue($result instanceof Result);
    }

    public function testGetDomainRankHistory()
    {
        $this->doSetup(1);
        $result = $this->instance->getDomainRankHistory('domain.com', []);
        self::assertTrue($result instanceof Result);
    }

    public function testGetDomainOrganic()
    {
        $this->doSetup(1);
        $result = $this->instance->getDomainOrganic('domain.com', []);
        self::assertTrue($result instanceof Result);
    }

    public function testGetDomainAdwords()
    {
        $this->doSetup(1);
        $result = $this->instance->getDomainAdwords('domain.com', []);
        self::assertTrue($result instanceof Result);
    }

    public function testGetDomainAdwordsUnique()
    {
        $this->doSetup(1);
        $result = $this->instance->getDomainAdwordsUnique('domain.com', []);
        self::assertTrue($result instanceof Result);
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
        self::assertTrue(true);
    }

    public function testCalculateApiUsage()
    {
        self::assertUsageCosts(50, Type::TYPE_DOMAIN_RANK, 1, true);
        self::assertUsageCosts(10, Type::TYPE_DOMAIN_RANK, 1, false);

        self::assertUsageCosts(250, Type::TYPE_DOMAIN_RANKS, 5, true);
        self::assertUsageCosts(50, Type::TYPE_DOMAIN_RANKS, 5, false);

        self::assertUsageCosts(500, Type::TYPE_DOMAIN_ORGANIC, 10, true);
        self::assertUsageCosts(100, Type::TYPE_DOMAIN_ORGANIC, 10, false);

        self::assertUsageCosts(10, Type::TYPE_DOMAIN_RANK_HISTORY, 1, true);
        self::assertUsageCosts(10, Type::TYPE_DOMAIN_RANK_HISTORY, 1, false);

        self::assertUsageCosts(50, Type::TYPE_ADVERTISER_RANK, 5, true);
        self::assertUsageCosts(100, Type::TYPE_ADVERTISER_RANK, 10, false);

        self::assertUsageCosts(200, Type::TYPE_DOMAIN_ADWORDS, 2, true);
        self::assertUsageCosts(80, Type::TYPE_DOMAIN_ADWORDS, 4, false);

        self::assertUsageCosts(1500, Type::TYPE_DOMAIN_PLA_SEARCH_KEYWORDS, 10, true);
        self::assertUsageCosts(600, Type::TYPE_DOMAIN_PLA_SEARCH_KEYWORDS, 20, false);

        self::assertUsageCosts(40, Type::TYPE_DOMAIN_ADWORDS_UNIQUE, 1, true);
        self::assertUsageCosts(400, Type::TYPE_DOMAIN_ADWORDS_UNIQUE, 10, false);

        self::assertUsageCosts(50, Type::TYPE_KEYWORD_DIFFICULTY, 1, true);
        self::assertUsageCosts(250, Type::TYPE_KEYWORD_DIFFICULTY, 5, false);

        self::assertUsageCosts(400, Type::TYPE_ADVERTISER_PUBLISHERS, 4, true);
        self::assertUsageCosts(100, Type::TYPE_ADVERTISER_PUBLISHERS, 1, false);

        self::assertUsageCosts(100, Type::TYPE_ADVERTISER_DISPLAY_ADS, 1, true);
        self::assertUsageCosts(300, Type::TYPE_ADVERTISER_DISPLAY_ADS, 3, false);
    }

    protected function assertUsageCosts($expected, $requestType, $rowsReturned, $historical = true)
    {
        $options = [];
        if ($historical) {
            $options = ['display_date' => \DateTime::createFromFormat('j-M-Y', '15-Feb-2009')];
        }

        $request = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $request->method('buildOptionsArray')->willReturn(['type' => $requestType ] + $options);
        $request->method('getUrlParameters')->willReturn($options);

        $result = $this->createMock(Result::class);
        $result->method('count')->willReturn($rowsReturned);

        $client = new Client(
            'test-key',
             $this->createMock(RequestFactory::class),
             $this->createMock(ResponseParser::class),
             $this->createMock(ResultFactory::class),
             $this->createMock(UrlBuilder::class),
             $this->createMock(GuzzleClient::class)
        );

        $historicalMessage = ($historical) ? 'true' : false;
        self::assertEquals($expected, $client->getApiUsage($request, $result), "Request type '$requestType' with $rowsReturned rows returned. Historical = $historicalMessage");
    }
}
